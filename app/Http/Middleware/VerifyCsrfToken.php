<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/v1/authenticate',
        'api/v1/register',
        'api/v1/payment/status',
        'api/v1/users/delete',
        'api/v1/courses/*/comments',
        'api/v1/schools/*/comments',
    ];
}
