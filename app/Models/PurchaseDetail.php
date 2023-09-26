<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseDetail extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'purchase_id',
        'item_id',
        'harga_beli',
        'jumlah',
        'sub_total',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'purchase_details';

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
