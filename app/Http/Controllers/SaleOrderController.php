<?php

namespace App\Http\Controllers;

use App\Models\SaleOrder;
use App\Models\Sale;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
//34,930

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $stock = ProductDetail::all();
        $sales = Sale::find($id);
        $salesOrder = SaleOrder::where('sale_id', $id)->get();
        return view('saleorder.create', [
            'stock' => $stock,
            'sales' => $sales,
            'salesOrder' => $salesOrder
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $saleOrder = new SaleOrder;
        $saleOrder->sale_id = $id;
        $saleOrder->product_detail_id = $request->product_detail_id;
        $saleOrder->quantity = $request->quantity;
        $saleOrder->rate = $request->rate;
        $saleOrder->amount = $request->quantity * $request->rate;
        $saleOrder->discount_percent = $request->discount_percent;
        $saleOrder->discountAmount = $request->discount_percent / 100 * $saleOrder->amount;
        $saleOrder->profit_per_item = 0;
        $saleOrder->total_profit = 0;
        $saleOrder->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SaleOrder $saleOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleOrder $saleOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleOrder $saleOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleOrder $saleOrder)
    {
        //
    }
}
