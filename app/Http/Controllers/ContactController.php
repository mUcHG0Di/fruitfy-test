<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Contracts\Services\ContactServiceInterface;

class ContactController extends Controller
{
    public function __construct(
        private ContactServiceInterface $contactService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = $this->contactService->getContacts(request()->all());

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $contactsRequest)
    {
        $data = $contactsRequest->validated();
        $contact = $this->contactService->storeContact($data);

        return view('contacts.index', compact('contact'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, string $id)
    {
        $data = $request->validated();
        $contact = $this->contactService->updateContact($id, $data);

        return view('contacts.index', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->contactService->deleteContact($id);

        return view('contacts.index');
    }
}
