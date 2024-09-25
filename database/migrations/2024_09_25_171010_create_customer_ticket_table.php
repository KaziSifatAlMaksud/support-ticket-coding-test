<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_ticket', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_title'); 
            $table->string('customer_id');
            $table->text('issue_details');
            $table->date('date'); 
            $table->string('status'); //  (e.g., open, closed)
            $table->string('email_status');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_ticket');
    }
};
