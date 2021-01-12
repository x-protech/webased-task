<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use App\Traits\ApiResponser;
use CloudCreativity\LaravelJsonApi\Exceptions\HandlesErrors;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use CloudCreativity\LaravelJsonApi\Exceptions\JsonApiException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        JsonApiException::class,
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {

    }


    public function render($request, Throwable $e)
    {
        if ($e instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($e, $request);
        }

        if ($e instanceof ModelNotFoundException) {
            $modelName = strtolower(class_basename($e->getModel()));

            return $this->errorResponse("Does not exists any {$modelName} with the specified identificator",
                 404);
        }

        if ($e instanceof AuthenticationException) {
            return $this->unauthenticated($request, $e );
        }

        if ($e instanceof AuthorizationException) {
        return $this->$this->errorResponse($e->getMessage(), 403);
        }

        if ($e instanceof NotFoundHttpException) {
            return $this->errorResponse('The specified URL cannot be found', 404);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse('The specified method for the request is invalid', 405);
        }

        if ($e instanceof HttpException) {
            return $this->errorResponse($e->getMessage(), $e->getStatusCode());
        }

        if($e instanceof QueryException) {
            $errorCode = $e->errorInfo[1];

            if($errorCode == 1451) {
                return $this->errorResponse('Cannot remove this resource permenantly. It is related with other resource', 409);
            }
        }

        if (config('app.debug')) {
            return parent::render($request, $e);
        }

        // if ($this->isJsonApi($request, $e)) {
        //     return $this->renderJsonApi($request, $e);
        // }

        return $this->errorResponse('Unexpected Exception. Try later', 500);

    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();

        return $this->errorResponse($errors, 422);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse('Unauthenticated.', 401);
    }

    // protected function prepareException(Throwable $e)
    // {
    //     if ($e instanceof JsonApiException) {
    //       return $this->prepareJsonApiException($e);
    //     }

    //     return parent::prepareException($e);
    // }

}
