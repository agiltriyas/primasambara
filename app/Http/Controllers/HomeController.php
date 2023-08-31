<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['product'] = Product::count();
        $data['customer'] = User::where('role', 'customer')->count();
        $data['transaction'] = Transaction::count();
        return view('home', compact('data'));
    }

    public function welcome()
    {
        $products = Product::all();

        return view('welcome', compact('products'));
    }
}
