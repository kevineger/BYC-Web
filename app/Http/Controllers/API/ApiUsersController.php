<?php

namespace App\Http\Controllers\API;

use App\Transformers\SchoolTransformer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\User;
use Response;
use JWTAuth;

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
        if ($credentials['password'] != $credentials['password_confirmation'])
        {
            return $this->setStatusCode(400)->respondWithError('Passwords do not match.');
        }

        // Check if User credentials are already in use
        try
        {
            $user = User::create($credentials);
        } catch (Exception $e)
        {
            return $this->setStatusCode(409)->respondWithError('User Already Exists.');
        }

        // Generate new token
        $token = JWTAuth::fromUser($user);

        return $this->setStatusCode(200)->respond([
            'token' => $token
        ]);
    }
}