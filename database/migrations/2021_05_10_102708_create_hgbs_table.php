<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHgbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hgbs', function (Blueprint $table) {
            $table->id();
            $table->string('no_berkas', 7);
            $table->integer('tahun')->nullable();
            $table->string('nama_pemohon', 50);
            $table->string('bertindak_atas_nama', 80);
            $table->integer('luas')->nullable();
            $table->string('jorong', 40)->nullable();
            $table->string('jalan', 40)->nullable();
            $table->string('nagari', 40)->nullable();
            $table->string('kecamatan', 40)->nullable();
            $table->date('tanggal_st')->nullable();
            $table->string('no_st', 40)->nullable();
            $table->date('tanggal_berita_acara')->nullable();
            $table->string('tanda_batas_berupa', 50)->nullable();
            $table->string('utara', 50)->nullable();
            $table->string('selatan', 50)->nullable();
            $table->string('timur', 50)->nullable();
            $table->string('barat', 50)->nullable();
            $table->string('no_ikhtisar', 30)->nullable();
            $table->date('tanggal_ikhtisar')->nullable();
            $table->string('status_tanah', 100)->nullable();
            $table->string('no_ris', 20)->nullable();
            $table->date('tanggal_ris')->nullable();
            $table->date('tgl_sk_kantah_panitia')->nullable();
            $table->string('no_sk_kantah_panitia', 40)->nullable();
            $table->integer('jangka_waktu')->nullable();
            $table->date('tanggal_pbt')->nullable();
            $table->string('no_pbt', 10)->nullable();
            $table->string('penggunaan_saat_ini', 30)->nullable();
            $table->string('rencana_penggunaan', 30)->nullable();
            $table->date('tanggal_penguasan_fisik')->nullable();
            $table->string('no_suket_wali_nagari', 50)->nullable();
            $table->date('tanggal_suket_wali_nagari')->nullable();
            $table->text('data_pendukung_lain');
            $table->string('no_sk', 30)->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->date('tanggal_surat_permohonan')->nullable();
            $table->date('tanggal_berkas_didaftarkan')->nullable();
            $table->string('alamat_pemohon', 150)->nullable();
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
        Schema::dropIfExists('hgbs');
    }
}
