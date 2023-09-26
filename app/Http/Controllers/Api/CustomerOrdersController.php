<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class CustomerOrdersController extends Controller
{
    public function index(Request $request, Customer $customer): OrderCollection
    {
        $this->authorize('view', $customer);

        $search = $request->get('search', '');

        $orders = $customer
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    public function store(Request $request, Customer $customer): OrderResource
    {
        $this->authorize('create', Order::class);

        $validated = $request->validate([
            'no_faktur' => ['required', 'max:50', 'string'],
            'tgl_faktur' => ['required', 'date'],
            'total_bayar' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $order = $customer->orders()->create($validated);

        return new OrderResource($order);
    }
}
