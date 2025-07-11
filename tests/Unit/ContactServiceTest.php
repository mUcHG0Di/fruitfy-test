<?php

namespace Tests\Unit;

use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactResourceCollection;
use App\Models\Contact;
use App\Models\User;
use App\Services\ContactService;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ContactServiceTest extends TestCase
{
    private ContactService $contactService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->contactService = new ContactService();
        $this->actingAs(
            User::factory()->create()
        );
    }

    #[Test]
    public function it_can_get_contacts(): void
    {
        $contacts = Contact::factory(10)->create();
        $result = $this->contactService->listContacts();

        $this->assertInstanceOf(ContactResourceCollection::class, $result);
        $this->assertEquals($contacts->count(), $result->count());
    }

    #[Test]
    public function it_can_create_contact(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+1234567890'
        ];

        $contact = $this->contactService->storeContact($data);

        $this->assertInstanceOf(ContactResource::class, $contact);
        $this->assertEquals($data['name'], $contact->name);
        $this->assertDatabaseHas('contacts', $data);
    }
    
    #[Test]
    public function it_can_update_contact(): void
    {
        $contact = Contact::factory()->create();
        $updateData = ['name' => 'Updated Name'];

        $result = $this->contactService->updateContact($contact->id, $updateData);

        $this->assertTrue($result);
        
        $updatedContact = Contact::findOrFail($contact->id);

        $this->assertEquals('Updated Name', $updatedContact->name);
    }

    #[Test]
    public function it_can_delete_contact(): void
    {
        $contact = Contact::factory()->create();

        $result = $this->contactService->deleteContact($contact->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }
}
