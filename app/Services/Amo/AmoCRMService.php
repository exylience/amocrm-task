<?php

namespace App\Services\Amo;

use AmoCRM\AmoAPIException;
use App\Enums\CustomField;
use App\Services\Amo\Models\Contact;
use App\Services\Amo\Models\Lead;

class AmoCRMService
{
    private AmoCRMClient $client;

    private Contact $contact;

    private array $customFields;

    public function __construct()
    {
        $this->client = new AmoCRMClient();
    }

    /**
     * @throws AmoAPIException
     */
    public function createContact(string $name, string $email, string $phone): static
    {
        $this->addCustomField(CustomField::Email, $email)
            ->addCustomField(CustomField::Phone, $phone);

        $contact = (new Contact())
            ->setName($name);

        $this->contact = $this->client->createContact($contact, $this->customFields);

        return $this;
    }

    public function addCustomField(CustomField $field, mixed $value): static
    {
        $this->customFields[$field->value] = [[
            'value' => $value,
            'enum' => 'WORK',
        ]];

        return $this;
    }

    /**
     * @throws AmoAPIException
     */
    public function addLead(int $price): static
    {
        $lead = (new Lead)
            ->setPrice($price);

        $this->client->addLead($lead, $this->contact);

        return $this;
    }
}
