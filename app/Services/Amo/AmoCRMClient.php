<?php

namespace App\Services\Amo;

use AmoCRM\AmoAPI;
use AmoCRM\AmoAPIException;
use AmoCRM\AmoContact;
use AmoCRM\AmoLead;
use AmoCRM\TokenStorage\FileStorage;
use App\Contracts\AmoCRMClientInterface;
use App\Exceptions\AmoInitException;
use App\Services\Amo\Models\Contact;
use App\Services\Amo\Models\Lead;
use Illuminate\Support\Arr;

class AmoCRMClient implements AmoCRMClientInterface
{
    /**
     * @throws AmoInitException
     */
    public function __construct()
    {
        try {
            $clientId = config('amocrm.credentials.client_id');
            $clientSecret = config('amocrm.credentials.client_secret');
            $authCode = config('amocrm.credentials.auth_code');
            $redirectUri = config('amocrm.credentials.redirect_uri');
            $subdomain = config('amocrm.credentials.subdomain');

            AmoAPI::$tokenStorage = new FileStorage();

            $domain = AmoAPI::getAmoDomain($subdomain);
            $isFirstAuth = ! AmoAPI::$tokenStorage->hasTokens($domain);

            if ($isFirstAuth) {
                AmoAPI::oAuth2($subdomain, $clientId, $clientSecret, $redirectUri, $authCode);
            } else {
                AmoAPI::oAuth2($subdomain);
            }
        } catch (AmoAPIException) {
            throw new AmoInitException();
        }
    }

    public function searchContacts(mixed $query, int $limit = 1): array
    {
        return AmoAPI::getContacts([
            is_int($query) ? 'id' : 'query' => $query,
            'limit_rows' => $limit,
        ]);
    }

    public function getContact(int $contactId): Contact
    {
        $contacts = $this->searchContacts($contactId);

        return new Contact(Arr::first($contacts));
    }

    /**
     * @throws AmoAPIException
     */
    public function createContact(Contact $contact, array $customFields): Contact
    {
        $contactInstance = new AmoContact($contact->toArray());

        $contactInstance->setCustomFields($customFields);

        return $this->getContact($contactInstance->save());
    }

    public function searchLeads(mixed $query, int $limit = 1): array
    {
        return AmoAPI::getLeads([
            is_int($query) ? 'id' : 'query' => $query,
            'limit_rows' => $limit,
        ]);
    }

    public function getLead(int $leadId): Lead
    {
        $contacts = $this->searchLeads($leadId);

        return new Lead(Arr::first($contacts));
    }

    /**
     * @throws AmoAPIException
     */
    public function addLead(Lead $lead, Contact $contact): Lead
    {
        $leadInstance = new AmoLead($lead->toArray());

        $leadInstance->addContacts($contact->getId());

        return $this->getLead($leadInstance->save());
    }
}
