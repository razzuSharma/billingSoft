<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::with('company.user')->get();
        return view('product.index', ['product'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::all();
        return view('product.create', ['company'=>$company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->code=$request->code;
        $product->barcode=$request->barcode;
        $product->name=$request->name;
        $product->category=$request->category;
        $product->unit=$request->unit;
        $product->pack=$request->pack;
        $product->company_id=$request->company_id;
        $product->user_id= Auth::id();
        $product->save();

        return redirect()->route('product.index')->with('success', 'Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $company = Company::all();
        return view('product.edit', ['product'=>$product, 'company'=>$company]);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $id)
    {
        $product = Product::find($id);
        $product->code=$request->code;
        $product->barcode=$request->barcode;
        $product->name=$request->name;
        $product->category=$request->category;
        $product->unit=$request->unit;
        $product->pack=$request->pack;
        $product->company_id=$request->company_id;
        $product->user_id= Auth::id();
        $product->save();

        return redirect()->route('product.index')->with('success', 'Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
