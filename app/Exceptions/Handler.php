<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        //
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
        if ($e instanceof Exception) {
            return response()->json(['message' => $e->getMessage()], 406);
        }

        if ($e instanceof QueryException) {

            if (env('APP_ENV') == 'local') {
                return response()->json(['message' => Lang::get('messages.MSG_FALHA_INESPERADA') . ' - ' . $e->getMessage()], 500);
            } else {
                return response()->json(['message' => Lang::get('messages.MSG_FALHA_INESPERADA')], 500);
            }
        }
        if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException) {
            return response()->json(['message' => Lang::get('messages.MSG_RESULTADO_NAO_ENCONTRADO')], 400);
        }

        return parent::render($request, $e);
    }

}
