<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ContactServiceInterface;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

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
            'contacts' => $this->contactService->listContacts(request()->all()),
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

        return redirect()
            ->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return inertia()->render('Contacts/Show', [
            'contact' => $this->contactService->getContact($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return inertia()->render('Contacts/Edit', [
            'contact' => $this->contactService->getContact($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, int $id)
    {
        $result = $this->contactService->updateContact($id, $request->validated());

        return redirect()
            ->route('contacts.index')
            ->with(
                'success',
                $result ? 'Contact updated successfully.' : 'Contact not updated.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $result = $this->contactService->deleteContact($id);

        return redirect()
            ->back()
            ->with(
                'success',
                $result ? 'Contact deleted successfully.' : 'Contact not deleted.'
            );
    }
}
