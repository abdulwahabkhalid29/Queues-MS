<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Counter;

class CounterController extends Controller
{
    public function index(){
        $counters = Counter::get();
        return view('admin.pages.counter.index',compact('counters'));
    }
    public function create()
    {
        $businesses = Business::get();
        return view('admin.pages.counter.create', compact('businesses'));
    }
    public function store(Request $request){
        $request->validate([
            'business_id' => 'required',
            'counter_number' => 'required',
        ]);
        $store = Counter::create([
            'business_id' => $request->business_id,
            'counter_number' => $request->counter_number,
        ]);

        if(!empty($store->id)){
            return redirect()->route('counter.index')->with('success' , 'Counter Created Successfully!');
        }else{
            return redirect()->back()->with('error' , 'Something went wrong');
        }
    }
    public function edit(string $id)
    {
        $businesses = Business::all();
        $counter = Counter::where('counter_id',$id)->firstOrFail();
        return view('admin.pages.counter.edit',compact('counter','businesses'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'business_id' => 'required',
            'counter_number' => 'required',
        ]);

        $update = Counter::where('counter_id',$id)->update([
            'business_id' => $request->business_id,
            'counter_number' => $request->counter_number,
        ]);
    if($update > 0){
            return redirect()->route('counter.index')->with('success' , 'Counter Updated Successfully!');
        }
        return redirect()->back()->with('error' , 'Something went wrong');
    }
    public function destroy($id){
        $delete = Counter::where('counter_id', $id)->delete();
        if (!empty($delete)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Counter deleted successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Something went wrong',
            ]);
        }
    }
}
