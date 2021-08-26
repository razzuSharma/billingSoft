<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // SHows the main Page, all the sales list
    public function index()
    {
        $sales = Sale::all();
        return view('sale.index', [
            'sales' => $sales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Opens page for inserting sales
    public function create()
    {
        $customers = Customer::all();
        return view('sale.create', [
            'customers' => $customers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Stores the provided sales records.
    public function store(Request $request)
    {
        $sales = new Sale;
        $sales->date = $request->date;
        $sales->invoice_no = $request->invoice_no;
        $sales->customer_id = $request->customer_id;
        $sales->sales_type = $request->sales_type;
        $sales->user_id = Auth::id();
        $sales->save();
        return redirect()->route('salesorder.create', [
            'id' => $sales->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    // Edits the existing sale
    public function edit($id)
    {
        $sale = Sale::find($id);
        $customers = Customer::all();
        return view('sale.edit', [
            'sale' => $sale,
            'customers' => $customers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    // Updates when edited
    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);
        $sale->date = $request->date;
        $sale->invoice_no = $request->invoice_no;
        $sale->customer_id = $request->customer_id;
        $sale->sales_type = $request->sales_type;
        $sale->user_id = Auth::id();
        $sale->save();
        return redirect()->route('sales.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
