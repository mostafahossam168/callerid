<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException  $e,$request) {
            if ($request->is('api/*')){
                return response()->json([
                    'message'=> "غير موجود",
                    'status' =>false
                ],404);
            }
        });
        $this->renderable(function (AuthenticationException $e,$request) {
            if ($request->is('api/*')){
                return response()->json([
                    'message'=> __('Unauthorized'),
                    'status' =>false
                ],401);
            }
        });
        $this->renderable(function (MethodNotAllowedException $e,$request) {
            if ($request->is('api/*')){
                return response()->json([
                    'message'=> "الرابط غير موجود",
                    'status' =>false
                ],401);
            }
        });
        if (env('APP_ENV') === 'production') {
            $this->renderable(function (Throwable $e,$request) {
                if ($request->is('api/*')){
                    return response()->json([
                        'message'=> "حدث خطا ما",
                        'status' =>false
                    ],500);
                }
            });
        }
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        $errors = [];
        foreach ($exception->errors() as $field => $messages) {
            foreach ($messages as $message) {
                $errors[] = [
                    'field' => $field,
                    'message' => $message,
                ];
            }
        }

        return response()->json([
            'status' => false,
            'message' => $errors[0]['message'] ?? 'Validation failed',
        ], $exception->status);

    }

}
