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
        if (auth()->user()->role != "customer") {
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
                'notrans' => "TRS" . time(),
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


                //kurangin stock
                $product = Product::find($cart->product_id);
                $qty = $product->qty - $cart->qty;
                $product->update(['qty' => $qty]);
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
        $data = $request->all();

        $transaction = Transaction::with('detailTransaction')->find($id);
        if ($request->type == "image") {
            if (isset($data['image'])) {
                if (strlen($transaction->imagedp) > 0) {
                    $data['image'] = $request->file('image')->store(
                        'image/buktibayar',
                        'public'
                    );
                    $transaction->update(['image' => $data['image']]);
                } else {
                    $data['image'] = $request->file('image')->store(
                        'image/buktibayar',
                        'public'
                    );
                    $transaction->update(['imagedp' => $data['image']]);
                }
            }
            $transaction->update(['bank' => $data['bank']]);
        } else {
            if ($data['status'] == "SJ") {
                $transaction->update(['status' => $request->status, 'nosj' => "SJ" . time()]);
            } elseif ($data['status'] == "INV") {
                $transaction->update(['status' => $request->status, 'noinv' => "INV" . time()]);
            } elseif ($data['status'] == "WIP") {
                $transaction->update(['status' => $request->status, 'nospk' => $transaction->notrans]);
            } elseif ($data['status'] == "REJECT") {
                foreach ($transaction->detailTransaction as $detail) {
                    //tambahin stock
                    $product = Product::find($detail->product_id);
                    $qty = $product->qty + $detail->qty;
                    $product->update(['qty' => $qty]);
                }
            } else {
                $transaction->update(['status' => $request->status]);
            }
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
