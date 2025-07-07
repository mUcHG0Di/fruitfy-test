<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ContactServiceInterface;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct(
        private readonly ContactServiceInterface $contactService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia()->render('Contacts/Index', [
            'contacts' => $this->contactService->getContacts(request()->all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia()->render('Contacts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $this->contactService->storeContact($request->validated());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return inertia()->render('Contacts/Show', [
            'contact' => new ContactResource(Contact::findOrFail($id)),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return inertia()->render('Contacts/Edit', [
            'contact' => new ContactResource(Contact::findOrFail($id)),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, string $id)
    {
        $this->contactService->updateContact((int) $id, $request->validated());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->contactService->deleteContact((int) $id);

        return redirect()->back()->with('success', 'Contact deleted successfully.');
    }
}
