<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;

class ProductItemsController extends Controller
{
    public function index(Request $request, Product $product): ItemCollection
    {
        $this->authorize('view', $product);

        $search = $request->get('search', '');

        $items = $product
            ->items()
            ->search($search)
            ->latest()
            ->paginate();

        return new ItemCollection($items);
    }

    public function store(Request $request, Product $product): ItemResource
    {
        $this->authorize('create', Item::class);

        $validated = $request->validate([
            'kode_barang' => ['required', 'max:50', 'string'],
            'nama_barang' => ['required', 'max:255', 'string'],
            'satuan' => ['required', 'max:10', 'string'],
            'harga_jual' => ['required', 'numeric'],
            'stok' => ['required', 'max:5', 'string'],
            'ditarik' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $item = $product->items()->create($validated);

        return new ItemResource($item);
    }
}
