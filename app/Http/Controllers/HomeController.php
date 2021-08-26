<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Customer;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $company = Company::latest()->where('status', 'active')->get()->take(5);
        $supplier = Supplier::latest()->get()->take(5);
        $product = Product::latest()->get()->take(5);
        $customer = Customer::latest()->get()->take(5);
        return view('home',compact(['company','supplier', 'product', 'customer']));
    }
}
