<?php

namespace App\Http\Controllers;

use App\Models\CustomerFavorite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'product_id' => 'required|exists:products,id',
        ]);

        $existing = CustomerFavorite::where('customer_email', $request->email)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['favorited' => false]);
        }

        CustomerFavorite::create([
            'customer_email' => $request->email,
            'product_id' => $request->product_id,
        ]);

        return response()->json(['favorited' => true]);
    }

    public function index(string $email): JsonResponse
    {
        $favorites = CustomerFavorite::where('customer_email', $email)
            ->pluck('product_id')
            ->toArray();

        return response()->json(['favorites' => $favorites]);
    }
}
