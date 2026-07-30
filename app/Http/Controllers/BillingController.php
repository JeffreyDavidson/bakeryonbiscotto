<?php

namespace App\Http\Controllers;

use App\Enums\Plan;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    /**
     * Show the plan selection page.
     */
    public function plans(Request $request)
    {
        return view('billing.plans', [
            'plans' => config('saas.plans'),
            'currentPlan' => $request->user()?->currentPlan(),
        ]);
    }

    /**
     * Redirect to Stripe Checkout for the selected plan.
     */
    public function checkout(Request $request, string $plan)
    {
        $subscriptionPlan = Plan::fromRoute($plan) ?? abort(404);

        return $request->user()
            ->newSubscription('default', $subscriptionPlan->stripePriceId())
            ->trialDays(config('saas.trial_days', 30))
            ->allowPromotionCodes()
            ->checkout([
                'success_url' => route('billing.success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('billing.plans'),
            ]);
    }

    /**
     * Handle successful checkout.
     */
    public function success(Request $request)
    {
        return view('billing.success');
    }

    /**
     * Redirect to Stripe Customer Portal for managing subscription.
     */
    public function portal(Request $request)
    {
        return $request->user()->redirectToBillingPortal(route('filament.admin.pages.dashboard'));
    }

    /**
     * Swap to a different plan.
     */
    public function swap(Request $request, string $plan)
    {
        $subscriptionPlan = Plan::fromRoute($plan) ?? abort(404);

        $request->user()->subscription('default')->swap($subscriptionPlan->stripePriceId());

        return redirect()->route('billing.plans')
            ->with('success', 'Your plan has been updated!');
    }
}
