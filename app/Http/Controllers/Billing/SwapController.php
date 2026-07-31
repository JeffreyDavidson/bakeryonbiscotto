<?php

namespace App\Http\Controllers\Billing;

use App\Enums\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SwapController extends Controller
{
    public function __invoke(Request $request, Plan $plan): RedirectResponse
    {
        $request->user()->subscription('default')->swap($plan->stripePriceId());

        return redirect()->route('billing.plans')
            ->with('success', 'Your plan has been updated!');
    }
}
