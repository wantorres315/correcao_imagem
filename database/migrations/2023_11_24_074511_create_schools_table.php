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
        Schema::create('schools', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name', 150);
            $table->string('fullname',500);
            $table->string('nameFilter', 150);
            $table->string('slug', 150); 
            $table->integer('order_column')->nullable();
            $table->integer('school_gtraining_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
