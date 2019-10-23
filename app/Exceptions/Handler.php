<?php

namespace App\Exceptions;

use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Class Handler
 *
 * @package App\Exceptions
 * @author Gabrielllns
 */
class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Illuminate\Http\Request $request
     * @param Exception $e
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof UnauthorizedException || $e instanceof UnauthorizedHttpException) {
            return response('ACESSO NAO AUTORIZADO', 401);
        }

        if ($e instanceof Exception) {
            return response($e->getMessage(), 406);
        }

        if ($e instanceof ValidationException) {
            return response('CAMPOS OBTIGATÓRIOS NÃO INFORMADOS', 406);
        }

        if ($e instanceof QueryException) {

            if (env('APP_ENV') == 'local') {
                return response('ERRO DE BANCO: ' . $e->getMessage(), 500);
            } else {
                return response('ERRO DE COMUNICAÇÃO COM A APLICAÇÃO!', 500);
            }
        }

        if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
            return response('RESULTADO NAO ENCONTRADO', 400);
        }

        return parent::render($request, $e);
    }

}
