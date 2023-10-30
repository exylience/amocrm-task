<?php

use App\Http\Controllers\api\BidController;
use Illuminate\Support\Facades\Route;

Route::post('bids', [BidController::class, 'store']);
