<?php

namespace App\Enums;

use RuntimeException;

enum Plan: string
{
    case Starter = 'starter';
    case Growth = 'growth';
    case Pro = 'pro';

    public function stripePriceId(): string
    {
        $priceId = config("saas.stripe_prices.{$this->value}");

        if (! is_string($priceId) || $priceId === '') {
            throw new RuntimeException("Missing Stripe price configuration for [{$this->value}] plan.");
        }

        return $priceId;
    }

    public static function fromStripePriceId(?string $priceId): ?self
    {
        if ($priceId === null) {
            return null;
        }

        foreach (self::cases() as $plan) {
            if ($plan->stripePriceId() === $priceId) {
                return $plan;
            }
        }

        return null;
    }

    public function includes(self $requiredPlan): bool
    {
        return $this->tier() >= $requiredPlan->tier();
    }

    private function tier(): int
    {
        return match ($this) {
            self::Starter => 1,
            self::Growth => 2,
            self::Pro => 3,
        };
    }
}
