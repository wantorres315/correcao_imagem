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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('order_column');
            $table->string('slug', 500);
            $table->dateTime('date');
            $table->dateTime('dateEnd')->nullable();
            $table->string('location')->nullable();
            $table->string('location_link')->nullable();
            $table->string('status');
            $table->boolean('highlight')->default(false);
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools');
            $table->string('title');
            $table->text('intro')->nullable();
            $table->longText('content')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
