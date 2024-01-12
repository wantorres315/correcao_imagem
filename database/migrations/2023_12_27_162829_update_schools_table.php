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
        Schema::table('schools', function (Blueprint $table) {
            $table->boolean('visible')->default(true);
            $table->string('name_director')->nullable();
            $table->string('role_director')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('title_partners')->nullable();
            $table->text('subtitle_partners')->nullable();
            $table->text('google_maps_link')->nullable();
            $table->text('presentation_brochure')->nullable();
            $table->string('region')->nullable();
            $table->string('region_name')->nullable();
            $table->string('nameMap')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
