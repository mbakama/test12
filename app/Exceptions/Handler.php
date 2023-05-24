<?php

namespace App\Exceptions;


use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; 
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        // $this->reportable(function (Throwable $e) {
        //     //
        // });

        $this->renderable(function (NotFoundHttpException $e, $request){
            if ($request->is("api/*")) {
                return response()->json(
                    [
                        "message"=>"les informations que vous voulez acceder sont introuvables"
                    ],404
                );
            }
        });

        $this->renderable(function(MethodNotAllowedHttpException $e, $request){
            if ($request->is("api/*")) {
                return response()->json(
                    [
                        "message"=>"la methode que tu fais appel, ne pas compatible avec cette route, verifie ton url et insere une bonne methode"
                    ],404
                );
            }
        }) ;
        $this->renderable(function(HttpException $e, $request){
            if ($request->is("api/*")) {
                return response()->json(
                    [
                        "message"=>"la methode que tu evoque ne pas compatible avec cette route"
                    ],404
                );
            }
        });

    }
}