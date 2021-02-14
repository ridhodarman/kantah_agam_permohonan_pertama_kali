<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Berkas_pemohonController;
use App\Http\Controllers\CetakController;
use App\Models\Berkas_pemohon;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('berkas', Berkas_pemohonController::class);
Route::resource('cetak', CetakController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('print', 'CetakController@st')->name('print');

Route::get('/print/ST/{id}', function ($id) {
    $berkas = Berkas_pemohon::find($id);
    //return $berkas;
    $nama = $berkas->nama_pemohon;
    $luas = $berkas->luas;
    $nagari = $berkas->nagari;
    $kecamatan = $berkas->kecamatan;
    $tahun = date('Y');
    $tanggal = $berkas->tanggal_st;
    $no_st = $berkas->no_st;
    $nama_wali_nagari = strtoupper($berkas->nama_wali_nagari);
    Carbon::setLocale('id');
    if ($tanggal==null){
        $tanggal = Carbon::now()->isoFormat('D MMMM Y');
    }
    else {
        //$tanggal = date('d-m-Y', strtotime($tanggal));
        $tanggal = Carbon::parse($tanggal)->isoFormat('D MMMM Y');
    }
    
    if ($no_st==null){
        $no_st = "      /002-03.04/VII /".$tahun;
    }
    
    $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('ST.docx'));
    $template -> setValue('nama', $nama);
    $template -> setValue('no_st', $no_st);
    $template -> setValue('luas', $luas);
    $template -> setValue('nagari', $nagari);
    $template -> setValue('kecamatan', $kecamatan);
    $template -> setValue('tanggal', $tanggal);
    $template -> setValue('nama_wali_nagari', $nama_wali_nagari);

    $path = storage_path('temp\st_'.$nama.'.docx');
    $template->saveAs($path);;
    //return response()->download(storage_path('surat.docx'));
    return response()->download(storage_path('temp\st_'.$nama.'.docx'));
});

Route::get('/print/undangan/{id}', function ($id) {
    $berkas = Berkas_pemohon::find($id);
    //return $berkas;
    $nama = $berkas->nama_pemohon;
    $kuasa = $berkas->nama_kuasa;
    $tahun = date('Y');
    $luas = $berkas->luas;
    $nagari = $berkas->nagari;
    $kecamatan = $berkas->kecamatan;
    $no_surat_undangan = $berkas->no_surat_undangan;
    $tanggal_surat_undangan = $berkas->tanggal_surat_undangan;
    $jam_surat_undangan = $berkas->jam_surat_undangan;
    $no_surat_undangan = $berkas->no_surat_undangan;
    //$tanggal = $berkas->tanggal_st;
    Carbon::setLocale('id');

    if($tanggal_surat_undangan==null){
        $tanggal = Carbon::now()->isoFormat('D MMMM Y');
        $hari = Carbon::now()->isoFormat('dddd');
    }
    else {
        $tanggal = Carbon::parse($tanggal_surat_undangan)->isoFormat('D MMMM Y');
        $hari = Carbon::parse($tanggal_surat_undangan)->isoFormat('dddd');
    }

    if($jam_surat_undangan==null){
        date_default_timezone_set('Asia/Jakarta');
        $jam = date("h:i");
    }
    else {
        $jam = $jam_surat_undangan;
    }

    if($no_surat_undangan==null){
        $no_surat_undangan = "      /002-03.04/VII/".$tahun;
    }

    if($kuasa==null){
        $kuasa = $berkas->nama_pemohon;
    }
    
    $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('undangan.docx'));
    $template -> setValue('nama', strtoupper($nama) );
    $template -> setValue('kuasa', strtoupper($kuasa) );
    $template -> setValue('tahun', $tahun);
    $template -> setValue('luas', $luas);
    $template -> setValue('nagari', strtoupper($nagari));
    $template -> setValue('kecamatan', strtoupper($kecamatan));
    $template -> setValue('tanggal', $tanggal);
    $template -> setValue('hari', $hari);
    $template -> setValue('jam', $jam);
    $template -> setValue('no_surat_undangan', $no_surat_undangan);

    $path = storage_path('temp\undangan_'.$nama.'.docx');
    $template->saveAs($path);;
    
    $headers = [
        'Content-Type' => 'application/docx',
    ];

    return response()->download($path, 'undangan_'.$nama.'.docx', $headers);
    
    //return response()->download(storage_path('temp\undangan_'.$nama.'.docx'));
});

