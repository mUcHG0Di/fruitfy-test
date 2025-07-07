<?php

namespace App\Models;

use App\Notifications\ContactDeletedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone'];

    protected static function booted()
    {
        static::deleting(function ($contact) {
            $deletedBy = auth()->user()->name ?? 'System';
            
            // Send notification before deletion
            auth()->user()->notify(
                new ContactDeletedNotification($contact, $deletedBy)
            );
        });
    }
}
