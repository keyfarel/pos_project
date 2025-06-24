<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Throwable;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->is('api/*')) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        return redirect()->guest(route('login'));
    }

    protected function handleJwtException(Throwable $exception)
    {
        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            return response()->json([
                'status' => false,
                'message' => 'Token expired'
            ], 401);
        }

        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            return response()->json([
                'status' => false,
                'message' => 'Token is invalid'
            ], 401);
        }

        if ($exception instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
            return response()->json([
                'status' => false,
                'message' => 'Token not provided'
            ], 401);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException &&
            $exception->getPrevious() instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized - Invalid JWT'
            ], 401);
        }

        return null; // Biar bisa dicek di render nanti
    }

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Tangani JWT error lewat method terpisah
        if ($jwtResponse = $this->handleJwtException($exception)) {
            return $jwtResponse;
        }

        // Tangani throttling login
        if ($exception instanceof ThrottleRequestsException) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Terlalu banyak percobaan login. Coba lagi dalam beberapa saat.',
                ], 429);
            }

            return redirect()->back()
                ->with('error', 'Terlalu banyak percobaan login. Silakan coba lagi nanti.')
                ->withInput();
        }

        return parent::render($request, $exception);
    }
}
