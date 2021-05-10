<?php

namespace App\Http\Controllers;

use App\Models\Pemberian_hak;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;

class Pemberian_haksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = Pemberian_hak::latest()->paginate(5);
        return view('pemberian_hak.index',compact('sql'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
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
        $request->validate([
            'nama' => 'required'
        ]);
        $nama_p = $request->nama;
        if(empty($nama_p[count($nama_p)-1])) {
            unset($nama_p[count($nama_p)-1]);
        }

        $request->merge([
            'nama_pemohon' => json_encode($nama_p),
        ]);

        Pemberian_hak::create($request->all());

        return redirect()->route('pemberian_hak.index')
                        ->with('success','Berkas berkasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemberian_hak  $pemberian_hak
     * @return \Illuminate\Http\Response
     */
    public function show(Pemberian_hak $pemberian_hak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemberian_hak  $pemberian_hak
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemberian_hak $pemberian_hak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemberian_hak  $pemberian_hak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemberian_hak $pemberian_hak)
    {
        $request->validate([
            'nama_pemohon' => 'required'
        ]);

        //$berkas = Pemberian_hak::find($id);
        //return $request;
        //return $berkas->no_sk;

        $pemberian_hak->update($request->all());

        return redirect()->back()->with('success', 'Berkas '.$pemberian_hak->no_berkas.' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemberian_hak  $pemberian_hak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemberian_hak $pemberian_hak)
    {
        //
    }

    public function st($id)
    {
        $berkas = Pemberian_hak::find($id);
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
        $berkas = Pemberian_hak::find($id);
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
        } else {
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

    public function ikhtisar ($id) {
        $berkas = Pemberian_hak::find($id);
        Carbon::setLocale('id');
        $tahun = date('Y');
        $luas = $berkas->luas;
        $jorong = $berkas->jorong;
        $nagari = $berkas->nagari;
        $kecamatan = $berkas->kecamatan;
        $no_pbt = $berkas->no_pbt;
        $tanggal_pbt = Carbon::parse($berkas->tanggal_pbt)->isoFormat('D MMMM Y');
        $nib = $berkas->nib;
        $rencana_penggunaan = $berkas->rencana_penggunaan;

        $no_ikhtisar = $berkas->no_ikhtisar;
        $tanggal_ikhtisar = Carbon::parse($berkas->tanggal_ikhtisar)->isoFormat('D MMMM Y');
        
        $result = json_decode($berkas->nama_pemohon);
        if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($berkas->nama_pemohon);
            $val = array_search(null, $array);
            if ($val) {unset($array[$val]);}
            try {
                $nama = implode(", ", $array);
                } catch (Exception $e) {
                $nama = $berkas->nama_pemohon;
                }
        } else {
            $nama = $berkas->nama_pemohon;
        }

        $result = json_decode($berkas->tanggal_lahir_pemohon);
        if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($berkas->tanggal_lahir_pemohon);
            if ($val) {if (var_dump(isset($array[$val]))){unset($array[$val]);}}
            try {
                $n = count($array);
                $umur="";
                for ($i = 0; $i < $n; $i++){
                    if ($array[$i]){
                        $lahir    =new DateTime($array[$i]);
                        $today        =new DateTime();
                        $umur = $umur."± ".$today->diff($lahir)->format('%y')." Tahun, ";
                    }
                    else {
                        $umur = $umur."± 0 Tahun, ";
                    }
                }
                $umur = rtrim($umur, ',');
                } catch (Exception $e) {
                    $umur = "± 0 Tahun";
                }
        } else {
            $lahir    =new DateTime($berkas->tanggal_lahir_pemohon);
            $today        =new DateTime();
            $umur = $today->diff($lahir)->format('%y');
            $umur = "± ".$umur." Tahun";
            
        }

        $result = json_decode($berkas->pekerjaan);
        if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($berkas->pekerjaan);
            if ($val) {if (var_dump(isset($array[$val]))){unset($array[$val]);}}
            try {
                $pekerjaan = implode(", ", $array);
                } catch (Exception $e) {
                $pekerjaan = $berkas->pekerjaan;
                }
        } else {
            $pekerjaan = $berkas->pekerjaan;
        }


        $result = json_decode($berkas->alamat_pemohon);
        if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($berkas->alamat_pemohon);
            if ($val) {if (var_dump(isset($array[$val]))){unset($array[$val]);}}
            try {
                $alamat_pemohon = implode(", ", $array);
                } catch (Exception $e) {
                $alamat_pemohon = $berkas->alamat_pemohon;
                }
        } else {
            $alamat_pemohon = $berkas->alamat_pemohon;
        }
        // $pekerjaan="";
        // $alamat_pemohon="";


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
        
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('pemberian_hak\ikhtisar.docx'));
        $template -> setValue('nama', ucwords($nama) );
        $template -> setValue('pekerjaan', ucwords($pekerjaan) );
        $template -> setValue('alamat_pemohon', $alamat_pemohon );
        $template -> setValue('umur', $umur );
        $template -> setValue('jorong', ucwords($jorong));
        $template -> setValue('nagari', ucwords($nagari));
        $template -> setValue('kecamatan', ucwords($kecamatan));
        $template -> setValue('luas', $luas);
        $template -> setValue('luas_huruf', $luas_huruf);
        $template -> setValue('tanggal_pbt', $tanggal_pbt);
        $template -> setValue('nib', $nib);
        $template -> setValue('no_pbt', $no_pbt);
        $template -> setValue('rencana_penggunaan', $rencana_penggunaan);
        
        $template -> setValue('no_ikhtisar', $no_ikhtisar);
        $template -> setValue('tanggal_ikhtisar', $tanggal_ikhtisar);

        $path = storage_path('temp\ikhtisar_'.$nama.'.docx');
        $template->saveAs($path);;
        
        $headers = [
            'Content-Type' => 'application/docx',
        ];

        return response()->download($path, 'ikhtisar_'.$nama.'.docx', $headers);
    }

    public function risalah ($id) {
        Carbon::setLocale('id');
        $berkas = Pemberian_hak::find($id);
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
        $tanggal_penguasaan_fisik = Carbon::parse($berkas->tanggal_penguasaan_fisik)->isoFormat('D MMMM Y');
        $no_suket_wali_nagari = $berkas->no_suket_wali_nagari;
        $tanggal_suket_wali_nagari = Carbon::parse($berkas->tanggal_suket_wali_nagari)->isoFormat('D MMMM Y');
        $no_sk_kan = $berkas->no_sk_kan;
        $tanggal_sk_kan = Carbon::parse($berkas->tanggal_sk_kan)->isoFormat('D MMMM Y');
        $penggunaan_saat_ini = $berkas->penggunaan_saat_ini;
        $rencana_penggunaan = $berkas->rencana_penggunaan;
        $penggunaan_rtrw = $berkas->penggunaan_rtrw;
        $utara = $berkas->utara;
        $selatan = $berkas->selatan;
        $barat = $berkas->barat;
        $timur = $berkas->timur;
        $tanggal_surat_setoran_bphtb = Carbon::parse($berkas->tanggal_surat_setoran_bphtb)->isoFormat('D MMMM Y');
        $tgl_pernyataan_tanah_yg_dipunyai = Carbon::parse($berkas->tgl_pernyataan_tanah_yg_dipunyai)->isoFormat('D MMMM Y');
        $tanggal_tanda_batas = Carbon::parse($berkas->tanggal_tanda_batas)->isoFormat('D MMMM Y');
        $nama_wali_nagari = strtoupper($berkas->nama_wali_nagari);
        $tgl_sk_kantah_panitia_a = Carbon::parse($berkas->tgl_sk_kantah_panitia_a)->isoFormat('D MMMM Y');
        $no_sk_kantah_panitia_a = $berkas->no_sk_kantah_panitia_a;
        if($no_sk_kantah_panitia_a==null){
            $no_sk_kantah_panitia_a = "85/SK- 13.06.HP.01/XI/2020";
        }
        
            $tanggal_ris = date('d-m-Y', strtotime($tanggal_ris));
            $hari = Carbon::parse($tanggal_ris)->isoFormat('dddd');
            $bulan = Carbon::parse($tanggal_ris)->isoFormat('MMMM');
            $tanggal_angka = date('d', strtotime($tanggal_ris));
            $tahun_angka = date('Y', strtotime($tanggal_ris));
        
        $result = json_decode($berkas->nama_pemohon);
            if (json_last_error() === JSON_ERROR_NONE) {
                $array = json_decode($berkas->nama_pemohon);
                try {
                    $nama = implode(", ", $array);
                    } catch (Exception $e) {
                    $nama = $berkas->nama_pemohon;
                    }
            } else {
                $nama = $berkas->nama_pemohon;
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
                $pekerjaan = json_decode($berkas->pekerjaan); 
                while ($cari == true) {
                    $val = array_search(null, $pemohon);
                    if ($val) {
                        \array_splice($pemohon, $val); //unset($pemohon[$val]);\
                        \array_splice($nik, $val, 1); //unset($nik[$val]);
                        \array_splice($tanggal_lahir, $val, 1); //unset($tanggal_lahir[$val]);
                        \array_splice($alamat, $val, 1); //unset($alamat[$val]);
                        \array_splice($pekerjaan, $val, 1); //unset($pekerjaan[$val]);
                    }
                    else {
                        $cari = false;
                    }
                }
                $n=0;
                for ($i = 0; $i < count($pemohon); $i++) {
                    try {
                        $perorangan = $perorangan."Nama        :  ".$pemohon[$i];
                        if (isset($tanggal_lahir[$i])){
                            $lahir    =new DateTime($tanggal_lahir[$i]);
                            $today    =new DateTime();
                            $umur = "± ".$today->diff($lahir)->format('%y')." Tahun";
                            //return $umur;
                        }
                        else {
                            $umur = "";
                        }
                        if (!isset($pekerjaan[$i])){$pekerjaan[$i]="";}
                        if (!isset($alamat[$i])){$alamat[$i]="";}
                        if (!isset($nik[$i])){$nik[$i]="";}
                        //$nik[$i]="";$alamat[$i]="";$pekerjaan[$i]="";
                        
                        $perorangan = $perorangan."<w:br/>Umur        : ".$umur."<w:br/>Pekerjaan : ".$pekerjaan[$i]."<w:br/>Alamat     : ".$alamat[$i]."<w:br/>KTP No.   : ".$nik[$i]."<w:br/><w:br/>";
                    } catch (Exception $e) {
                        $perorangan = $perorangan."<w:br/>Umur        : <w:br/>Pekerjaan : <w:br/>Alamat     : <w:br/><w:br/>KTP No.   : <w:br/><w:br/>";
                    }
                }
            } catch (Exception $e) {
                $perorangan = $perorangan."Nama        :  <w:br/>Umur        : <w:br/>Pekerjaan : <w:br/>Alamat     : <w:br/><w:br/>KTP No.   : <w:br/><w:br/>";
            }
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
        
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('pemberian_hak\risalah.docx'));
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
        $template -> setValue('utara', $utara);
        $template -> setValue('selatan', $selatan);
        $template -> setValue('barat', $barat);
        $template -> setValue('timur', $timur);
        $template -> setValue('tahun', $tahun);
        $template -> setValue('alamat_pemohon', $alamat_pemohon);
        $template -> setValue('nik_pemohon', $nik_pemohon);
        $template -> setValue('tanggal_lahir', $tanggal_lahir_pemohon);
        $template -> setValue('tanggal_surat_permohonan', $tanggal_surat_permohonan);
        $template -> setValue('tanggal_penguasaan_fisik', $tanggal_penguasaan_fisik);
        $template -> setValue('tanggal_sk_kan', $tanggal_sk_kan);
        $template -> setValue('no_sk_kan', $no_sk_kan);
        $template -> setValue('no_suket_wali_nagari', $no_suket_wali_nagari);
        $template -> setValue('tanggal_suket_wali_nagari', $tanggal_suket_wali_nagari);
        $template -> setValue('penggunaan_saat_ini', $penggunaan_saat_ini);
        $template -> setValue('rencana_penggunaan', $rencana_penggunaan);
        $template -> setValue('tanggal_surat_setoran_bphtb', $tanggal_surat_setoran_bphtb);
        $template -> setValue('tgl_pernyataan_tanah_yg_dipunyai', $tgl_pernyataan_tanah_yg_dipunyai);
        $template -> setValue('tanggal_tanda_batas', $tanggal_tanda_batas);
        $template -> setValue('penggunaan', $penggunaan_rtrw);
        $template -> setValue('nama_wali_nagari', $nama_wali_nagari);
        $template -> setValue('no_sk_kantah_panitia_a', $no_sk_kantah_panitia_a);
        $template -> setValue('tgl_sk_kantah_panitia_a', $tgl_sk_kantah_panitia_a);
        $template -> setValue('perorangan', $perorangan);

        $path = storage_path('temp\risalah_'.$nama.'.docx');
        $template->saveAs($path);;
        //return response()->download(storage_path('surat.docx'));
        return response()->download(storage_path('temp\risalah_'.$nama.'.docx'));
    }

    public function rpd ($id) {
        Carbon::setLocale('id');
        $berkas = Pemberian_hak::find($id);
        //return $berkas;
        $nama = $berkas->nama_pemohon;
        $tahun = date('Y');
        $luas = $berkas->luas;
        $nagari = $berkas->nagari;
        $kecamatan = $berkas->kecamatan;
        $tanggal_ris = Carbon::parse($berkas->tanggal_ris)->isoFormat('D MMMM Y');
        $tanggal_st = Carbon::parse($berkas->tanggal_st)->isoFormat('D MMMM Y');
        $no_ikhtisar = $berkas->no_ikhtisar;
        $tanggal_ikhtisar = Carbon::parse($berkas->tanggal_ikhtisar)->isoFormat('D MMMM Y');
        $tanggal_pbt = Carbon::parse($berkas->tanggal_pbt)->isoFormat('D MMMM Y');
        $no_pbt = $berkas->no_pbt;
        $jorong = $berkas->jorong;
        $nib = $berkas->nib;
        $alamat_pemohon = $berkas->alamat_pemohon;
        $nik_pemohon = $berkas->nik_pemohon;
        $tempat_lahir_pemohon = $berkas->tempat_lahir_pemohon;
        $no_ris = $berkas->no_ris;
        $tanggal_surat_permohonan = Carbon::parse($berkas->tanggal_surat_permohonan)->isoFormat('D MMMM Y');
        $tanggal_penguasaan_fisik = Carbon::parse($berkas->tanggal_penguasaan_fisik)->isoFormat('D MMMM Y');
        $no_suket_wali_nagari = $berkas->no_suket_wali_nagari;
        $tanggal_suket_wali_nagari = Carbon::parse($berkas->tanggal_suket_wali_nagari)->isoFormat('D MMMM Y');
        $no_sk_kan = $berkas->no_sk_kan;
        $tanggal_sk_kan = Carbon::parse($berkas->tanggal_sk_kan)->isoFormat('D MMMM Y');
        $penggunaan_saat_ini = $berkas->penggunaan_saat_ini;
        $rencana_penggunaan = $berkas->rencana_penggunaan;
        $penggunaan_rtrw = $berkas->penggunaan_rtrw;
        $utara = $berkas->utara;
        $selatan = $berkas->selatan;
        $barat = $berkas->barat;
        $timur = $berkas->timur;
        $tanggal_surat_setoran_bphtb = Carbon::parse($berkas->tanggal_surat_setoran_bphtb)->isoFormat('D MMMM Y');
        $tgl_pernyataan_tanah_yg_dipunyai = Carbon::parse($berkas->tgl_pernyataan_tanah_yg_dipunyai)->isoFormat('D MMMM Y');
        $tanggal_tanda_batas = Carbon::parse($berkas->tanggal_tanda_batas)->isoFormat('D MMMM Y');
        $nama_wali_nagari = strtoupper($berkas->nama_wali_nagari);
        $tgl_sk_kantah_panitia_a = Carbon::parse($berkas->tgl_sk_kantah_panitia_a)->isoFormat('D MMMM Y');
        $no_sk_kantah_panitia_a = $berkas->no_sk_kantah_panitia_a;
        $tgl_pernyataan_tanah_yg_dipunyai = Carbon::parse($berkas->tgl_pernyataan_tanah_yg_dipunyai)->isoFormat('D MMMM Y');
        if($no_sk_kantah_panitia_a==null){
            $no_sk_kantah_panitia_a = "85/SK- 13.06.HP.01/XI/2020";
        }
        
        $result = json_decode($berkas->nama_pemohon);
            if (json_last_error() === JSON_ERROR_NONE) {
                $array = json_decode($berkas->nama_pemohon);
                try {
                    $nama = implode(", ", $array);
                    } catch (Exception $e) {
                    $nama = $berkas->nama_pemohon;
                    }
            } else {
                $nama = $berkas->nama_pemohon;
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
                $pekerjaan = json_decode($berkas->pekerjaan); 
                while ($cari == true) {
                    $val = array_search(null, $pemohon);
                    if ($val) {
                        \array_splice($pemohon, $val); //unset($pemohon[$val]);\
                        \array_splice($nik, $val, 1); //unset($nik[$val]);
                        \array_splice($tanggal_lahir, $val, 1); //unset($tanggal_lahir[$val]);
                        \array_splice($alamat, $val, 1); //unset($alamat[$val]);
                        \array_splice($pekerjaan, $val, 1); //unset($pekerjaan[$val]);
                    }
                    else {
                        $cari = false;
                    }
                }
                $n=0;
                for ($i = 0; $i < count($pemohon); $i++) {
                    try {
                        $perorangan = $perorangan."Nama        :  ".$pemohon[$i];
                        if (isset($tanggal_lahir[$i])){
                            $lahir    =new DateTime($tanggal_lahir[$i]);
                            $today    =new DateTime();
                            $umur = "± ".$today->diff($lahir)->format('%y')." Tahun";
                        }
                        else {
                            $umur = "";
                        }
                        if (!isset($pekerjaan[$i])){$pekerjaan[$i]="";}
                        if (!isset($alamat[$i])){$alamat[$i]="";}
                        if (!isset($nik[$i])){$nik[$i]="";}
                        
                        $perorangan = $perorangan."<w:br/>Umur        : ".$umur."<w:br/>Pekerjaan : ".$pekerjaan[$i]."<w:br/>Alamat     : ".$alamat[$i]."<w:br/>KTP No.   : ".$nik[$i]."<w:br/><w:br/>";
                    } catch (Exception $e) {
                        $perorangan = $perorangan."<w:br/>Umur        : <w:br/>Pekerjaan : <w:br/>Alamat     : <w:br/><w:br/>KTP No.   : <w:br/>";
                    }
                }
            } catch (Exception $e) {
                $perorangan = $perorangan."Nama        :  <w:br/>Umur        : <w:br/>Pekerjaan : <w:br/>Alamat     : <w:br/><w:br/>KTP No.   : <w:br/>";
            }
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

        $luas_huruf = ucwords( trim(penyebut($luas)) ) ;
        
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('pemberian_hak\rpd.docx'));
        $template -> setValue('no_ris', $no_ris);
        $template -> setValue('nama', $nama);
        $template -> setValue('tahun', $tahun);
        $template -> setValue('luas', $luas);
        $template -> setValue('nagari', $nagari);
        $template -> setValue('kecamatan', $kecamatan);
        $template -> setValue('tanggal_ris', $tanggal_ris);
        $template -> setValue('tanggal_pbt', $tanggal_pbt);
        $template -> setValue('no_pbt', $no_pbt);
        $template -> setValue('luas_huruf', $luas_huruf);
        $template -> setValue('jorong', $jorong);
        $template -> setValue('nib', $nib);
        $template -> setValue('utara', $utara);
        $template -> setValue('selatan', $selatan);
        $template -> setValue('barat', $barat);
        $template -> setValue('timur', $timur);
        $template -> setValue('tahun', $tahun);
        $template -> setValue('alamat_pemohon', $alamat_pemohon);
        $template -> setValue('nik_pemohon', $nik_pemohon);
        $template -> setValue('tanggal_surat_permohonan', $tanggal_surat_permohonan);
        $template -> setValue('tanggal_penguasaan_fisik', $tanggal_penguasaan_fisik);
        $template -> setValue('tanggal_sk_kan', $tanggal_sk_kan);
        $template -> setValue('no_sk_kan', $no_sk_kan);
        $template -> setValue('no_suket_wali_nagari', $no_suket_wali_nagari);
        $template -> setValue('tanggal_suket_wali_nagari', $tanggal_suket_wali_nagari);
        $template -> setValue('penggunaan_saat_ini', $penggunaan_saat_ini);
        $template -> setValue('rencana_penggunaan', $rencana_penggunaan);
        $template -> setValue('tanggal_surat_setoran_bphtb', $tanggal_surat_setoran_bphtb);
        $template -> setValue('tgl_pernyataan_tanah_yg_dipunyai', $tgl_pernyataan_tanah_yg_dipunyai);
        $template -> setValue('tanggal_tanda_batas', $tanggal_tanda_batas);
        $template -> setValue('penggunaan', $penggunaan_rtrw);
        $template -> setValue('nama_wali_nagari', $nama_wali_nagari);
        $template -> setValue('no_sk_kantah_panitia_a', $no_sk_kantah_panitia_a);
        $template -> setValue('tgl_sk_kantah_panitia_a', $tgl_sk_kantah_panitia_a);
        $template -> setValue('no_ikhtisar', $no_ikhtisar);
        $template -> setValue('tanggal_ikhtisar', $tanggal_ikhtisar);
        $template -> setValue('tanggal_penguasaan_fisik', $tanggal_penguasaan_fisik);
        $template -> setValue('tgl_pernyataan_tanah_yg_dipunyai', $tgl_pernyataan_tanah_yg_dipunyai);
        $template -> setValue('perorangan', $perorangan);

        $path = storage_path('temp\rpd_'.$nama.'.docx');
        $template->saveAs($path);;
        //return response()->download(storage_path('surat.docx'));
        return response()->download(storage_path('temp\rpd_'.$nama.'.docx'));
    }

    public function telaahan ($id) {
        $berkas = Pemberian_hak::find($id);
        Carbon::setLocale('id');
        $tahun = date('Y');
        $luas = $berkas->luas;
        $jorong = $berkas->jorong;
        $nagari = $berkas->nagari;
        $kecamatan = $berkas->kecamatan;
        $no_pbt = $berkas->no_pbt;
        $tanggal_pbt = Carbon::parse($berkas->tanggal_pbt)->isoFormat('D MMMM Y');
        $nib = $berkas->nib;
        $no_ris = $berkas->no_ris;
        $tanggal_ris = Carbon::parse($berkas->tanggal_pbt)->isoFormat('D MMMM Y');
        $no_ikhtisar = $berkas->no_ikhtisar;
        $tanggal_ikhtisar = Carbon::parse($berkas->tanggal_ikhtisar)->isoFormat('D MMMM Y');
        $tanggal_surat_permohonan = Carbon::parse($berkas->tanggal_surat_permohonan)->isoFormat('D MMMM Y');
        $tanggal_penguasaan_fisik = Carbon::parse($berkas->tanggal_penguasaan_fisik)->isoFormat('D MMMM Y');
        $no_suket_wali_nagari = $berkas->no_suket_wali_nagari;
        $tanggal_suket_wali_nagari = Carbon::parse($berkas->tanggal_suket_wali_nagari)->isoFormat('D MMMM Y');
        $no_sk_kan = $berkas->no_sk_kan;
        $tanggal_sk_kan = Carbon::parse($berkas->tanggal_sk_kan)->isoFormat('D MMMM Y');
        $tanggal_surat_setoran_bphtb = Carbon::parse($berkas->tanggal_surat_setoran_bphtb)->isoFormat('D MMMM Y');
        $tgl_pernyataan_tanah_yg_dipunyai = Carbon::parse($berkas->tgl_pernyataan_tanah_yg_dipunyai)->isoFormat('D MMMM Y');
        $tanggal_tanda_batas = Carbon::parse($berkas->tanggal_tanda_batas)->isoFormat('D MMMM Y');
        $tanggal_berkas_didaftarkan = Carbon::parse($berkas->tanggal_berkas_didaftarkan)->isoFormat('D MMMM Y');
        
        $result = json_decode($berkas->nama_pemohon);
        if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($berkas->nama_pemohon);
            $val = array_search(null, $array);
            if ($val) {unset($array[$val]);}
            try {
                $nama = implode(", ", $array);
                } catch (Exception $e) {
                $nama = $berkas->nama_pemohon;
                }
        } else {
            $nama = $berkas->nama_pemohon;
        }

        
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('pemberian_hak\telaahan.docx'));
        $template -> setValue('nama', ucwords($nama) );
        $template -> setValue('jorong', ucwords($jorong));
        $template -> setValue('nagari', ucwords($nagari));
        $template -> setValue('kecamatan', ucwords($kecamatan));
        $template -> setValue('luas', $luas);
        $template -> setValue('tanggal_pbt', $tanggal_pbt);
        $template -> setValue('nib', $nib);
        $template -> setValue('no_pbt', $no_pbt);
        $template -> setValue('no_ikhtisar', $no_ikhtisar);
        $template -> setValue('tanggal_ikhtisar', $tanggal_ikhtisar);
        $template -> setValue('tanggal_surat_permohonan', $tanggal_surat_permohonan);
        $template -> setValue('tanggal_penguasaan_fisik', $tanggal_penguasaan_fisik);
        $template -> setValue('tanggal_sk_kan', $tanggal_sk_kan);
        $template -> setValue('no_sk_kan', $no_sk_kan);
        $template -> setValue('no_suket_wali_nagari', $no_suket_wali_nagari);
        $template -> setValue('tanggal_suket_wali_nagari', $tanggal_suket_wali_nagari);
        $template -> setValue('tanggal_surat_setoran_bphtb', $tanggal_surat_setoran_bphtb);
        $template -> setValue('tgl_pernyataan_tanah_yg_dipunyai', $tgl_pernyataan_tanah_yg_dipunyai);
        $template -> setValue('tanggal_tanda_batas', $tanggal_tanda_batas);
        $template -> setValue('no_ikhtisar', $no_ikhtisar);
        $template -> setValue('tanggal_ikhtisar', $tanggal_ikhtisar);
        $template -> setValue('no_ris', $no_ris);
        $template -> setValue('tanggal_ris', $tanggal_ris);
        $template -> setValue('tanggal_penguasaan_fisik', $tanggal_penguasaan_fisik);
        $template -> setValue('tgl_pernyataan_tanah_yg_dipunyai', $tgl_pernyataan_tanah_yg_dipunyai);
        $template -> setValue('tanggal_berkas_didaftarkan', $tanggal_berkas_didaftarkan);

        $path = storage_path('temp\telaahan_'.$nama.'.docx');
        $template->saveAs($path);;
        
        $headers = [
            'Content-Type' => 'application/docx',
        ];

        return response()->download($path, 'telaahan_'.$nama.'.docx', $headers);
    }

    public function SK ($id) {
        $berkas = Pemberian_hak::find($id);
        Carbon::setLocale('id');
        $tahun = date('Y');
        $luas = $berkas->luas;
        $jorong = $berkas->jorong;
        $nagari = $berkas->nagari;
        $kecamatan = $berkas->kecamatan;
        $no_pbt = $berkas->no_pbt;
        $tanggal_pbt = Carbon::parse($berkas->tanggal_pbt)->isoFormat('D MMMM Y');
        $nib = $berkas->nib;
        $no_ris = $berkas->no_ris;
        $tanggal_ris = Carbon::parse($berkas->tanggal_pbt)->isoFormat('D MMMM Y');
        $tanggal_surat_permohonan = Carbon::parse($berkas->tanggal_surat_permohonan)->isoFormat('D MMMM Y');
        $tanggal_penguasaan_fisik = Carbon::parse($berkas->tanggal_penguasaan_fisik)->isoFormat('D MMMM Y');
        $no_suket_wali_nagari = $berkas->no_suket_wali_nagari;
        $tanggal_suket_wali_nagari = Carbon::parse($berkas->tanggal_suket_wali_nagari)->isoFormat('D MMMM Y');
        $no_sk_kan = $berkas->no_sk_kan;
        $tanggal_sk_kan = Carbon::parse($berkas->tanggal_sk_kan)->isoFormat('D MMMM Y');
        $rencana_penggunaan = $berkas->rencana_penggunaan;
        $penggunaan_saat_ini = $berkas->penggunaan_saat_ini;
        $tanggal_berkas_didaftarkan = Carbon::parse($berkas->tanggal_berkas_didaftarkan)->isoFormat('D MMMM Y');
        
        $result = json_decode($berkas->nama_pemohon);
        if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($berkas->nama_pemohon);
            $val = array_search(null, $array);
            if ($val) {unset($array[$val]);}
            try {
                $nama = implode(", ", $array);
                } catch (Exception $e) {
                $nama = $berkas->nama_pemohon;
                }
        } else {
            $nama = $berkas->nama_pemohon;
        }

        $result = json_decode($berkas->alamat_pemohon);
        if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($berkas->alamat_pemohon);
            if ($val) {if (var_dump(isset($array[$val]))){unset($array[$val]);}}
            try {
                $alamat_pemohon = implode(", ", $array);
                } catch (Exception $e) {
                $alamat_pemohon = $berkas->alamat_pemohon;
                }
        } else {
            $alamat_pemohon = $berkas->alamat_pemohon;
        }
        // $pekerjaan="";
        // $alamat_pemohon="";


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

        
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('pemberian_hak\sk.docx'));
        $template -> setValue('NAMA', strtoupper($nama) );
        $template -> setValue('NAGARI', strtoupper($nagari) );
        $template -> setValue('KECAMATAN', strtoupper($kecamatan) );
        $template -> setValue('nama', ucwords($nama) );
        $template -> setValue('alamat', ucwords($alamat_pemohon) );
        $template -> setValue('jorong', ucwords($jorong));
        $template -> setValue('nagari', ucwords($nagari));
        $template -> setValue('kecamatan', ucwords($kecamatan));
        $template -> setValue('luas', $luas);
        $template -> setValue('luas_huruf', $luas_huruf);
        $template -> setValue('tanggal_pbt', $tanggal_pbt);
        $template -> setValue('nib', $nib);
        $template -> setValue('no_pbt', $no_pbt);
        $template -> setValue('tanggal_surat_permohonan', $tanggal_surat_permohonan);
        $template -> setValue('tanggal_sk_kan', $tanggal_sk_kan);
        $template -> setValue('no_sk_kan', $no_sk_kan);
        $template -> setValue('no_suket_wali_nagari', $no_suket_wali_nagari);
        $template -> setValue('tanggal_suket_wali_nagari', $tanggal_suket_wali_nagari);
        $template -> setValue('rencana_penggunaan', $rencana_penggunaan);
        $template -> setValue('penggunaan_saat_ini', $penggunaan_saat_ini);
        $template -> setValue('tahun', $tahun);$template -> setValue('tanggal_penguasaan_fisik', $tanggal_penguasaan_fisik);
        $template -> setValue('no_ris', $no_ris);
        $template -> setValue('tanggal_ris', $tanggal_ris);
        $template -> setValue('tanggal_berkas_didaftarkan', $tanggal_berkas_didaftarkan);
        // $template -> setValue('tgl_pernyataan_tanah_yg_dipunyai', $tgl_pernyataan_tanah_yg_dipunyai);
        
        // $template -> setValue('tanggal_tanda_batas', $tanggal_tanda_batas);
        
        
        
        // $template -> setValue('tgl_pernyataan_tanah_yg_dipunyai', $tgl_pernyataan_tanah_yg_dipunyai);
        // $template -> setValue('tanggal_berkas_didaftarkan', $tanggal_berkas_didaftarkan);

        $path = storage_path('temp\sk_'.$nama.'.docx');
        $template->saveAs($path);;
        
        $headers = [
            'Content-Type' => 'application/docx',
        ];

        return response()->download($path, 'sk_'.$nama.'.docx', $headers);
    }

    public function cari_nama(Request $request){
        $nama_pemohon = strtolower($request->nama_pemohon);

        $sql = Pemberian_hak::whereRaw('lower(nama_pemohon) like (?)',["%{$nama_pemohon}%"])->paginate(5);
            return view ('pemberian_hak.index',[
                'nama_pemohon' => $nama_pemohon,
                'sql' => $sql
            ])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function cari_noberkas(Request $request){
        $no_berkas = $request->no_berkas;

        $sql = Pemberian_hak::whereRaw('no_berkas like (?)',["%{$no_berkas}%"])->paginate(5);
            return view ('pemberian_hak.index',[
                'no_berkas' => $no_berkas,
                'sql' => $sql
            ])->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
