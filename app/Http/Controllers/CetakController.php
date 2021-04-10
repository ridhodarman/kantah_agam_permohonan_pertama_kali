<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berkas_pemohon;
use Carbon\Carbon;

class CetakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nama="nama";
        $tahun = "2021";
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('SK.docx'));
        $template -> setValue('nama', $nama);
        $template -> setValue('tahun', $tahun);

        $path = storage_path('s.docx');
        $template->saveAs($path);;
        return response()->download(storage_path('s.docx'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function st($id)
    {
        $berkas = Berkas_pemohon::find($id);
        Carbon::setLocale('id');
        //return $berkas;
        $luas = $berkas->luas;
        $nagari = $berkas->nagari;
        $kecamatan = $berkas->kecamatan;
        $tahun = date('Y');
        $tanggal = $berkas->tanggal_st;
        $no_st = $berkas->no_st;
        $nama_wali_nagari = strtoupper($berkas->nama_wali_nagari);

        $result = json_decode($berkas->nama_pemohon);
        if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($berkas->nama_pemohon);
            try {
                $nama = implode(", ", $array);
                } catch (Exception $e) {
                $nama = $berkas->nama_pemohon;
                }
        }
        else {
            $nama = $berkas->nama_pemohon;
        }
            
        if ($tanggal==null){
            $tanggal = Carbon::now()->isoFormat('D MMMM Y');
        }
        else {
            //$tanggal = date('d-m-Y', strtotime($tanggal));
            $tanggal = Carbon::parse($tanggal)->isoFormat('D MMMM Y');
        }
        
        if ($no_st==null){
            $no_st = "      /002-03.04/    /".$tahun;
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
    }

    public function undangan ($id) {
        $berkas = Berkas_pemohon::find($id);
        Carbon::setLocale('id');
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
        
        $result = json_decode($berkas->nama_pemohon);
        if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($berkas->nama_pemohon);
            try {
                $nama = implode(", ", $array);
                } catch (Exception $e) {
                $nama = $berkas->nama_pemohon;
                }
        }
        else {
            $nama = $berkas->nama_pemohon;
        }

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
            $no_surat_undangan = "      /002-03.04/   /".$tahun;
        }

        if($kuasa==null){
            $kuasa = $nama;
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
    }

    public function risalah ($id) {
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
        $alas_hak = $berkas->alas_hak;
        $tanggal_alas_hak = Carbon::parse($berkas->tanggal_alas_hak)->isoFormat('D MMMM Y');
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
        

        $perorangan = "";
        $result = json_decode($berkas->nama_pemohon);
        if (json_last_error() === JSON_ERROR_NONE) {
            $cari = true;
            try {
                $pemohon = json_decode($berkas->nama_pemohon);
                $nik = json_decode($berkas->nik_pemohon); 
                $tanggal_lahir = json_decode($berkas->tanggal_lahir_pemohon); 
                $alamat = json_decode($berkas->alamat_pemohon); 
                $tempat_lahir = json_decode($berkas->tempat_lahir_pemohon);
                while ($cari == true) {
                    $val = array_search(null, $pemohon);
                    if ($val) {
                        \array_splice($pemohon, $val); //unset($pemohon[$val]);\
                        \array_splice($nik, $val, 1); //unset($nik[$val]);
                        \array_splice($tanggal_lahir, $val, 1); //unset($tanggal_lahir[$val]);
                        \array_splice($alamat, $val, 1); //unset($alamat[$val]);
                        \array_splice($tempat_lahir, $val, 1); //unset($tempat_lahir[$val]);
                    }
                    else {
                        $cari = false;
                    }
                }
                $n=0;
                for ($i = 0; $i < count($pemohon); $i++) {
                    try {
                        $perorangan = $perorangan."Nama                      : ".$pemohon[$i];
                        if (isset($tanggal_lahir[$i])){
                            //$tgl_lahir = date('d-m-Y', strtotime($tanggal_lahir[$i]))->format('%y');
                            $tgl_lahir = date('d-m-Y', strtotime($tanggal_lahir[$i]));
                        }
                        else {
                            $tgl_lahir = "";
                        }
                        if (!isset($tempat_lahir[$i])){$tempat_lahir[$i]="";}
                        if (!isset($alamat[$i])){$alamat[$i]="";}
                        if (!isset($nik[$i])){$nik[$i]="";}
                        //$nik[$i]="";$alamat[$i]="";$tempat_lahir[$i]="";
                        
                        $perorangan = $perorangan."<w:br/>No.NIK                   : ".$nik[$i]."<w:br/>Tempat/Tgl Lahir : ".$tempat_lahir[$i].", ".$tgl_lahir."<w:br/>Alamat                    : ".$alamat[$i]."<w:br/><w:br/>";
                    } catch (Exception $e) {
                        $perorangan = $perorangan."<w:br/>No.NIK                   : <w:br/>Tempat/Tgl LahirTempat/Tgl Lahir : , <w:br/>Alamat                    : <w:br/><w:br/>";
                    }
                }
            } catch (Exception $e) {
                $perorangan = $perorangan."Nama                      : <w:br/>No.NIK                   : <w:br/>Tempat/Tgl LahirTempat/Tgl Lahir : , <w:br/>Alamat                    : <w:br/><w:br/>";
            }
            //$perorangan = "<table></table>";
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

        $result = json_decode($berkas->nama_pemohon);
        if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($berkas->nama_pemohon);
            try {
                $nama = implode(", ", $array);
                } catch (Exception $e) {
                $nama = $berkas->nama_pemohon;
                }
        }
        else {
            $nama = $berkas->nama_pemohon;
        }
        
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
        $template -> setValue('alas_hak', $alas_hak);
        $template -> setValue('tanggal_alas_hak', $tanggal_alas_hak);
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
        $template -> setValue('perorangan', $perorangan);

        $path = storage_path('temp\risalah_'.$nama.'.docx');
        $template->saveAs($path);;
        //return response()->download(storage_path('surat.docx'));
        return response()->download(storage_path('temp\risalah_'.$nama.'.docx'));
    }

    public function pengumuman ($id) {
        $berkas = Berkas_pemohon::find($id);
        //return $berkas;
        $tahun = date('Y');
        $luas = $berkas->luas;
        $jorong = $berkas->jorong;
        $nagari = $berkas->nagari;
        $kecamatan = $berkas->kecamatan;
        $nib = $berkas->nib;
        $no_berkas = $berkas->no_berkas;
        $no_pbt = $berkas->no_pbt;

        $result = json_decode($berkas->nama_pemohon);
        if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($berkas->nama_pemohon);
            try {
                $nama = implode(", ", $array);
                } catch (Exception $e) {
                $nama = $berkas->nama_pemohon;
                }
        }
        else {
            $nama = $berkas->nama_pemohon;
        }
        
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
    }

    public function sk ($id) {
        Carbon::setLocale('id');
        $berkas = Berkas_pemohon::find($id);
        //return $berkas;
        $no_sk = $berkas->no_sk;
        
        $tahun = date('Y');
        $luas = $berkas->luas;
        $jorong = $berkas->jorong;
        $nagari = $berkas->nagari;
        $no_peng = $berkas->no_peng;
        $tanggal_peng = Carbon::parse($berkas->tanggal_peng)->isoFormat('D MMMM Y');
        $kecamatan = $berkas->kecamatan;
        $nib = $berkas->nib;
        $no_berkas = $berkas->no_berkas;
        $no_pbt = $berkas->no_pbt;
        

        $result = json_decode($berkas->nama_pemohon);
        if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($berkas->nama_pemohon);
            try {
                $nama = implode(", ", $array);
                } catch (Exception $e) {
                $nama = $berkas->nama_pemohon;
                }
        }
        else {
            $nama = $berkas->nama_pemohon;
        }

        
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('SK.docx'));
        $template -> setValue('nama', $nama);
        $template -> setValue('tahun', $tahun);
        $template -> setValue('no_peng', $no_peng);
        $template -> setValue('tanggal_peng', $tanggal_peng);
        $template -> setValue('luas', $luas);
        $template -> setValue('jorong', $jorong);
        $template -> setValue('nagari', $nagari);
        $template -> setValue('kecamatan', $kecamatan);


        $path = storage_path('temp\sk_'.$nama.'.docx');
        $template->saveAs($path);;
        //return response()->download(storage_path('surat.docx'));
        return response()->download(storage_path('temp\sk_'.$nama.'.docx'));
    }

    public function export(Request $request) {
        $tanggal_mulai = $request->tanggal_mulai;
        $sampai_tanggal = $request->sampai_tanggal;
        //return $request;

        $sql = Berkas_pemohon::whereBetween('tanggal_mulai', [$tanggal_mulai, $sampai_tanggal])->orderBy('nagari')->get();
        //return $sql;
        return view('berkas.export',compact('sql'));
    }
}