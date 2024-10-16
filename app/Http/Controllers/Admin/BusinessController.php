<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;

class BusinessController extends Controller
{
    public function index(){
        $businesses = Business::get();
        return view('admin.pages.business.index',compact('businesses'));
    }
    public function create()
    {
        $users = User::get();
        return view('admin.pages.business.create', compact('users'));
    }
    public function store(Request $request){
        $request->validate([
            'user_id' => 'required',
            'business_name' => 'required',
            'business_type' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:businesses',
        ], [
            'email.unique' => 'This email is already in use. Please choose a different one.'
        ]); 
        $store = Business::Create([
            'user_id' => $request->user_id,
            'business_name' => $request->business_name,
            'business_type' => $request->business_type,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'email' => $request->email,
        ]);

        if(!empty($store->id)){
            return redirect()->route('business.index')->with('success' , 'Business Created Successfully!');
        }else{
            return redirect()->back()->with('error' , 'Something went wrong');
        }
    }
    public function edit(string $id)
    {
        $business = Business::where('business_id',$id)->firstOrFail();
        $users = User::all();
        return view('admin.pages.business.edit',compact('business','users'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'business_name' => 'required',
            'business_type' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'email' => 'required',
        ]);
        $business = Business::where('business_id', $id)->firstOrFail();
    
        if ($request->email != $business->email) {
            $request->validate([
                'email' => 'unique:businesses',
            ], [
                'email.unique' => 'This email is already in use. Please choose a different one.'
            ]);
        }

        $update = Business::where('business_id',$id)->update([
            'user_id' => $request->user_id,
            'business_name' => $request->business_name,
            'business_type' => $request->business_type,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'email' => $request->email,
        ]);
    if($update > 0){
            return redirect()->route('business.index')->with('success' , 'Business Updated Successfully!');
        }
        return redirect()->back()->with('error' , 'Something went wrong');
    }
    public function destroy($id){
        $delete = Business::where('business_id', $id)->delete();
        if (!empty($delete)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Business deleted successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Something went wrong',
            ]);
        }
    }
}
