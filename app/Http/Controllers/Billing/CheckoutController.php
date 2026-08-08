<?php

namespace App\Http\Controllers\Billing;

use App\Enums\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckoutController extends Controller
{
    public function __invoke(Request $request, Plan $plan): Response
    {
        return $request->user()
            ->newSubscription('default', $plan->stripePriceId())
            ->trialDays(config('saas.trial_days', 30))
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('dashboard').'?checkout=success',
                'cancel_url' => route('billing.plans'),
            ]);
    }
}
