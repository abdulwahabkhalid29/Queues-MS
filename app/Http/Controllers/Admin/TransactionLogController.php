<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionLog;
use App\Models\Ticket;

class TransactionLogController extends Controller
{
    public function index(){
        $transaction_logs = TransactionLog::get();
        return view('admin.pages.transactionlog.index',compact('transaction_logs'));
    }
    public function create()
    {
        $tickets = Ticket::get();
        return view('admin.pages.transactionlog.create', compact('tickets'));
    }
    public function store(Request $request){
        $request->validate([
            'ticket_id' => 'required',
            'action' => 'required',
            'timestamp' => 'required',
        ]);
        $store = TransactionLog::create([
            'ticket_id' => $request->ticket_id,
            'action' => $request->action,
            'timestamp' => $request->timestamp,
        ]);

        if(!empty($store->id)){
            return redirect()->route('transactionlog.index')->with('success' , 'TransactionLog Created Successfully!');
        }else{
            return redirect()->back()->with('error' , 'Something went wrong');
        }
    }
    public function edit(string $id)
    {
        $tickets = Ticket::all();
        $transaction_log = TransactionLog::where('transaction_id',$id)->firstOrFail();
        return view('admin.pages.transactionlog.edit',compact('transaction_log','tickets'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'ticket_id' => 'required',
            'action' => 'required',
            'timestamp' => 'required',
        ]);

        $update = TransactionLog::where('transaction_id',$id)->update([
            'ticket_id' => $request->ticket_id,
            'action' => $request->action,
            'timestamp' => $request->timestamp,
        ]);
    if($update > 0){
            return redirect()->route('transactionlog.index')->with('success' , 'TransactionLog Updated Successfully!');
        }
        return redirect()->back()->with('error' , 'Something went wrong');
    }
    public function destroy($id){
        $delete = TransactionLog::where('transaction_id', $id)->delete();
        if (!empty($delete)) {
            return response()->json([
                'status' => 'success',
                'message' => 'TransactionLog deleted successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Something went wrong',
            ]);
        }
    }
}
