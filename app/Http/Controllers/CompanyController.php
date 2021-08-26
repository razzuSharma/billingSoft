<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Company::where('status', 'active')
                        ->with('user')
                        ->get();
        return view('company.index', ['company'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'country' => 'required'
        ]);
        $company = new Company;
        $company->name=$request->name;
        $company->address=$request->address;
        $company->country=$request->country;
        $company->user_id= Auth::id();
        // $company->status ='Active';

        $company->save();
        return redirect()->route('company.index')->with('success', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('company.edit', ['company'=>$company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company, $id)
    {
        $company = Company::find($id);
        $company->name=$request->name;
        $company->address=$request->address;
        $company->country=$request->country;
        $company->save();
        return redirect()->route('company.index')->with('success', 'Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Product::where('company_id',$id)->count() > 0) {
            $company = Company::where('id', $id)->update(['status'=>'inactive']);
            return redirect()->route('company.index')->with('remove', 'Inactive');
        } else {
            $company = Company::findorfail($id);
            $company->delete();
            return redirect()->route('company.index')->with('remove', 'Deleted');
        }
        
    }
}
