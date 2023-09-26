<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'kode_masuk',
        'tanggal_masuk',
        'total',
        'supplier_id',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
}
