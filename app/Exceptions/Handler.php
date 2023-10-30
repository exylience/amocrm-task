<?php

namespace App\Exceptions;

use AmoCRM\AmoAPIException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->reportable(function (AmoAPIException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        });
    }
}
