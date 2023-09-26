<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nama_pemasok'];

    protected $searchableFields = ['*'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
