<?php

namespace App\Observers;

use App\Models\ContactMessage;
use App\Models\User;
use Filament\Notifications\Notification;

class ContactMessageObserver
{
    public function created(ContactMessage $message): void
    {
        $users = User::all();

        Notification::make()
            ->title('New Contact Message')
            ->body("New message from {$message->name}: {$message->subject}")
            ->icon('heroicon-o-envelope')
            ->warning()
            ->sendToDatabase($users);
    }
}
