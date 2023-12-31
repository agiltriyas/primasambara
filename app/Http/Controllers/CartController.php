<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', auth()->user()->id)->get();
        return view('cart', compact('carts'));
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
        //cek stock
        // dd($data['stock']);
        $product = Product::find($data['id']);
        if ($product->qty < $data['qty']) {
            toast('Product kuantitas melebihi jumlah stock', 'error');
            return redirect()->route('product.index');
        }

        Cart::updateOrCreate([
            'user_id' => auth()->user()->id,
            'product_id' => $data['id']
        ], [
            'user_id' => auth()->user()->id,
            'product_id' => $data['id'],
            'qty' => $data['qty'],
        ]);

        toast('Product berhasil ditambahkan ke keranjang', 'success');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $cart = Cart::find($id);
        $cart->update(['qty' => $request->qty]);

        toast('Keranjang berhasil diupdate', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        toast('Keranjang berhasil diupdate', 'success');
        return redirect()->back();
    }
}
