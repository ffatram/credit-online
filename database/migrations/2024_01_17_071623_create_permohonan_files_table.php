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
        Schema::create('permohonan_files', function (Blueprint $table) {
            $table->id();
            $table->string('no_ktp_pemohon');
            $table->string('file_no_ktp_pemohon');
            $table->string('file_no_ktp_pasangan');
            $table->string('file_no_kk');
            $table->string('jenis_file',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_files');
    }
};
