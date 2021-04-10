<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemberianHaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemberian_haks', function (Blueprint $table) {
            $table->id();
            $table->string('no_berkas', 7);
            $table->integer('tahun')->nullable();
            $table->text('nama_pemohon');
            $table->string('nama_kuasa', 50)->nullable();
            $table->string('jorong', 40)->nullable();
            $table->string('jalan', 40)->nullable();
            $table->string('nagari', 40)->nullable();
            $table->string('kecamatan', 40)->nullable();
            $table->integer('luas')->nullable();
            $table->string('no_surat_undangan', 40)->nullable();
            $table->date('tanggal_surat_undangan')->nullable();
            $table->string('jam_surat_undangan', 5)->nullable();
            $table->date('tanggal_st')->nullable();
            $table->string('no_st', 40)->nullable();

            $table->string('no_ikhtisar', 30)->nullable();
            $table->date('tanggal_ikhtisar')->nullable();
            $table->string('no_ris', 20)->nullable();
            $table->date('tanggal_ris')->nullable();
            $table->date('tgl_sk_kantah_panitia_a')->nullable();
            $table->string('no_sk_kantah_panitia_a', 40)->nullable();
            $table->string('nib', 30)->nullable();
            $table->date('tanggal_pbt')->nullable();
            $table->string('no_pbt', 10)->nullable();

            $table->text('nik_pemohon')->nullable();
            $table->text('tanggal_lahir_pemohon')->nullable();
            $table->text('alamat_pemohon')->nullable();
            $table->text('pekerjaan')->nullable();

            $table->string('utara', 50)->nullable();
            $table->string('selatan', 50)->nullable();
            $table->string('timur', 50)->nullable();
            $table->string('barat', 50)->nullable();

            $table->string('penggunaan_rtrw', 30)->nullable();
            $table->string('penggunaan_saat_ini', 30)->nullable();
            $table->string('rencana_penggunaan', 30)->nullable();

            $table->date('tanggal_surat_permohonan')->nullable();
            $table->date('tanggal_penguasan_fisik')->nullable();
            $table->string('no_suket_wali_nagari', 50)->nullable();
            $table->date('tanggal_suket_wali_nagari')->nullable();
            $table->string('nama_wali_nagari', 40)->nullable();
            $table->string('no_sk_kan', 30)->nullable();
            $table->date('tanggal_sk_kan')->nullable();
            $table->date('tanggal_surat_setoran_bphtb')->nullable();
            $table->date('tgl_pernyataan_tanah_yg_dipunyai')->nullable();
            $table->date('tanggal_tanda_batas')->nullable();

            $table->text('ket')->nullable();

            $table->date('tanggal_berkas_didaftarkan')->nullable();

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
        Schema::dropIfExists('pemberian_haks');
    }
}
