<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::all();
        return view('supplier.index', ['supplier'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supplier=new Supplier;
        $supplier->name=$request->name;
        $supplier->address=$request->address;
        $supplier->contact=$request->contact;
        $supplier->contact_person=$request->contact_person;
        $supplier->pan_no=$request->pan_no;
        $supplier->email=$request->email;
        $supplier->remark=$request->remark;
        $supplier->user_id= Auth::id();
        
        $supplier->save();
        return redirect()->route('supplier.index')->with('success', 'Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('supplier.edit', ['supplier'=>$supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier, $id)
    {
        $supplier= Supplier::find($id);
        $supplier->name=$request->name;
        $supplier->address=$request->address;
        $supplier->contact=$request->contact;
        $supplier->contact_person=$request->contact_person;
        $supplier->pan_no=$request->pan_no;
        $supplier->email=$request->email;
        $supplier->remark=$request->remark;
        $supplier->user_id= Auth::id();
        
        $supplier->save();
        return redirect()->route('supplier.index')->with('success', 'Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
