<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            return redirect('/auth-404-basic');
        });

        $this->renderable(function (HttpException $e, Request $request) {
            if ($e->getStatusCode() == 500) {
                return redirect('/auth-500');
            }
            return null; // Biarkan Laravel menangani kode status lainnya
        });

        $this->renderable(function (Throwable $e, Request $request) {
            // Cek koneksi internet (hanya untuk frontend)
            if (!app()->runningInConsole() && !$this->isInternetConnected()) {
                return redirect('/auth-offline');
            }
            return null;
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Cek koneksi internet sederhana
     */
    protected function isInternetConnected(): bool
    {
        try {
            return @fsockopen('www.google.com', 80, $errno, $errstr, 5) ? true : false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
