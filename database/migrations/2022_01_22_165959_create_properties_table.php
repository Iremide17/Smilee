<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->enum('type',['sale', 'rent'])->default('rent');
            $table->enum('category',['sc', 'f','ar'])->default('ar');
            $table->integer('room')->nullable();
            $table->timestamp('year_built')->nullable();
            $table->double('price')->nullable();
            $table->string('region')->nullable();
            $table->string('address')->nullable();
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('image')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('video')->nullable();
            $table->text('description')->nullable();
            $table->boolean('fence')->default(0);
            $table->boolean('tiled')->default(0);
            $table->boolean('well')->default(0);
            $table->boolean('tap')->default(0);
            $table->boolean('toilet')->default(0);
            $table->boolean('available')->default(0);
            $table->foreignId('agent_id')->constrained('agents')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
