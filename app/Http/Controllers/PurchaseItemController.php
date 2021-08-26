<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\ProductDetail;

class PurchaseItemController extends Controller
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
        $product = Product::all();
        $purchase = Purchase::find($id);
        $purchaseitem = PurchaseItem::where('purchase_id', $id)->get();
        $totalamount = PurchaseItem::where('purchase_id', $id)->sum('amount');
        $discountamount = PurchaseItem::where('purchase_id', $id)->sum('discount_amount');

        return view('purchaseitem.create', [
            'product'=>$product, 
            'purchase'=>$purchase, 
            'purchaseitem'=>$purchaseitem, 
            'total'=>$totalamount, 
            'discountAmount'=>$discountamount,
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
        $validated = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
            'rate' => 'required',
            'sp' => 'required',
        ]);
        $purchaseItem = new Purchaseitem;
        $purchaseItem->quantity=$request->quantity;
        $purchaseItem->rate=$request->rate;
        $purchaseItem->amount=$request->quantity * $request->rate;
        $purchaseItem->discount_percent=$request->discount_percent;
        $purchaseItem->discount_amount=$request->discount_percent / 100 * $purchaseItem->amount;
        $purchaseItem->discount_percent=(!empty($purchaseItem->discount_percent)) ? $purchaseItem->discount_percent : 0;
        $purchaseItem->product_id=$request->product_id;
        $purchaseItem->purchase_id=$id;
        $purchaseItem->purchase_item_type='purchase';
        $purchaseItem->save();

        //Saving purchased items into product details aka stock tables
        $stock = new ProductDetail;
        $stock->product_id = $request->product_id;
        $stock->batch = time();
        $stock->quantity = $request->quantity;
        $stock->sp = $request->sp;
        $stock->mrp = $request->mrp;
        $stock->purchase_id = $id;
        $stock->purchase_item_id = $purchaseItem->id;
        // return $stock;
        $stock->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    //Returning purchased item, creates a new record in purchase item database
    public function returnPurchaseItem(Request $request, $id) //purchase id
    {
        $deductStock = ProductDetail::where('purchase_item_id', $request->purchase_item_id)->first();
        $deductStock->quantity = $deductStock->quantity - $request->quantity;
        $deductStock->save();
        $purchaseItem = PurchaseItem::find($request->purchase_item_id); // purchase_item_id

        $returnPurchaseItem = new PurchaseItem;
        $returnPurchaseItem->product_id = $purchaseItem->product_id;
        $returnPurchaseItem->quantity = $request->quantity;
        $returnPurchaseItem->rate = $purchaseItem->rate;
        $returnPurchaseItem->amount = $request->quantity * $purchaseItem->rate;
        $returnPurchaseItem->discount_percent = $purchaseItem->discount_percent;
        $returnPurchaseItem->discount_amount = ($purchaseItem->discount_percent / 100) * $returnPurchaseItem->amount;
        $returnPurchaseItem->purchase_id = $id;
        $returnPurchaseItem->purchase_item_type = 'return';
        $returnPurchaseItem->save();
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //purchaseitem id
    {
        //deleting purchaseitem row
        if (true) {
            $purchaseitem = PurchaseItem::findorfail($id);
            $purchaseitem->delete();
            //deleting productdetail row
            $stock = ProductDetail::findorfail($id);
            $stock->delete();
        }
        return back();
    }
}
