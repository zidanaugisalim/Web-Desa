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
        Schema::create('pengukuran_imt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anak_id')->constrained('stuntings')->onDelete('cascade');
            $table->decimal('berat_badan', 5, 2); // dalam kg
            $table->decimal('tinggi_badan', 5, 2); // dalam cm
            $table->decimal('imt', 5, 2); // IMT yang dihitung
            $table->string('kategori_imt')->nullable(); // kategori IMT
            $table->date('tanggal_pengukuran');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengukuran_imt');
    }
};
