<?php

namespace App\Observers;

use App\Models\Review;
use App\Models\User;
use Filament\Notifications\Notification;

class ReviewObserver
{
    public function created(Review $review): void
    {
        $users = User::all();

        Notification::make()
            ->title('New Review')
            ->body("New {$review->rating}-star review from {$review->name}")
            ->icon('heroicon-o-star')
            ->info()
            ->sendToDatabase($users);
    }
}
