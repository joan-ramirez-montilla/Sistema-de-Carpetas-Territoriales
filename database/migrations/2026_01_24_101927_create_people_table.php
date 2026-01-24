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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('national_id')->unique();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('office_phone')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('address')->nullable();
            $table->foreignId('position_id')->constrained();
            $table->foreignId('organization_id')->constrained();
            $table->enum('circumscription', ['1','2','3','4','5','6','7','8'])->nullable();

            $table->foreignId('province_id')->nullable()->constrained();
            $table->foreignId('municipality_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable()->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
