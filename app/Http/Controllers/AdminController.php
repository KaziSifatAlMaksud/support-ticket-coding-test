<?php

namespace App\Http\Controllers;
use App\Models\CustomerTicket;
use App\Models\Response;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\AdminStoppedTicketMail;

class AdminController extends Controller{
    public function index()
    {
         $tickets = CustomerTicket::all(); 
        return view('admin.deshbord_admin', compact('tickets')); 
    }
     public function issuedetail()
    {
         $user = Auth::user(); 
        return view('admin.issue_detail', compact('user')); 
    }
     public function show($id){
        $ticket = CustomerTicket::with('customerUser')->findOrFail($id);
       return view('admin.issue_detail', ['ticket' => $ticket,'user' => $ticket->customerUser,]); 
    }



    public function storerespons(Request $request)
    {

        // Validate the request data
        $request->validate([
            'ticket_id' => 'required|exists:customer_ticket,id',
            'user_id' => 'required|exists:users,id',
            'response' => 'required|string',
            'email_status' => 'nullable|string', // Adjust validation as needed
        ]);

        // Create a new Response record
        Response::create([
            'ticket_id' => $request->input('ticket_id'),
            'admin_id' => $request->input('user_id'),
            'response' => $request->input('response'),
            'email_status' => $request->input('email_status', ''), // Provide a default value if not present
        ]);

        return redirect()->back()->with('success', 'Response submitted successfully!');
    }



    public function stopTicket($id)
    {
        // Fetch the ticket and change its status
        $ticket = CustomerTicket::findOrFail($id);
        $ticket->status = 1;  // Assuming 1 means 'Closed'
        $ticket->save();

         $customer = $ticket->customer_id;

        $customer_info = User::findOrFail($customer);
        Mail::to($customer_info->email)->send(new AdminStoppedTicketMail($ticket));
        return redirect()->back()->with('success', 'Ticket has been stopped, and an email has been sent!');
    }

}
