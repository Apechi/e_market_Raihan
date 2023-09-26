<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'kode_transaksi',
        'tgl_bayar',
        'user_input',
        'rombel_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'tgl_bayar' => 'date',
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }
}
