<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rombel extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nama_rombel'];

    protected $searchableFields = ['*'];

    protected $table = 'rombel';

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
