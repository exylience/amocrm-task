<?php

namespace App\Jobs;

use AmoCRM\AmoAPIException;
use App\Facades\Amo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AmoSendBidJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $phone,
        private readonly int|float $price,
    ) {
    }

    /**
     * @throws AmoAPIException
     */
    public function handle(): void
    {
        Amo::createContact($this->name, $this->email, $this->phone)
            ->addLead($this->price);
    }
}
