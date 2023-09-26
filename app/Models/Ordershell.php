<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ordershell extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['order_id', 'total', 'terima', 'kembali'];

    protected $searchableFields = ['*'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
