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
        Schema::create('queues_locket', function (Blueprint $table) {
            // Foreign key for the `queues` table
            $table->foreignId('queues_id')->constrained()->cascadeOnDelete();

            // Foreign key for the `lockets` table
            $table->foreignId('locket_id')->constrained()->cascadeOnDelete();

            // Make the combination of the two foreign keys unique
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues_locket');
    }
};
