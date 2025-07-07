<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\ContactServiceInterface;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactResourceCollection;
use App\Models\Contact;

final class ContactService implements ContactServiceInterface
{
    public function listContacts(array $filters = []): ContactResourceCollection
    {
        return new ContactResourceCollection(
            Contact::paginate(
                perPage: (int) data_get($filters, 'per_page', 10),
                page: (int) data_get($filters, 'page', 1),
                columns: [
                    'id',
                    'name',
                    'email',
                    'phone',
                ]
            )
        );
    }

    public function storeContact(array $data): ContactResource
    {
        $contact = Contact::create($data);

        return new ContactResource($contact);
    }

    public function getContact(int $id): ContactResource
    {
        return new ContactResource(Contact::findOrFail($id));
    }

    public function updateContact(int $id, array $data): ContactResource
    {
        $contact = Contact::findOrFail($id);
        $contact->update($data);

        return new ContactResource($contact);
    }

    public function deleteContact(int $id): bool
    {
        return Contact::findOrFail($id)->delete();
    }
}
