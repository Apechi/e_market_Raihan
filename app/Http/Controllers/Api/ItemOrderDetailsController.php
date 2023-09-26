<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\OrderDetailCollection;

class ItemOrderDetailsController extends Controller
{
    public function index(Request $request, Item $item): OrderDetailCollection
    {
        $this->authorize('view', $item);

        $search = $request->get('search', '');

        $orderDetails = $item
            ->orderDetails()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderDetailCollection($orderDetails);
    }

    public function store(Request $request, Item $item): OrderDetailResource
    {
        $this->authorize('create', OrderDetail::class);

        $validated = $request->validate([
            'order_id' => ['required', 'exists:orders,id'],
            'harga_jual' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
            'sub_total' => ['required', 'numeric'],
        ]);

        $orderDetail = $item->orderDetails()->create($validated);

        return new OrderDetailResource($orderDetail);
    }
}
