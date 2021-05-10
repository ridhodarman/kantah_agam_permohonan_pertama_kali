<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemberian_hak extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_berkas', 'tahun', 'nama_pemohon', 'nama_kuasa', 'jorong', 'jalan', 'nagari', 
        'kecamatan', 'luas', 'no_surat_undangan', 'tanggal_surat_undangan', 'jam_surat_undangan',
        'tanggal_st', 'no_st',  'tanggal_ris', 'no_ris', 'tgl_sk_kantah_panitia_a', 'no_sk_kantah_panitia_a',
        'nib', 'tanggal_pbt', 'no_pbt', 'nik_pemohon', 'tanggal_lahir_pemohon', 'alamat_pemohon',
        'pekerjaan', 'utara', 'selatan', 'timur', 'barat', 'penggunaan_rtrw', 'penggunaan_saat_ini', 
        'penggunaan_saat_ini', 'tanggal_surat_permohonan', 'tanggal_penguasan_fisik', 
        'no_suket_wali_nagari', 'tanggal_suket_wali_nagari', 'nama_wali_nagari', 'no_sk_kan', 'tanggal_sk_kan',
        'tanggal_surat_setoran_bphtb', 'tgl_pernyataan_tanah_yg_dipunyai', 'tanggal_tanda_batas',
        'tanggal_berkas_didaftarkan', 'no_ikhtisar', 'tanggal_ikhtisar', 'rencana_penggunaan',


        'tanggal_sk', 'no_sk', 'ket',
        
    ];
}
