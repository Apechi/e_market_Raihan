<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'no_faktur',
        'tgl_faktur',
        'total_bayar',
        'customer_id',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'tgl_faktur' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function ordershells()
    {
        return $this->hasMany(Ordershell::class);
    }
}
