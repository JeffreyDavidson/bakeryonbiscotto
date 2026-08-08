<?php

namespace App\Http\Middleware;

use App\Enums\Plan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSubscribed
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ?string $plan = null): Response
    {
        if (! $request->user()?->subscribed('default')) {
            return redirect()->route('billing.plans');
        }

        $requiredPlan = $plan === null ? null : Plan::tryFrom($plan);

        if ($requiredPlan !== null && ! $request->user()->hasPlan($requiredPlan)) {
            abort(403, 'Your current plan does not include this feature. Please upgrade.');
        }

        return $next($request);
    }
}
