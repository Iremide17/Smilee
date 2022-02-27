<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users')->nullable()->onDelete('cascade');
            $table->foreignId('property_id')->constrained('properties')->nullable()->onDelete('cascade');
            $table->foreignId('agent_id')->constrained('agents')->nullable()->onDelete('cascade');
            $table->foreignId('status_id')->constrained('statuses');
            $table->string('duration')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
