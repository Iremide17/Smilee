<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFurnituresTable extends Migration
{
    
    public function up()
    {
        Schema::create('furnitures', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->nullable();
            $table->double('price')->nullable();
            $table->enum('type',['old','new'])->default('new');
            $table->string('code')->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('vendor_id')->constrained('vendors')->nullable()->onDelete('cascade');
            $table->foreignId('status_id')->constrained('statuses');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('furnitures');
    }
}
