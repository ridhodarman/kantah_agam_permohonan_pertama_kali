<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas_pemohon extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_berkas', 'nama_pemohon', 'nib', 'tanggal_pbt', 'no_pbt',
        'luas', 'jorong', 'nagari', 'kecamatan', 'tanggal_st', 'no_st', 'tanggal_lap',
        'tanggal_ris', 'no_ris', 'tanggal_peng', 'no_peng', 'sampai_tanggal', 'tanggal_sk',
        'ket', 'tahun', 'no_sk',
        'no_surat_undangan', 'tanggal_surat_undangan', 'jam_surat_undangan',
        'penggunaan_saat_ini', 'rencana_penggunaan',
        'nik_pemohon', 'tempat_lahir_pemohon', 'tanggal_lahir_pemohon', 'alamat_pemohon',
        'tanggal_penugasan_fisik', 'tanggal_surat_permohonan', 'tanggal_berkas_didaftarkan',
        'tanggal_sk_kan', 'no_sk_kan', 'no_suket_wali', 'tanggal_suket_wali', 'nama_wali_nagari',
        'tgl_sk_kantah_panitia', 'no_sk_kantah_panitia'
    ];
}
