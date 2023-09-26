<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseDetailResource;
use App\Http\Resources\PurchaseDetailCollection;

class ItemPurchaseDetailsController extends Controller
{
    public function index(
        Request $request,
        Item $item
    ): PurchaseDetailCollection {
        $this->authorize('view', $item);

        $search = $request->get('search', '');

        $purchaseDetails = $item
            ->purchaseDetails()
            ->search($search)
            ->latest()
            ->paginate();

        return new PurchaseDetailCollection($purchaseDetails);
    }

    public function store(Request $request, Item $item): PurchaseDetailResource
    {
        $this->authorize('create', PurchaseDetail::class);

        $validated = $request->validate([
            'purchase_id' => ['required', 'exists:purchases,id'],
            'harga_beli' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
            'sub_total' => ['required', 'numeric'],
        ]);

        $purchaseDetail = $item->purchaseDetails()->create($validated);

        return new PurchaseDetailResource($purchaseDetail);
    }
}
