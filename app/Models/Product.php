<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getImageAttribute($value)
    {
        return url('storage/' . $value);
    }

    public function Cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function detailTransaction()
    {
        return $this->hasMany(DetailTransaction::class);
    }
}
