<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseResource;
use App\Http\Resources\PurchaseCollection;

class SupplierPurchasesController extends Controller
{
    public function index(
        Request $request,
        Supplier $supplier
    ): PurchaseCollection {
        $this->authorize('view', $supplier);

        $search = $request->get('search', '');

        $purchases = $supplier
            ->purchases()
            ->search($search)
            ->latest()
            ->paginate();

        return new PurchaseCollection($purchases);
    }

    public function store(
        Request $request,
        Supplier $supplier
    ): PurchaseResource {
        $this->authorize('create', Purchase::class);

        $validated = $request->validate([
            'kode_masuk' => ['required', 'max:50', 'string'],
            'tanggal_masuk' => ['required', 'date'],
            'total' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $purchase = $supplier->purchases()->create($validated);

        return new PurchaseResource($purchase);
    }
}
