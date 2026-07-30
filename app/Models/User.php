<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use Billable, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    /**
     * Get the user's current subscription plan key.
     */
    public function currentPlan(): ?string
    {
        $subscription = $this->subscription('default');

        if (! $subscription) {
            return null;
        }

        $priceId = $subscription->stripe_price;

        $stripePrices = config('saas.stripe_prices', []);

        return match ($priceId) {
            $stripePrices['starter'] ?? null => 'starter',
            $stripePrices['growth'] ?? null => 'growth',
            $stripePrices['pro'] ?? null => 'pro',
            default => null,
        };
    }

    /**
     * Check if user has at least the given plan tier.
     */
    public function hasPlan(string $plan): bool
    {
        $hierarchy = ['starter' => 1, 'growth' => 2, 'pro' => 3];
        $currentLevel = $hierarchy[$this->currentPlan()] ?? 0;
        $requiredLevel = $hierarchy[$plan] ?? 0;

        return $currentLevel >= $requiredLevel;
    }
}
