<?php

namespace App\Http\Controllers\API;

use App\Purchase;
use App\Transformers\SchoolTransformer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\User;
use Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class ApiUsersController extends ApiController {

    function __construct(SchoolTransformer $schoolTransformer)
    {
        $this->middleware('jwt.auth', ['except' => ['register']]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $credentials = $request->only(['name', 'email', 'password', 'password_confirmation']);

        // If password doesn't match password_confirmation
        if ( $credentials['password'] != $credentials['password_confirmation'] ) {
            return $this->setStatusCode(400)->respondWithError('Passwords do not match.');
        }

        // Check if User credentials are already in use
        try {
            $credentials['password'] = bcrypt($credentials['password']);
            $user = User::create($credentials);
            // TODO: Trigger confirmation email
        } catch ( Exception $e ) {
            return $this->setStatusCode(409)->respondWithError('User Already Exists.');
        }

        // Generate new token
        $token = JWTAuth::fromUser($user);

        return $this->setStatusCode(200)->respond([
            'token' => $token
        ]);
    }

    /**
     * Retrieve the authenticated user from the specified token.
     *
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function getAuthenticatedUser()
    {
        try {
            if ( !$user = JWTAuth::parseToken()->authenticate() ) {
                return response()->json(['user_not_found'], 404);
            }
        } catch ( TokenExpiredException $e ) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch ( TokenInvalidException $e ) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch ( JWTException $e ) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        // The token is valid and we have found the user via the sub claim
        return $user;
    }

    /**
     * Returns a collection of course history.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourseHistory()
    {
        $user = $this->getAuthenticatedUser();
        $payments = $user->payments()->get();

        $all_purchases = [];

        foreach ( $payments as $payment ) {

            $purchases = $payment->purchases;

            foreach ( $purchases as $purchase ) {
                $all_purchases[] = $purchase;
            }

        }

        return $this->respond([
            'data' => $all_purchases,
        ]);
    }

}