Route::get('/print/risalah/{id}', function ($id) {
    Carbon::setLocale('id');
    $berkas = Berkas_pemohon::find($id);
    //return $berkas;
    $nama = $berkas->nama_pemohon;
    $tahun = date('Y');
    $luas = $berkas->luas;
    $nagari = $berkas->nagari;
    $kecamatan = $berkas->kecamatan;
    $tanggal_ris = $berkas->tanggal_ris;
    $tanggal_st = Carbon::parse($berkas->tanggal_st)->isoFormat('D MMMM Y');
    $tanggal_pbt = Carbon::parse($berkas->tanggal_pbt)->isoFormat('D MMMM Y');
    $no_pbt = $berkas->no_pbt;
    $jorong = $berkas->jorong;
    $nib = $berkas->nib;
    $alamat_pemohon = $berkas->alamat_pemohon;
    $nik_pemohon = $berkas->nik_pemohon;
    $tempat_lahir_pemohon = $berkas->tempat_lahir_pemohon;
    $no_ris = $berkas->no_ris;
    $tanggal_lahir_pemohon = $tanggal = date('d-m-Y', strtotime($berkas->tanggal_lahir_pemohon));
    $tanggal_surat_permohonan = Carbon::parse($berkas->tanggal_surat_permohonan)->isoFormat('D MMMM Y');
    $tanggal_penugasan_fisik = Carbon::parse($berkas->tanggal_penugasan_fisik)->isoFormat('D MMMM Y');
    $no_suket_wali = $berkas->no_suket_wali;
    $tanggal_suket_wali = Carbon::parse($berkas->tanggal_suket_wali)->isoFormat('D MMMM Y');
    $penggunaan_saat_ini = $berkas->penggunaan_saat_ini;
    $rencana_penggunaan = $berkas->rencana_penggunaan;
    $nama_wali_nagari = strtoupper($berkas->nama_wali_nagari);
    $tgl_sk_kantah_panitia = Carbon::parse($berkas->tgl_sk_kantah_panitia)->isoFormat('D MMMM Y');
    $no_sk_kantah_panitia = $berkas->no_sk_kantah_panitia;
    if($no_sk_kantah_panitia==null){
        $no_sk_kantah_panitia = "85/SK- 13.06.HP.01/XI/2020";
    }
    if ($tanggal_ris==null){
        $tanggal_ris = date('d-m-Y');
        $hari = Carbon::now()->isoFormat('dddd');
        $bulan = Carbon::now()->isoFormat('MMMM');
        $tanggal_angka = date('d');
        $tahun_angka = date('Y');
    }
    else {
        $tanggal_ris = date('d-m-Y', strtotime($tanggal_ris));
        $hari = Carbon::parse($tanggal_ris)->isoFormat('dddd');
        $bulan = Carbon::parse($tanggal_ris)->isoFormat('MMMM');
        $tanggal_angka = date('d', strtotime($tanggal_ris));
        $tahun_angka = date('Y', strtotime($tanggal_ris));
    }

    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		}
		return $temp;
    }

    $tanggal_huruf = ucfirst( trim(penyebut($tanggal_angka)) );
    $tahun_huruf = ucfirst( trim(penyebut($tahun_angka)) ) ;
    $luas_huruf = ucwords( trim(penyebut($luas)) ) ;
    
    $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('Risalah.docx'));
    $template -> setValue('no_ris', $no_ris);
    $template -> setValue('nama', $nama);
    $template -> setValue('tahun', $tahun);
    $template -> setValue('luas', $luas);
    $template -> setValue('nagari', $nagari);
    $template -> setValue('kecamatan', $kecamatan);
    $template -> setValue('tanggal_ris', $tanggal_ris);
    $template -> setValue('hari', $hari);
    $template -> setValue('bulan', $bulan);
    $template -> setValue('tanggal_huruf', $tanggal_huruf);
    $template -> setValue('tahun_huruf', $tahun_huruf);
    $template -> setValue('tanggal_pbt', $tanggal_pbt);
    $template -> setValue('no_pbt', $no_pbt);
    $template -> setValue('luas_huruf', $luas_huruf);
    $template -> setValue('jorong', $jorong);
    $template -> setValue('nib', $nib);
    $template -> setValue('tahun', $tahun);
    $template -> setValue('alamat_pemohon', $alamat_pemohon);
    $template -> setValue('nik_pemohon', $nik_pemohon);
    $template -> setValue('tanggal_lahir', $tanggal_lahir_pemohon);
    $template -> setValue('tempat_lahir', $tempat_lahir_pemohon);
    $template -> setValue('tanggal_surat_permohonan', $tanggal_surat_permohonan);
    $template -> setValue('tanggal_penugasan_fisik', $tanggal_penugasan_fisik);
    $template -> setValue('no_suket_wali', $no_suket_wali);
    $template -> setValue('tanggal_suket_wali', $tanggal_suket_wali);
    $template -> setValue('penggunaan_saat_ini', $penggunaan_saat_ini);
    $template -> setValue('rencana_penggunaan', $rencana_penggunaan);
    $template -> setValue('nama_wali_nagari', $nama_wali_nagari);
    $template -> setValue('no_sk_kantah_panitia', $no_sk_kantah_panitia);
    $template -> setValue('tgl_sk_kantah_panitia', $tgl_sk_kantah_panitia);

    $path = storage_path('temp\risalah_'.$nama.'.docx');
    $template->saveAs($path);;
    //return response()->download(storage_path('surat.docx'));
    return response()->download(storage_path('temp\risalah_'.$nama.'.docx'));
});

