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
        Schema::create('distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users');
            $table->foreignId('citizen_id')->constrained();
            $table->foreignId('program_bansos_id')->constrained();
            $table->foreignId('period_bansos_id')->constrained();

            $table->enum('status', ['Persiapan', 'Proses', 'Tertunda', 'Selesai', 'Dibatalkan']);
            $table->string('evidence')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distributions');
    }
};
