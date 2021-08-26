<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PurchaseItem;
use App\Models\ProductDetail;
use App\Models\SupplierLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Purchase::all();
        return view('purchase.index', ['purchase'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        return view('purchase.create', ['supplier'=>$supplier]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchase = new Purchase;
        $purchase->date=$request->date;
        $purchase->invoice_no=$request->invoice_no;
        $purchase->supplier_id=$request->supplier_id;
        $purchase->purchase_type=$request->purchase_type;
        $purchase->user_id=Auth::id();
        $purchase->remark=$request->remark;
        $purchase->save();

        if ($purchase->purchase_type == "Direct" || $purchase->purchase_type == "Order") {
            return redirect()->route('purchaseitem.add', ['id'=>$purchase->id]);
        }
        else {
            return redirect()->route('purchase.return', ['id' => $purchase->id]);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function showBill($id) //purchase id
    {
        $purchase = Purchase::find($id);
        $purchase->status = "Completed";
        $purchase->save();
        $purchaseItem = PurchaseItem::where('purchase_id', $id)->get();
        $totalAmount = PurchaseItem::where('purchase_id', $id)->sum('amount');
        $discountAmount = PurchaseItem::where('purchase_id', $id)->sum('discount_amount');
        $getBalance = SupplierLedger::where('supplier_id', $purchase->supplier_id)->get('balance')->last();

        //Adding into supplierledger table
        $supplierLedger = new SupplierLedger;
        if ($purchase->purchase_type != 'Return'){
            $supplierLedger->date = $purchase->date;
            $supplierLedger->invoice_no = $purchase->invoice_no;
            $supplierLedger->purchase_type = $purchase->purchase_type;
            $supplierLedger->supplier_id = $purchase->supplier_id;
            $supplierLedger->user_id = Auth::id();
            $supplierLedger->cr = (($totalAmount - $discountAmount) + $purchase->shipping_cost) - (($purchase->adjustable_discount/100) * ($totalAmount - $discountAmount));
            $supplierLedger->balance = empty($getBalance) ? $supplierLedger->cr : $supplierLedger->cr + $getBalance->balance;
            $supplierLedger->save();
        }
        else{
            $supplierLedger->date = $purchase->date;
            $supplierLedger->invoice_no = $purchase->invoice_no;
            $supplierLedger->purchase_type = $purchase->purchase_type;
            $supplierLedger->supplier_id = $purchase->supplier_id;
            $supplierLedger->user_id = Auth::id();
            $supplierLedger->dr = (($totalAmount - $discountAmount) + $purchase->shipping_cost) - (($purchase->adjustable_discount/100) * ($totalAmount - $discountAmount));
            $supplierLedger->balance = $getBalance->balance - $supplierLedger->dr;
            $supplierLedger->save();
        }
        return view('purchase.bill', [
            'purchaseitem'=>$purchaseItem,
            'purchase'=>$purchase, 
            'totalamount'=>$totalAmount, 
            'discountamount'=>$discountAmount,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::find($id);
        $supplier = Supplier::all();
        return view('purchase.edit', ['purchase'=>$purchase, 'supplier'=>$supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase, $id)
    {
        $purchase = Purchase::find($id);
        $purchase->date=$request->date;
        $purchase->invoice_no=$request->invoice_no;
        $purchase->supplier_id=$request->supplier_id;
        $purchase->purchase_type=$request->purchase_type;
        $purchase->user_id=Auth::id();
        $purchase->remark=$request->remark;
        $purchase->save();

        return redirect()->route('purchase.index')->with('success', 'Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }

    //completes purchase and makes bill
    public function completePurchase(Request $request, $id)
    {
        $purchase = Purchase::find($id);
        $purchase->shipping_cost = $request->shipping_cost;
        $purchase->adjustable_discount = $request->adjustable_discount;
        $purchase->save();
        return redirect()->route('purchase.bill', ['id'=>$purchase->id]);
    }

    // Opens returning form
    public function purchaseReturn($id) //purchase id
    {
        $purchase = Purchase::find($id);
        $purchases = Purchase::where('supplier_id', $purchase->supplier_id)
                                ->get();
        $stocks = ProductDetail::all();
        $returnedItems = PurchaseItem::where('purchase_id', $id)->get();
        $totalAmount = PurchaseItem::where('purchase_id', $id)->sum('amount');
        $discountAmount = PurchaseItem::where('purchase_id', $id)->sum('discount_amount');
        return view('purchaseitem.return', [
            'purchase' => $purchase,
            'purchases' => $purchases,
            'stocks' => $stocks,
            'returnedItems' => $returnedItems,
            'totalAmount' => $totalAmount,
            'discountAmount' => $discountAmount,
        ]);
    }
}
