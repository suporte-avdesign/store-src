<?php

namespace AVD\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Http\Response;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ThrottleRequestsException) {
            return $this->response409();
        }

        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            return $this->response419($request);
        }

        return parent::render($request, $exception);
    }



    public function response409()
    {
        $message = 'attempts-limit';
        $error = view('frontend.messages.error-1', compact('message'))->render();

        return response()->json(['success' => $error]);
    }


    public function response419($request)
    {
        if ($request->ajax()) {
            $message = 'token_expired';
            $error   = constLang('token_expired');
            $html    = view('frontend.messages.error-1', compact('message', 'error'))->render();
            $out = array(
                'result' => 'redirect',
                'message' => $html,
                'redirect' => url()->current()
            );
            return response()->json($out);

        } else {
            return redirect()->url()->current();
        }

    }
}
