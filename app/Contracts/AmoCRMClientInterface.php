<?php

namespace App\Contracts;

use App\Services\Amo\Models\Contact;
use App\Services\Amo\Models\Lead;

interface AmoCRMClientInterface
{
    public function searchContacts(mixed $query, int $limit = 1): array;

    public function getContact(int $contactId): Contact;

    public function createContact(Contact $contact, array $customFields): Contact;

    public function searchLeads(mixed $query, int $limit = 1): array;

    public function getLead(int $leadId): Lead;

    public function addLead(Lead $lead, Contact $contact): Lead;
}
