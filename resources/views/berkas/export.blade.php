@extends('layouts.template')

@section('content')
    @php 
        $j=1; 
        $no=1; 
        $nagari = "";
        $total = 0;
        $lanjut = true;
        $jtotal = 0;
        $j=0;
    @endphp

    <table class="table table-bordered" border="1">
        <tr style="text-align: center; font-weight: bold;">
            <td rowspan="2">No</td>
            <td rowspan="2">Tanggal</td>
            <td rowspan="2">No Bukti</td>
            <td rowspan="2">Uraian</td>
            <td rowspan="2">Nama Pemohon</td>
            <td rowspan="2">Bidang</td>
            <td rowspan="2">Luas</td>
            <td rowspan="2">Biaya</td>
            <td colspan="2">Surat Tugas</td>
            <td colspan="2">Risalah</td>
            <td rowspan="2">Nagari</td>
    </tr>
    <tr style="text-align: center; font-weight: bold;">
        <td>Tanggal</td>
        <td>Nomor</td>
        <td>Tanggal</td>
        <td>Nomor</td>
    </tr>

    @foreach ($sql as $b)
        @if ( str_replace(' ', '', strtoupper($b->nagari)) != str_replace(' ', '', strtoupper($nagari)))
            @php 
                $nagari = $b->nagari;
                $j=1;
                $total = 0;
                $lanjut = true;
            @endphp 
            <tr><td colspan="13"></td></tr>
            
        @else
            @php $lanjut = false; @endphp
        @endif
        @php
            $nama_p="";
            $result = json_decode($b->nama_pemohon);
            if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($b->nama_pemohon);
            try {
                $nama_p = implode(", ", $array);
            } catch (Exception $e) {
                $nama_p = $b->nama_pemohon;
            }
            }
            else {
                $nama_p = $b->nama_pemohon;
            }
        @endphp
        <tr>   
        <td>{{ $no }}</td>
        <td>{{ date('d-m-Y', strtotime($b->tanggal_mulai)) }}</td>
        <td>'{{ $b->no_berkas }}/{{ $b->tahun }}</td>
        <td>
            Pendaftaran Tanah Pertama Kali <br/>
            Pengakuan/Penegasan Hak
        </td>
        <td>{{ $nama_p }}</td>
        <td>1</td>
        <td>{{ $b->luas }} M <sup>2</sup></td>
        <td>@if (isset($b->total_biaya)) Rp. {{ str_replace(",",".", number_format($b->total_biaya)) }} @endif</td>
        <td>@if ($b->tanggal_st) {{ date('d-m-Y', strtotime($b->tanggal_st)) }} @endif</td>
        <td>{{ $b->no_st }}</td>
        <td>@if ($b->tanggal_ris) {{ date('d-m-Y', strtotime($b->tanggal_ris)) }} @endif</td>
        <td>'{{ $b->no_ris }}</td>
        <td>{{ $b->nagari }}</td>
    </tr>
    @php 
        $j=$j+1; 
        $total = $total + $b->total_biaya;
        $jtotal = $jtotal + $b->total_biaya;
        $no++;
    @endphp
    @if ($lanjut == false)
        <tr>
        <td colspan="5" style="text-align: center;">Jumlah</td>
        <td>{{ $j-1 }}</td>
        <td></td>
        <td>Rp. {{ str_replace(",",".", number_format($total)) }}</td>
        <td colspan="5"></td>
        </tr>
        
        
    @endif
    @endforeach
    <tr>
        <td colspan="5" style="text-align: center;">J U M L A H</td>
        <td>{{ $j-1 }}</td>
        <td></td>
        <td>Rp. {{ str_replace(",",".", number_format($total)) }}</td>
        <td colspan="5"></td>
        </tr>

        <tr style="font-weight: bold;">
            <td colspan="5" style="text-align: center; font-weight: bold;">T O T A L&nbsp;&nbsp;&nbsp;J U M L A H</td>
            <td>{{ $no-1 }}</td>
            <td></td>
            <td>Rp. {{ str_replace(",",".", number_format($jtotal)) }}</td>
            <td colspan="5"></td>
        </tr>
        </table>
        

        @php
        //header("Content-type: application/vnd-ms-excel");
        //header("Content-Disposition: attachment; filename=export.xls");
        @endphp
@endsection