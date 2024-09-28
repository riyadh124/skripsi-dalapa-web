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
        Schema::create('workorders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('nomor_tiket');
            $table->string('witel');
            $table->string('sto');
            $table->string('headline');
            $table->string('lat');
            $table->string('lng');
            $table->string('status')->default('Waiting'); // Status default Menunggu
            $table->string('evidence_before')->nullable();
            $table->string('evidence_after')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workorders');
    }
};
