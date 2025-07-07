<?php

namespace App\Console\Commands;

use App\Models\Contact;
use Illuminate\Console\Command;
use Throwable;

class UpdatePhoneNumbersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-phone-numbers-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update phone numbers that were factory created and contains special characters';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $contacts = Contact::all();

            foreach ($contacts as $contact) {
                if (! is_numeric($contact->phone)) {
                    $contact->phone = preg_replace('/\D/', '', $contact->phone);
                    $contact->save();
                }
            }

            $this->info('Phone numbers updated successfully');

            return self::SUCCESS;
        } catch (Throwable $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }
    }
}
