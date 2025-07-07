<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactDeletedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Contact $contact,
        public string $deletedBy
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Contact Deleted - ' . $this->contact->name)
            ->greeting('Hello ' . $notifiable->name)
            ->line('A contact has been deleted from your account.')
            ->line('**Contact Details:**')
            ->line('Name: ' . $this->contact->name)
            ->line('Email: ' . $this->contact->email)
            ->line('Phone: ' . $this->contact->phone)
            ->line('Deleted by: ' . $this->deletedBy)
            ->line('Deleted at: ' . now()->format('M d, Y \a\t g:i A'))
            ->salutation('Best regards, ' . config('app.name'));
    }
}
