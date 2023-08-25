<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(DetailTransaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
