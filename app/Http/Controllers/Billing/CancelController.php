<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CancelController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $request->user()->subscription('default')->cancel();

        return redirect()->route('billing.plans')
            ->with('success', 'Your subscription has been cancelled. You will retain access until the end of your billing period.');
    }
}
