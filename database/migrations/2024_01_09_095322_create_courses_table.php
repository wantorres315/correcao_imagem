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
        Schema::create('courses', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('course_category_id');
            $table->foreign('course_category_id')->references('id')->on('courses_categories');
            $table->string('slug');
            $table->integer('order_column');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('quote_author')->nullable();
            $table->string('quote_title')->nullable();
            $table->text('quote_text')->nullable();
            $table->text('presentation_brochure')->nullable();
            $table->text('applyNow')->nullable();
            $table->text('moreInformation')->nullable();
            $table->text('description');
            $table->text('presentation_text')->nullable();
            $table->text('presentation_list')->nullable();
            $table->text('requirements')->nullable();
            $table->text('structureAndFees')->nullable();
            $table->text('mainActivities')->nullable();
            $table->text('furtherStudies')->nullable();
            $table->text('certification')->nullable();
            $table->text('professionalOutings')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
