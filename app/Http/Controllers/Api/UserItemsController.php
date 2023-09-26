<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;

class UserItemsController extends Controller
{
    public function index(Request $request, User $user): ItemCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $items = $user
            ->items()
            ->search($search)
            ->latest()
            ->paginate();

        return new ItemCollection($items);
    }

    public function store(Request $request, User $user): ItemResource
    {
        $this->authorize('create', Item::class);

        $validated = $request->validate([
            'kode_barang' => ['required', 'max:50', 'string'],
            'nama_barang' => ['required', 'max:255', 'string'],
            'satuan' => ['required', 'max:10', 'string'],
            'harga_jual' => ['required', 'numeric'],
            'stok' => ['required', 'max:5', 'string'],
            'ditarik' => ['required', 'numeric'],
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $item = $user->items()->create($validated);

        return new ItemResource($item);
    }
}
