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
        Schema::create('permohonans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon', 100);
            $table->string('tempat_lahir_pemohon', 100);
            $table->dateTime('tgl_lahir_pemohon');
            $table->string('jenis_kelamin_pemohon', 10);
            $table->string('nama_ibu_kandung_pemohon', 100);
            $table->string('no_ktp_pemohon', 20);
            $table->string('npwp_pemohon', 50)->nullable();
            $table->text('alamat_ktp_pemohon');
            $table->text('alamat_sekarang_pemohon');
            $table->string('telepon_pemohon', 50);
            $table->string('media_sosial', 50)->nullable();
            $table->string('status_kepemilikan_rumah_pemohon', 50)->nullable();
            $table->string('pendidikan_terakhir_pemohon', 20)->nullable();
            $table->string('gelar_pemohon', 50)->nullable();
            $table->string('status_perkawinan', 20);
            $table->string('jumlah_tanggungan', 10)->nullable();
            $table->string('nama_keluarga_dapat_dihubungi', 100);
            $table->text('alamat_keluarga_dapat_dihubungi');
            $table->string('hubungan_keluarga_dapat_dihubungi', 50);
            $table->string('telepon_keluarga_dapat_dihubungi', 50);
            $table->string('jenis_pekerjaan', 50);
            $table->string('kode_instansi', 20);
            $table->string('nama_instansi', 100);
            $table->text('alamat_instansi');
            $table->string('telepon_instansi', 50)->nullable();;
            $table->string('tahun_mulai_bekerja', 30)->nullable();
            $table->string('jabatan_saat_ini', 100)->nullable();
            $table->string('atasan_langsung', 100)->nullable();
            $table->string('telepon_bendahara', 50)->nullable();
            $table->string('nama_pasangan', 100)->nullable();
            $table->string('tempat_lahir_pasangan', 100)->default('')->nullable();
            $table->dateTime('tgl_lahir_pasangan')->nullable();
            $table->string('no_ktp_pasangan', 20)->default('')->nullable();
            $table->text('alamat_ktp_pasangan')->default('')->nullable();
            $table->text('alamat_sekarang_pasangan')->default('')->nullable();
            $table->string('telepon_pasangan', 50)->default('')->nullable();
            $table->string('jenis_pekerjaan_pasangan', 50)->default('')->nullable();
            $table->string('nama_instansi_pasangan', 150)->default('')->nullable();
            $table->string('tahun_mulai_bekerja_pasangan', 30)->default('')->nullable();
            $table->string('jabatan_saat_ini_pasangan', 100)->default('')->nullable();
            $table->text('alamat_kantor_pasangan')->default('')->nullable();
            $table->string('telepon_kantor_pasangan', 50)->default('')->nullable();
            $table->bigInteger('plafond_dimohon');
            $table->integer('jangka_waktu');
            $table->string('tujuan_penggunaan_kredit', 200);
            $table->string('jenis_jaminan', 100)->default('')->nullable();
            $table->bigInteger('nilai_jaminan')->nullable();
            $table->bigInteger('penghasilan_pemohon')->nullable();
            $table->bigInteger('penghasilan_pasangan')->nullable();
            $table->bigInteger('penghasilan_tambahan')->nullable();
            $table->bigInteger('penghasilan_tambahan_lainnya')->nullable();
            $table->bigInteger('biaya_hidup_perbulan')->nullable();
            $table->bigInteger('biaya_pendidikan')->nullable();
            $table->bigInteger('biaya_pam_listrik_telepon')->nullable();
            $table->bigInteger('biaya_transport')->nullable();
            $table->bigInteger('angsuran_bank_lain')->nullable();
            $table->bigInteger('angsuran_perumahan')->nullable();
            $table->bigInteger('angsuran_kendaraan')->nullable();
            $table->bigInteger('angsuran_barang_elektronik')->nullable();
            $table->bigInteger('angsuran_koperasi')->nullable();
            $table->bigInteger('biaya_lainnya')->nullable();
            $table->string('aset_yang_dimiliki', 100)->nullable();
            $table->text('alamat_aset')->nullable();
            $table->string('jenis_sertifikat', 100)->nullable();
            $table->string('jumlah_kendaraan', 50)->nullable();
            $table->string('merek_kendaraan', 100)->nullable();
            $table->string('tahun_kendaraan', 30)->nullable();
            $table->string('atas_nama_kendaraan', 100)->nullable();
            $table->string('kode_cabang', 5);
            $table->dateTime('tgl_create')->default(now())->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};
