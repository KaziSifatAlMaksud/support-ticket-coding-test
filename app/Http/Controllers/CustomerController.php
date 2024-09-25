<?php

namespace App\Http\Controllers;
use App\Mail\EmailSubmitted;
use App\Models\CustomerTicket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function index()
    {
         $tickets = CustomerTicket::all(); 
        return view('customer.deshbord_customer' , compact('tickets') ); // Point to your admin dashboard view
    }
    public function create_ticket()
    {
        return view('customer.create_ticket'); // Point to your admin dashboard view
    }
    public function submitIssue(Request $request)
    {
        // Validate the request data
        $request->validate([
            'issueTitle' => 'required|string|max:255',
            'issueDetail' => 'required|string',
            'date' => 'required|date',
        ]);

        // Create a new ticket
        CustomerTicket::create([
            'ticket_title' => $request->input('issueTitle'),
            'issue_details' => $request->input('issueDetail'),
            'date' => $request->input('date'),
            'customer_id' => auth()->id(),
            'status' => '0', // Set default 0 for Open .. 1 for Closed
            'email_status' => '', // Set default empty
        ]);
        
        $adminEmail = "2019-3-60-050@std.ewubd.edu";
        Mail::to($adminEmail)->send(new EmailSubmitted(
           $request->input('issueTitle'),
           $request->input('issueDetail')
        ));

        // Redirect or return a response
        return redirect()->back()->with('success', 'Issue submitted successfully!');
    }
}
