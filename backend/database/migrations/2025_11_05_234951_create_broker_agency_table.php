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
        Schema::create('broker_agency', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('broker_id')->constrained('brokers');
            $table->foreignUlid('real_estate_agency_id')->constrained('real_estate_agencies');
            $table->enum('status', ['pending', 'accepted', 'rejected']);
            $table->decimal('commission_split', 10, 2);
            $table->foreignUlid('invited_by')->constrained('users');
            $table->timestamp('invited_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broker_agency');
    }
};
