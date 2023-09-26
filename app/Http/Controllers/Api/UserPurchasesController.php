<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;
use App\Http\Resources\PurchaseCollection;

class UserPurchasesController extends Controller
{
    public function index(Request $request, User $user): PurchaseCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $purchases = $user
            ->purchases()
            ->search($search)
            ->latest()
            ->paginate();

        return new PurchaseCollection($purchases);
    }

    public function store(Request $request, User $user): PurchaseResource
    {
        $this->authorize('create', Purchase::class);

        $validated = $request->validate([
            'kode_masuk' => ['required', 'max:50', 'string'],
            'tanggal_masuk' => ['required', 'date'],
            'total' => ['required', 'numeric'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
        ]);

        $purchase = $user->purchases()->create($validated);

        return new PurchaseResource($purchase);
    }
}
