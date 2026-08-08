<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShowPlansController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();
        $currentPlan = $user?->currentPlan();

        return view('billing.plans', [
            'plans' => config('saas.plans'),
            'currentPlan' => $currentPlan,
            'trialDays' => config('saas.trial_days', 30),
        ]);
    }
}
