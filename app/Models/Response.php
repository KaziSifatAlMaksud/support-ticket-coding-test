<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
     protected $fillable = [
        'ticket_id',
        'admin_id',
        'response',
        'email_status',
    ];

    public function ticket()
    {
        return $this->belongsTo(CustomerTicket::class, 'ticket_id');
    }

      public function admin_user()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
