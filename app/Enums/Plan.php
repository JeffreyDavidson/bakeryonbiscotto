<?php

namespace App\Enums;

enum Plan: string
{
    case Starter = 'starter';
    case Growth = 'growth';
    case Pro = 'pro';

    public static function fromRoute(string $plan): ?self
    {
        return self::tryFrom($plan);
    }

    public static function fromStripePriceId(?string $stripePriceId): ?self
    {
        if ($stripePriceId === null) {
            return null;
        }

        foreach (self::cases() as $plan) {
            if ($plan->stripePriceId() === $stripePriceId) {
                return $plan;
            }
        }

        return null;
    }

    public function label(): string
    {
        return config("saas.plans.{$this->value}.name", ucfirst($this->value));
    }

    public function level(): int
    {
        return match ($this) {
            self::Starter => 1,
            self::Growth => 2,
            self::Pro => 3,
        };
    }

    public function stripePriceId(): ?string
    {
        return config("saas.stripe_prices.{$this->value}");
    }

    public function includes(self $plan): bool
    {
        return $this->level() >= $plan->level();
    }
}
