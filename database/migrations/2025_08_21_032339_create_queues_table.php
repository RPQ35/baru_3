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
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_number');
            $table->string('queues_number');
            $table->string('call_status')->nullable();
            $table->enum('status', ['new', 'proggres', 'stage', 'end', "cancelled"]);
            $table->date('dates')->default(now());
            $table->tinyInteger('is_called')->default(0);

            // declare
            $table->unsignedBigInteger('locket_id')->nullable();
            $table->unsignedBigInteger('services_id')->nullable();

            // Foreign keys
            $table->foreign('services_id')->references('id')->on('services')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
