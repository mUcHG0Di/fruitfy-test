<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\ContactServiceInterface;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactResourceCollection;
use App\Models\Contact;

final class ContactService implements ContactServiceInterface
{
    public function getContacts(array $filters = []): ContactResourceCollection
    {
        //
    }

    public function storeContact(array $data): ContactResource
    {
        //
    }

    public function updateContact(int $id, array $data): ContactResource
    {
        // 
    }

    public function deleteContact(int $id): bool
    {
        //
    }
}
