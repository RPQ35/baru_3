<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locket_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('locket_id')->unique()->nullable();
            $table->unsignedBigInteger('services_id')->unique()->nullable();
            $table->foreign('locket_id')->references('id')->on('lockets')->onDelete('cascade');
            $table->foreign('services_id')->references('id')->on('services')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locket_services');
    }
};
