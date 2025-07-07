<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactResourceCollection;

interface ContactServiceInterface
{
    public function listContacts(array $filters = []): ContactResourceCollection;
    public function storeContact(array $data): ContactResource;
    public function getContact(int $id): ContactResource;
    public function updateContact(int $id, array $data): bool;
    public function deleteContact(int $id): bool;
}
