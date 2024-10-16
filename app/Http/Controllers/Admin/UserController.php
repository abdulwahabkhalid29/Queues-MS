<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::get();
        return view('admin.pages.user.index',compact('users'));
    }
    public function create()
    {
        return view('admin.pages.user.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required',
            'password' => 'required',
        ], [
            'email.unique' => 'This email is already in use. Please choose a different one.'
        ]);
        $store = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        if(!empty($store->id)){
            return redirect()->route('user.index')->with('success' , 'User Created Successfully!');
        }else{
            return redirect()->back()->with('error' , 'Something went wrong');
        }
    }
    public function edit(string $id)
    {
        $user = User::where('user_id',$id)->firstOrFail();
        return view('admin.pages.user.edit',compact('user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
        ]);
    
        $user = User::where('user_id', $id)->firstOrFail();
    
        if ($request->email != $user->email) {
            $request->validate([
                'email' => 'unique:users',
            ], [
                'email.unique' => 'This email is already in use. Please choose a different one.'
            ]);
        }
    
        $update = User::where('user_id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);
    
        if ($request->filled('password')) {
            User::where('user_id', $id)->update(['password' => Hash::make($request->password)]);
        }
    
        if ($update > 0) {
            return redirect()->route('user.index')->with('success', 'User  Updated Successfully!');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }
    public function destroy($id){
        $delete = User::where('user_id', $id)->delete();
        if (!empty($delete)) {
            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Something went wrong',
            ]);
        }
    }

}
