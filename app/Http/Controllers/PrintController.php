<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function sj($id)
    {
        $transaction = Transaction::with('user', 'detailTransaction.product')->find($id);


        return view('sj', compact('transaction'));
    }

    public function inv($id)
    {
        $transaction = Transaction::with('user', 'detailTransaction.product')->find($id);


        return view('invoice', compact('transaction'));
    }
}
