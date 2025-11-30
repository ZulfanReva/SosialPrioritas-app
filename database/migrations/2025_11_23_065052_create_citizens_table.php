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
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->string('NIK')->unique();
            $table->string('name');
            $table->string('place_birth');
            $table->date('date_birth');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('address');

            $table->foreignId('province_id')->constrained();
            $table->foreignId('regency_id')->constrained();
            $table->foreignId('district_id')->constrained();
            $table->foreignId('sub_district_id')->constrained();

            $table->enum('education', ['Tidak Tamat SD', 'SD', 'SMA', 'SMP', 'Diploma', 'Sarjana', 'Lainnya']);
            $table->foreignId('work_id')->constrained();
            $table->foreignId('income_id')->constrained();
            $table->foreignId('relationship_id')->constrained();
            $table->foreignId('priority_bansos_id')->constrained();

            $table->timestamps();
        });
    }
/**
 * Reverse the migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('citizens');
    }
};
