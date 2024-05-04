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
        Schema::create('details_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->references('id')->on('requests')->onDelete('cascade');
            $table->foreignId('component_material_id')->references('id')->on('component_materials')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_requests');
    }
};
