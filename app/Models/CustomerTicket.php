<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTicket extends Model
{
    use HasFactory;
      protected $table = 'customer_ticket';

    protected $fillable = [
        'ticket_title',
        'issue_details',
        'customer_id',
        'date',
        'status',
        'email_status',
    ];

    public function customerUser()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
