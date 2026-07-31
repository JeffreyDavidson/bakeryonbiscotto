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
        $user = $request->user();
        $currentPlan = $user?->currentPlan();

        return view('billing.plans', [
            'plans' => config('saas.plans'),
            'currentPlan' => $currentPlan,
            'trialDays' => config('saas.trial_days', 30),
        ]);
    }

    /**
     * Redirect to Stripe Checkout for the selected plan.
     */
    public function checkout(Request $request, Plan $plan)
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

    /**
     * Redirect to Stripe billing portal.
     */
    public function portal(Request $request)
    {
        return $request->user()->redirectToBillingPortal(route('billing.plans'));
    }

    /**
     * Cancel the user's subscription.
     */
    public function cancel(Request $request)
    {
        $request->user()->subscription('default')->cancel();

        return redirect()->route('billing.plans')
            ->with('success', 'Your subscription has been cancelled. You will retain access until the end of your billing period.');
    }

    /**
     * Swap to a different plan.
     */
    public function swap(Request $request, Plan $plan)
    {
        $request->user()->subscription('default')->swap($plan->stripePriceId());

        return redirect()->route('billing.plans')
            ->with('success', 'Your plan has been updated!');
    }
}
