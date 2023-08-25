<?php

namespace App\Helpers;

use App\Models\Cart;

class General
{
    public static function rp($val)
    {
        return "Rp " . number_format($val, 0, ",", ".");
    }

    public static function countCart()
    {
        $cart = Cart::where('user_id', auth()->user()->id)->count();

        return $cart;
    }
}
