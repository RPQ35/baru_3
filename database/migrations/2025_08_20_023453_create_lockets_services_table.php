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
        Schema::create('lockets_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lockets_id')->nullable();
            $table->unsignedBigInteger('services_id')->nullable();
            $table->foreign('lockets_id')->references('id')->on('lockets')->onDelete('cascade');
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
