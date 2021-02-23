<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasPemohonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas_pemohons', function (Blueprint $table) {
            $table->id();
            $table->string('no_berkas', 7);
            $table->string('nama_pemohon', 200);
            $table->string('nib', 30)->nullable();
            $table->date('tanggal_pbt')->nullable();
            $table->string('no_pbt', 10)->nullable();
            $table->integer('luas')->nullable();
            $table->string('jorong', 40)->nullable();
            $table->string('nagari', 40)->nullable();
            $table->string('kecamatan', 40)->nullable();
            $table->date('tanggal_st')->nullable();
            $table->string('no_st', 40)->nullable();
            $table->date('tanggal_lap')->nullable();

            $table->date('tanggal_ris')->nullable();
            $table->string('no_ris', 20)->nullable();
            $table->date('tgl_sk_kantah_panitia')->nullable();
            $table->string('no_sk_kantah_panitia', 40)->nullable();

            $table->date('tanggal_peng')->nullable();
            $table->string('no_peng', 20)->nullable();
            $table->date('sampai_tanggal')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->string('no_sk', 30)->nullable();
            $table->text('ket')->nullable();
            $table->integer('tahun')->nullable();

            $table->string('no_surat_undangan', 40)->nullable();
            $table->date('tanggal_surat_undangan')->nullable();
            $table->string('jam_surat_undangan', 5)->nullable();

            $table->string('penggunaan_saat_ini', 30)->nullable();
            $table->string('rencana_penggunaan', 30)->nullable();
            $table->string('no_suket_wali', 50)->nullable();
            $table->date('tanggal_suket_wali')->nullable();

            $table->string('nik_pemohon', 20)->nullable();
            $table->string('tempat_lahir_pemohon', 20)->nullable();
            $table->date('tanggal_lahir_pemohon')->nullable();
            $table->string('alamat_pemohon', 70)->nullable();

            $table->date('tanggal_penugasan_fisik')->nullable();

            $table->date('tanggal_surat_permohonan')->nullable();
            $table->date('tanggal_berkas_didaftarkan')->nullable();

            $table->date('tanggal_sk_kan')->nullable();
            $table->string('no_sk_kan', 40)->nullable();
            $table->string('nama_wali_nagari', 40)->nullable();
            $table->string('nama_kuasa', 50);

            $table->string('alas_hak', 80);
            $table->date('tanggal_alas_hak')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berkas_pemohons');
    }
}
