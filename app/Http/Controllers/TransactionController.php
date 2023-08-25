<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DetailTransaction;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == "admin") {
            $transactions = Transaction::all();
        } else {
            $transactions = Transaction::where('user_id', auth()->user()->id)->get();
        }
        return view('transaction', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $carts = Cart::with('product')->where('user_id', auth()->user()->id)->get();
        // dd($data);
        DB::transaction(function () use ($data, $carts) {
            $transaction = Transaction::create([
                'user_id' => auth()->user()->id,
                'ekspedisi' => $data['ekspedisi'],
                'nohp' => $data['nohp'],
                'noinv' => "INV" . time(),
                'namapenerima' => $data['namapenerima'],
                'address' => $data['address']
            ])->id;

            foreach ($carts as $cart) {
                DetailTransaction::create([
                    'transaction_id' => $transaction,
                    'product_id' => $cart->product_id,
                    'qty' => $cart->qty,
                    'price' => $cart->product->price,
                ]);
            }
        });
        Cart::where('user_id', auth()->user()->id)->delete();

        toast('Berhasil Checkout', 'success');
        return redirect()->route('thanks');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $transactions = Transaction::with('user', 'detailTransaction.product')->find($id);
        return response()->json($transactions);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $transaction = Transaction::find($id);
        if ($request->type == "image") {
            $data['image'] = $request->file('image')->store(
                'image/buktibayar',
                'public'
            );
            $transaction->update(['image' => $data['image']]);
        } else {
            $transaction->update(['status' => $request->status]);
        }

        toast('Transaction berhasil diupdate', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
