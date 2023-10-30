<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Services\Amo\AmoCRMService createContact(string $name, string $email, string $phone)
 * @method static \App\Services\Amo\AmoCRMService addCustomField(\App\Enums\CustomField $field, mixed $value)
 * @method static \App\Services\Amo\AmoCRMService addLead(int|float $price)
 *
 * @see \App\Services\Amo\AmoCRMService
 */
class Amo extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'amo';
    }
}
