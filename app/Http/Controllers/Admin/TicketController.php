<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Counter;
use App\Models\Business;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index(){
        $tickets = Ticket::get();
        return view('admin.pages.ticket.index',compact('tickets'));
    }
    public function create()
    {
        $users = User::get();
        $businesses = Business::get();
        $counters = Counter::get();
        return view('admin.pages.ticket.create', compact('users','businesses','counters'));
    }
    public function store(Request $request){
        $request->validate([
            'user_id' => 'required',
            'business_id' => 'required',
            'counter_id' => 'required',
            'status' => 'required',
            'completed_at' => 'required',
        ]);
    
        $date = now();
        $ticketNumber = $date->format('dM').$date->format('y').'-';
        $lastTicket = Ticket::whereDate('created_at', $date->format('Y-m-d'))->latest()->first();
        $sequenceNumber = $lastTicket ? substr($lastTicket->ticket_number, -3) + 1 : 1;
        $ticketNumber = $date->format('dM').$date->format('y').'-'.str_pad($sequenceNumber, 3, '0', STR_PAD_LEFT);
    
        $store = Ticket::create([
            'user_id' => $request->user_id,
            'business_id' => $request->business_id,
            'counter_id' => $request->counter_id,
            'ticket_number' => $ticketNumber,
            'status' => $request->status,
            'completed_at' => $request->completed_at,
        ]);
    
        if(!empty($store->id)){
            return redirect()->route('ticket.index')->with('success' , 'Ticket Created Successfully!');
        }else{
            return redirect()->back()->with('error' , 'Something went wrong');
        }
    }
    public function getBusinesses($userId)
    {
        $businesses = Business::where('user_id', $userId)->get();
        return response()->json($businesses);
    }

    public function getCounters($businessId)
    {
        $counters = Counter::where('business_id', $businessId)->get();
        return response()->json($counters);
    }
    public function edit(string $id)
    {
        $users = User::all();
        $businesses = Business::all();
        $counters = Counter::all();
        $ticket = Ticket::where('ticket_id',$id)->firstOrFail();
        return view('admin.pages.ticket.edit',compact('ticket','users','businesses','counters'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'business_id' => 'required',
            'counter_id' => 'required',
            // 'ticket_number' => 'required',
            'status' => 'required',
            'completed_at' => 'required',
        ]);

        $update = Ticket::where('ticket_id',$id)->update([
            'user_id' => $request->user_id,
            'business_id' => $request->business_id,
            'counter_id' => $request->counter_id,
            // 'ticket_number' => $request->ticket_number,
            'status' => $request->status,
            'completed_at' => $request->completed_at,
        ]);
    if($update > 0){
            return redirect()->route('ticket.index')->with('success' , 'Ticket Updated Successfully!');
        }
        return redirect()->back()->with('error' , 'Something went wrong');
    }
    public function destroy($id){
        $delete = Ticket::where('ticket_id', $id)->delete();
        if (!empty($delete)) {
            return response()->json([
                'status' => 'success',
                'message' => 'Ticket deleted successfully',
            ]);
        } else {
            return response()->json([
                'message' => 'Something went wrong',
            ]);
        }
    }
}
