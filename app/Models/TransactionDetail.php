<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'transaction_id',
        'transaction_type_id',
        'jumlah_bayar',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'transaction_details';

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }
}
