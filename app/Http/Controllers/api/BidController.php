<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBidRequest;
use App\Jobs\AmoSendBidJob;
use Illuminate\Http\JsonResponse;

class BidController extends Controller
{
    public function store(StoreBidRequest $request): JsonResponse
    {
        AmoSendBidJob::dispatch(
            $request->input('name'),
            $request->input('email'),
            $request->input('phone'),
            $request->input('price')
        );

        return response()->json();
    }
}