Route::get('/print/peng/{id}', function ($id) {
    $berkas = Berkas_pemohon::find($id);
    //return $berkas;
    $nama = $berkas->nama_pemohon;
    $tahun = date('Y');
    $luas = $berkas->luas;
    $jorong = $berkas->jorong;
    $nagari = $berkas->nagari;
    $kecamatan = $berkas->kecamatan;
    $nib = $berkas->nib;
    $no_berkas = $berkas->no_berkas;
    $no_pbt = $berkas->no_pbt;
    
    $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('PENG.docx'));
    $template -> setValue('nama', $nama);
    $template -> setValue('tahun', $tahun);
    $template -> setValue('luas', $luas);
    $template -> setValue('jorong', $jorong);
    $template -> setValue('nagari', $nagari);
    $template -> setValue('kecamatan', $kecamatan);
    $template -> setValue('nib', $nib);
    $template -> setValue('no_berkas', $no_berkas);
    $template -> setValue('no_pbt', $no_pbt);

    $path = storage_path('temp\pengumuman_'.$nama.'.docx');
    $template->saveAs($path);;
    //return response()->download(storage_path('surat.docx'));
    return response()->download(storage_path('temp\pengumuman_'.$nama.'.docx'));
});

Route::get('/print/sk/{id}', function ($id) {
    Carbon::setLocale('id');
    $berkas = Berkas_pemohon::find($id);
    //return $berkas;
    $no_sk = $berkas->no_sk;
    $nama = $berkas->nama_pemohon;
    $tahun = date('Y');
    $luas = $berkas->luas;
    $jorong = $berkas->jorong;
    $nagari = $berkas->nagari;
    $kecamatan = $berkas->kecamatan;
    $nib = $berkas->nib;
    $no_berkas = $berkas->no_berkas;
    $no_pbt = $berkas->no_pbt;
    $tanggal_ris =  Carbon::parse($berkas->tanggal_ris)->isoFormat('D MMMM Y');
    $no_ris = $berkas->no_pbt;
    $tanggal_pbt = Carbon::parse($berkas->tanggal_pbt)->isoFormat('D MMMM Y');
    $tanggal_surat_permohonan = Carbon::parse($berkas->tanggal_surat_permohonan)->isoFormat('D MMMM Y');
    $tanggal_berkas_didaftarkan = Carbon::parse($berkas->tanggal_berkas_didaftarkan)->isoFormat('D MMMM Y');
    $tanggal_sk =  Carbon::parse($berkas->tanggal_sk)->isoFormat('D MMMM Y');
    $penggunaan_saat_ini = $berkas->penggunaan_saat_ini;
    $rencana_penggunaan = $berkas->rencana_penggunaan;
    $alamat_pemohon = $berkas->alamat_pemohon;

    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		}
		return $temp;
    }

    $luas_huruf = trim(penyebut($luas)) ;
    if($no_sk==null){
        $no_sk = "          / HM/BPN - 03.04/".$tahun;
    }
    $tanggal_sk = strtoupper($tanggal_sk);
    $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('SK.docx'));
    $template -> setValue('no_sk', strtoupper($no_sk));
    $template -> setValue('nama_kapital', strtoupper($nama));
    $template -> setValue('nagari_kapital', strtoupper($nagari));
    $template -> setValue('kecamatan_kapital', strtoupper($kecamatan));
    $template -> setValue('nama', $nama);
    $template -> setValue('tahun', $tahun);
    $template -> setValue('luas', $luas);
    $template -> setValue('luas_huruf', $luas_huruf);
    $template -> setValue('jorong', $jorong);
    $template -> setValue('nagari', $nagari);
    $template -> setValue('kecamatan', $kecamatan);
    $template -> setValue('tanggal_ris', $tanggal_ris);
    $template -> setValue('no_ris', $no_ris);
    $template -> setValue('tanggal_pbt', $tanggal_pbt);
    $template -> setValue('no_pbt', $no_pbt);
    $template -> setValue('nib', $nib);
    $template -> setValue('tanggal_surat_permohonan', $tanggal_surat_permohonan);
    $template -> setValue('tanggal_berkas_didaftarkan', $tanggal_berkas_didaftarkan);
    $template -> setValue('penggunaan_saat_ini', $penggunaan_saat_ini);
    $template -> setValue('rencana_penggunaan', $rencana_penggunaan);
    $template -> setValue('alamat_pemohon', $alamat_pemohon);
    $template -> setValue('tanggal_sk', $tanggal_sk);


    $path = storage_path('temp\sk_'.$nama.'.docx');
    $template->saveAs($path);;
    //return response()->download(storage_path('surat.docx'));
    return response()->download(storage_path('temp\sk_'.$nama.'.docx'));
});