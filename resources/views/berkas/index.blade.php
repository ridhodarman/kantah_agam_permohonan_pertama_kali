@extends('layouts.template')

@section('content')

<div class="row mt-5 mb-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h5>Rutin</h5>
        </div>
        <div class="float-right">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Input Berkas
            </button>
            <br/><br/>
            <div class="row">
                <div class="col-lg-2 col-sm-12">
                    <form action='{{ route("cari") }}/berkas/nama' class="search" method="GET">
                        @csrf
                        <div class="input-group w-100">
                            <input type="text" class="form-control" placeholder="Cari nama pemohon" name="nama_pemohon" 
                            value="@if(isset($nama_pemohon)){{ $nama_pemohon }}@endif">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    Q
                                </button>
                            </div>
                        </div>
                    </form> 
                </div> 
    
                <div class="col-lg-2 col-sm-12">
                    <form action='{{ route("cari") }}/berkas/no_berkas' class="search" method="GET">
                        @csrf
                        <div class="input-group w-100">
                            <input type="text" class="form-control" placeholder="Cari nomor berkas" name="no_berkas" 
                            value="@if(isset($no_berkas)){{ $no_berkas }}@endif">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    Q
                                </button>
                            </div>
                        </div>
                    </form> 
                </div> 

                <div class="col-lg-2 col-sm-12">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#export">
                        Export
                    </button>
                </div>
            </div>

            <br/>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Input Berkas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('berkas.store') }}" method="POST">
                            <div class="modal-body">
                                @csrf
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>No Berkas:</label>
                                            <input type="text" name="no_berkas" class="form-control" placeholder="0000"
                                                required>
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Tahun Masuk Berkas:</label>
                                            <input type="text" name="tahun" class="form-control"
                                                value="@php echo date('Y') @endphp">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Luas:</label>
                                            <input type="text" name="luas" class="form-control"
                                                placeholder="1234 (angka saja)">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Nagari:</label>
                                            <input type="text" name="nagari" class="form-control">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Kecamatan:</label>
                                            <input type="text" name="kecamatan" class="form-control">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>No. Surat Undangan:</label>
                                            <input type="text" id="no_surat_undangan" name="no_surat_undangan"
                                                class="form-control" placeholder="35/03.04/I/2021" onchange="no_su()">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Tanggal Surat Undangan:</label>
                                            <input type="date" id="tanggal_surat_undangan" name="tanggal_surat_undangan"
                                                class="form-control" onchange="tgl_su()">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Jam sidang di Surat Undangan:</label>
                                            <input type="text" id="jam_surat_undangan" name="jam_surat_undangan"
                                                class="form-control" placeholder="10:00">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>No. surat tugas:</label>
                                            <input type="text" id="no_st" name="no_st" class="form-control"
                                                placeholder="35/002-03.04/I/2021">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Tanggal surat tugas:</label>
                                            <input type="date" id="tanggal_st" name="tanggal_st" class="form-control">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Nama Wali Nagari:</label>
                                            <input type="text" id="nama_wali_nagari" name="nama_wali_nagari"
                                                class="form-control">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Nama Kuasa:</label>
                                            <input type="text" id="nama_kuasa" name="nama_kuasa" class="form-control"
                                                placeholder="Kosongkan jika tidak dikuasakan kepada siapa">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Nama Pemohon:</label>
                                            <input type="text" name="nama[]" class="form-control"
                                                placeholder="Nama Pemohon" required>
                                        </div>
                                        <br />
                                    </div>
                                    <div class="kolom tambahkan"></div>

                                    <button class="btn btn-success tambahp btn-sm" type="button" style="width: 50%;">
                                        <i class="glyphicon glyphicon-plus"></i> Tambah nama pemohon
                                    </button>

                                    <script>
                                        let idp = 1;
                                        $(document).ready(function () {
                                            $(".tambahp").click(function () {
                                                var html = $(".isian").html();
                                                $(".tambahkan").append(`
                                                  <div class="isian hide" id="${idp}">
            <div class="kolom">
              <label>Nama Pemohon</label>
              <input type="text" name="nama[]" class="form-control" placeholder="nama pemohon selanjutnya">
              <div style="float: right;">
                <button class="btn btn-danger btn-sm" type="button" onclick="hapus_p(${idp})"><i class="glyphicon glyphicon-hapus"></i> Remove</button>
            </div>
            </div>
            <br/>
          </div>
                                                  `);
                                                idp++;
                                            });


                                        });

                                        function hapus_p(id) {
                                            $(`#${id}`).remove();

                                        }

                                        function no_su() {
                                            let no = document.getElementById("no_surat_undangan").value;
                                            document.getElementById("no_st").value = no.replace("03.04", "002-03.04");
                                        }

                                        function tgl_su() {
                                            let tgl = document.getElementById("tanggal_surat_undangan").value;
                                            document.getElementById("tanggal_st").value = tgl;
                                        }
                                    </script>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="export" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Input Berkas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('print') }}/export" method="POST" target="_blank">
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>Tanggal Mulai:</label>
                                        <input type="date" name="tanggal_mulai"
                                            class="form-control" required>
                                    </div>
                                    <br />
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label>Sampai dengan:</label>
                                        <input type="date" name="sampai_tanggal" class="form-control" required>
                                    </div>
                                </div>
                                
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Export</button>
                            </div>
               
            </form>
            </div>
        </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ $message }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th width="20px" class="text-center">No</th>
        <th>No Berkas</th>
        <th>Tahun</th>
        <th>Nama Pemohon</th>
        <th>Letak</th>
        <th>Action</th>
        <th>Cetak</th>
    </tr>
    @foreach ($berkas as $b)
    <tr>
        <td class="text-center">{{ ++$i }}</td>
        <td>{{ $b->no_berkas }}</td>
        <td>{{ $b->tahun }}</td>
        <td>
            @php
            $nama_p="";
            $result = json_decode($b->nama_pemohon);
            if (json_last_error() === JSON_ERROR_NONE) {
            $array = json_decode($b->nama_pemohon);
            try {
            echo $nama_p = implode(", ", $array);
            } catch (Exception $e) {
            echo $nama_p = $b->nama_pemohon;
            }
            }
            else {
            echo $nama_p = $b->nama_pemohon;
            }
            @endphp
        </td>
        <td>{{ $b->nagari }},{{ $b->kecamatan }}</td>
        <td>
            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#info{{ $b->id }}"
                style="color: white; font-weight: bold;">
                Info
            </button>
            <div class="modal fade" id="info{{ $b->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Info Berkas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            No. Berkas: <b>{{ $b->no_berkas }}</b><br>
                            Tahun Masuk Berkas: <b>{{ $b->tahun }}</b><br>
                            Nama Pemohon: <b>{{ $nama_p }}</b><br>
                            NIB: <b>{{ $b->nib }}</b><br>
                            Tanggal PBT: <b>{{ $b->tanggal_pbt }}</b><br>
                            No. PBT: <b>{{ $b->no_pbt }}</b><br>
                            Luas: <b>{{ $b->luas }}</b><br>
                            Jorong: <b>{{ $b->jorong }}</b><br>
                            Nagari: <b>{{ $b->nagari }}</b><br>
                            Kecamatan: <b>{{ $b->kecamatan }}</b><br>
                            Tanggal Surat Tugas: <b>{{ $b->tanggal_st }}</b><br>
                            No. Surat Tugas: <b>{{ $b->no_st }}</b><br>
                            Tanggal Ke Lapangan: <b>{{ $b->tanggal_lap }}</b><br>
                            Tgl Risalah Panitia A: <b>{{ $b->tanggal_ris }}</b><br>
                            No. Risalah Panitia A: <b>{{ $b->no_ris }}</b><br>
                            Tanggal Pengumuman: <b>{{ $b->tanggal_peng }}</b><br>
                            No. Pengumuman: <b>{{ $b->no_peng }}</b><br>
                            Sampai dengan Tanggal: <b>{{ $b->sampai_tanggal }}</b><br>
                            Tanggal SK: <b>{{ $b->tanggal_sk }}</b><br>
                            No SK: <b>{{ $b->no_sk }}</b><br>
                            Keterangan: <b>@if (isset($b->total_biaya)) Rp. {{ number_format($b->total_biaya) }} @endif &emsp; {{ $b->tanggal_mulai }}</b><br>
                            Nama Kuasa: <b>{{ $b->nama_kuasa }}</b><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                data-bs-target="#st{{ $b->id }}">
                Edit
            </button>
            <div class="modal fade" id="st{{ $b->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Info Berkas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('berkas.update',$b->id) }}" method="POST" class="d-inline">
                            @method('PUT')
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm">
                                        No Berkas
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}no_berkas" name="no_berkas"
                                            class="form-control" value="{{ $b->no_berkas }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tahun Masuk Berkas:
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}tahun" name="tahun" class="form-control"
                                            value="{{ $b->tahun }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        NIB
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}nib" name="nib" class="form-control"
                                            value="{{ $b->nib }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tanggal PBT
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tanggal_pbt" name="tanggal_pbt"
                                            class="form-control" value="{{ $b->tanggal_pbt }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        No. PBT
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}no_pbt" name="no_pbt" class="form-control"
                                            value="{{ $b->no_pbt }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Luas
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}luas" name="luas" class="form-control"
                                            value="{{ $b->luas }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Jorong
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}jorong" name="jorong" class="form-control"
                                            value="{{ $b->jorong }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Nagari
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}nagari" name="nagari" class="form-control"
                                            value="{{ $b->nagari }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Kecamatan
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}kecamatan" name="kecamatan"
                                            class="form-control" value="{{ $b->kecamatan }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        No. Surat Undangan
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}no_surat_undangan" name="no_surat_undangan"
                                            class="form-control" value="{{ $b->no_surat_undangan }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tanggal Surat Undangan
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tanggal_surat_undangan"
                                            name="tanggal_surat_undangan" class="form-control"
                                            value="{{ $b->tanggal_surat_undangan }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Jam Surat Undangan
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}jam_surat_undangan" name="jam_surat_undangan"
                                            class="form-control" value="{{ $b->jam_surat_undangan }}"
                                            placeholder="10:00">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tanggal Surat Tugas
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tanggal_st" name="tanggal_st"
                                            class="form-control" value="{{ $b->tanggal_st }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        No. Surat Tugas
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}no_st" name="no_st" class="form-control"
                                            value="{{ $b->no_st }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tanggal Ke Lapangan
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tanggal_lap" name="tanggal_lap"
                                            class="form-control" value="{{ $b->tanggal_lap }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tgl Risalah Panitia A
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tanggal_ris" name="tanggal_ris"
                                            class="form-control" value="{{ $b->tanggal_ris }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        No. Risalah Panitia A
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}no_ris" name="no_ris" class="form-control"
                                            value="{{ $b->no_ris }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        No. SK Kepala Kantor untuk Risalah Panitia
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}no_sk_kantah_panitia"
                                            name="no_sk_kantah_panitia" class="form-control"
                                            value="{{ $b->no_sk_kantah_panitia }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tgl SK Kepala Kantor untuk Risalah Panitia
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tgl_sk_kantah_panitia"
                                            name="tgl_sk_kantah_panitia" class="form-control"
                                            value="{{ $b->tgl_sk_kantah_panitia }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tanggal Surat Permohonan
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tanggal_surat_permohonan"
                                            name="tanggal_surat_permohonan" class="form-control"
                                            value="{{ $b->tanggal_surat_permohonan }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tgl Surat Penguasan Fisik Bidang Tanah
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tanggal_penugasan_fisik"
                                            name="tanggal_penugasan_fisik" class="form-control"
                                            value="{{ $b->tanggal_penugasan_fisik }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        No. Surat Keterangan Wali Nagari
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}no_suket_wali" name="no_suket_wali"
                                            class="form-control" value="{{ $b->no_suket_wali }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tgl Surat Ket. Wali Nagari
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tanggal_suket_wali" name="tanggal_suket_wali"
                                            class="form-control" value="{{ $b->tanggal_suket_wali }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Nama Wali Nagari
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}nama_wali_nagari" name="nama_wali_nagari"
                                            class="form-control" value="{{ $b->nama_wali_nagari }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Penggunaan Lahan Saat Ini
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}penggunaan_saat_ini"
                                            name="penggunaan_saat_ini" class="form-control"
                                            value="{{ $b->penggunaan_saat_ini }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Rencana Penggunaan
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}rencana_penggunaan" name="rencana_penggunaan"
                                            class="form-control" value="{{ $b->rencana_penggunaan }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Alas Hak
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}alas_hak" name="alas_hak"
                                            class="form-control" value="{{ $b->alas_hak }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tgl Alas Hak
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tanggal_alas_hak" name="tanggal_alas_hak"
                                            class="form-control" value="{{ $b->tanggal_alas_hak }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tgl Pengumuman
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tanggal_peng" name="tanggal_peng"
                                            class="form-control" value="{{ $b->tanggal_peng }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        No. Pengumuman
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}no_peng" name="no_peng" class="form-control"
                                            value="{{ $b->no_peng }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Sampai dengan Tanggal
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}sampai_tanggal" name="sampai_tanggal"
                                            class="form-control" value="{{ $b->sampai_tanggal }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tanggal SK
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tanggal_sk" name="tanggal_sk"
                                            class="form-control" value="{{ $b->tanggal_sk }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        No. SK
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}no_sk" name="no_sk" class="form-control"
                                            value="{{ $b->no_sk }}">
                                    </div>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-sm">
                                        Tanggal Berkas Didaftarkan
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="{{ $b->id }}tanggal_berkas_didaftarkan"
                                            name="tanggal_berkas_didaftarkan" class="form-control"
                                            value="{{ $b->tanggal_berkas_didaftarkan }}">
                                    </div>
                                </div> -->
                                <!-- <div class="row">
                                <div class="col-sm">
                                            Tanggal SK Kerapatan Adat Nagari
                                        </div>
                                <div class="col-sm">
                                            <input type="date" id="{{ $b->id }}tanggal_sk_kan" name="tanggal_sk_kan" class="form-control" value="{{ $b->tanggal_sk_kan }}">
                                        </div>
                            </div>
                                    <div class="row">
                                <div class="col-sm">
                                            No. SK Kerapatan Adat Nagari
                                        </div>
                                <div class="col-sm">
                                            <input type="text" id="{{ $b->id }}no_sk_kan" name="no_sk_kan" class="form-control" value="{{ $b->no_sk_kan }}">
                                        </div>
                            </div> -->
                                <div class="row">
                                    <div class="col-sm">
                                        Nama Kuasa
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="{{ $b->id }}nama_kuasa" name="nama_kuasa"
                                            class="form-control" value="{{ $b->nama_kuasa }}"
                                            placeholder="kosongkan jika tidak dikuasakan">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Total Biaya
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" name="total_biaya"
                                            class="form-control" value="{{ $b->total_biaya }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Tanggal Mulai
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" name="tanggal_mulai"
                                            class="form-control" value="{{ $b->tanggal_mulai}}">
                                    </div>
                                </div>
                                @php
                                $result = json_decode($b->nama_pemohon);
                                if (json_last_error() === JSON_ERROR_NONE) {
                                $pemohon = json_decode($b->nama_pemohon);
                                try {
                                $n=0;
                                for ($i = 0; $i < count($pemohon); $i++) { $n=$n+1; 
                            if ($pemohon[$i]){
                                echo '
                                                                                            <div style="color: orange;">
                                                                                                <div class="col-sm">
                                                                                                    ** Data Pemohon '
                                    .$n.' </div>
                                    <div class="col-sm">
                                        **
                                    </div>
                            </div>
                                <div class="row">
                                    <div class="col-sm">
                                        Nama Pemohon
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="'.$b->id.'nama_pemohon" name="nama_pemohon[]"
                                            class="form-control '.$b->id.'nama_pemohon" value="'.$pemohon[$i].'">
                                    </div>
                                </div>
                                ';
                                $result = json_decode($b->nik_pemohon);
                                if (json_last_error() === JSON_ERROR_NONE) {
                                $nik = json_decode($b->nik_pemohon);
                                echo '
                                <div class="row">
                                    <div class="col-sm">
                                        NIK Pemohon
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="'.$b->id.'nik_pemohon" name="nik_pemohon[]"
                                            class="form-control '.$b->id.'nik_pemohon" value="'.$nik[$i].'">
                                    </div>
                                </div>';
                                }
                                else {
                                echo '
                                <script>//alert("alternatif catch e")</script>
                                <div class="row">
                                    <div class="col-sm">
                                        NIK Pemohon
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="'.$b->id.'nik_pemohon" name="nik_pemohon[]"
                                            class="form-control '.$b->id.'nik_pemohon" value="">
                                    </div>
                                </div>';
                                }
                                $result = json_decode($b->tempat_lahir_pemohon);
                                if (json_last_error() === JSON_ERROR_NONE) {
                                $tempat_lahir = json_decode($b->tempat_lahir_pemohon);
                                echo '

                                <div class="row">
                                    <div class="col-sm">
                                        Tempat Lahir Pemohon
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="'.$b->id.'tempat_lahir_pemohon" name="tempat_lahir_pemohon[]"
                                            class="form-control '.$b->id.'tempat_lahir_pemohon" value="'.$tempat_lahir[$i].'">
                                    </div>
                                </div>
                                ';
                                }
                                else {
                                echo '
                                <div class="row">
                                    <div class="col-sm">
                                        Tempat Lahir Pemohon
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="'.$b->id.'tempat_lahir_pemohon" name="tempat_lahir_pemohon[]"
                                            class="form-control '.$b->id.'tempat_lahir_pemohon" value="">
                                    </div>
                                </div>
                                ';
                                }
                                $result = json_decode($b->tanggal_lahir_pemohon);
                                if (json_last_error() === JSON_ERROR_NONE) {
                                $tanggal_lahir = json_decode($b->tanggal_lahir_pemohon);
                                echo '
                                <div class="row">
                                    <div class="col-sm">
                                        Tgl Lahir Pemohon
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="'.$b->id.'tanggal_lahir_pemohon"
                                            name="tanggal_lahir_pemohon[]"
                                            class="form-control '.$b->id.'tanggal_lahir_pemohon"
                                            value="'.$tanggal_lahir[$i].'">
                                    </div>
                                </div>';
                                }
                                else {
                                echo '
                                <div class="row">
                                    <div class="col-sm">
                                        Tanggal Lahir Pemohon
                                    </div>
                                    <div class="col-sm">
                                        <input type="date" id="'.$b->id.'tanggal_lahir_pemohon"
                                            name="tanggal_lahir_pemohon[]"
                                            class="form-control '.$b->id.'tanggal_lahir_pemohon" value="">
                                    </div>
                                </div>
                                ';
                                }
                                $result = json_decode($b->alamat_pemohon);
                                if (json_last_error() === JSON_ERROR_NONE) {
                                $alamat = json_decode($b->alamat_pemohon);
                                echo '
                                <div class="row">
                                    <div class="col-sm">
                                        Alamat Pemohon
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="'.$b->id .'alamat_pemohon" name="alamat_pemohon[]"
                                            class="form-control '.$b->id .'alamat_pemohon" value="'.$alamat[$i].'">
                                    </div>
                                </div>
                                ';
                                }
                                else {
                                echo '
                                <div class="row">
                                    <div class="col-sm">
                                        Alamat Pemohon
                                    </div>
                                    <div class="col-sm">
                                        <input type="text" id="'.$b->id.'alamat_pemohon" name="alamat_pemohon[]"
                                            class="form-control '.$b->id.'alamat_pemohon" value="">
                                    </div>
                                </div>
                                ';
                                }
                                

                                echo '
                                <div class="row">
                                    <div class="col-sm">
                                        **
                                    </div>
                                    <div class="col-sm">
                                        **
                                    </div>
                                </div>
                                ';
                            }
                           
                            


                            }

                            } catch (Exception $e) {
                            echo '
                            <div class="row">
                                <div class="col-sm">
                                    Nama Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="text" id="'.$b->id.'nama_pemohon" name="nama_pemohon[]"
                                        class="form-control '.$b->id.'nama_pemohon" value="'.$b->nama_pemohon.'"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    NIK Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="text" id="'.$b->id.'nik_pemohon" name="nik_pemohon[]"
                                        class="form-control '.$b->id.'nik_pemohon" value="'.$b->nik_pemohon.'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    Tempat Lahir Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="text" id="'.$b->id.'tempat_lahir_pemohon" name="tempat_lahir_pemohon[]"
                                        class="form-control '.$b->id.'tempat_lahir_pemohon" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    Tgl Lahir Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="date" id="'.$b->id.'tanggal_lahir_pemohon"
                                        name="tanggal_lahir_pemohon[]"
                                        class="form-control '.$b->id.'tanggal_lahir_pemohon"
                                        value="'.$b->tanggal_lahir_pemohon.'">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    Alamat Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="text" id="'.$b->id.'alamat_pemohon" name="alamat_pemohon[]"
                                        class="form-control '.$b->id.'alamat_pemohon" value="'.$b->alamat_pemohon.'">
                                </div>
                            </div>
                            ';
                            }
                            }
                            else {
                            echo '
                            <div class="row">
                                <div class="col-sm">
                                    Nama Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="text" id="'.$b->id.'nama_pemohon" name="nama_pemohon[]"
                                        class="form-control '.$b->id.'nama_pemohon" value="'.$b->nama_pemohon.'"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    NIK Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="text" id="'.$b->id.'nik_pemohon" name="nik_pemohon[]"
                                        class="form-control '.$b->id.'nik_pemohon" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    Tempat Lahir Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="text" id="'.$b->id.'tempat_lahir_pemohon" name="tempat_lahir_pemohon[]"
                                        class="form-control '.$b->id.'tempat_lahir_pemohon" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    Tgl Lahir Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="date" id="'.$b->id.'tanggal_lahir_pemohon"
                                        name="tanggal_lahir_pemohon[]"
                                        class="form-control '.$b->id.'tanggal_lahir_pemohon" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    Alamat Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="text" id="'.$b->id.'alamat_pemohon" name="alamat_pemohon[]"
                                        class="form-control '.$b->id.'alamat_pemohon" value="">
                                </div>
                            </div>

                            ';
                            }
                            @endphp
                            <!-- {{ $b->nama_pemohon }} -->
                            <div class="control-group after-add-more{{ $b->id }}"></div>
                            <button class="btn btn-success btn-sm add-more{{ $b->id }}" type="button">
                                <i class="glyphicon glyphicon-plus"></i> Tambah nama pemohon
                            </button>
                            <script type="text/javascript">
                            var idu = 1;
                                $(document).ready(function () {
                                    $(".add-more{{ $b->id }}").click(function () {
                                        var html = $(".copy").html();
                                        $(".after-add-more{{ $b->id }}").append(`
                                        <div id="e${idu}">
                                            <hr/>
                                            <div class="row">
                                <div class="col-sm">
                                    Nama Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="text" id="'.$b->id.'nama_pemohon" name="nama_pemohon[]"
                                        class="form-control '.$b->id.'nama_pemohon" value=""
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    NIK Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="text" id="'.$b->id.'nik_pemohon" name="nik_pemohon[]"
                                        class="form-control '.$b->id.'nik_pemohon" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    Tgl Lahir Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="date" id="'.$b->id.'tanggal_lahir_pemohon"
                                        name="tanggal_lahir_pemohon[]"
                                        class="form-control '.$b->id.'tanggal_lahir_pemohon" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    Alamat Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="text" id="'.$b->id.'alamat_pemohon" name="alamat_pemohon[]"
                                        class="form-control '.$b->id.'alamat_pemohon" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">
                                    Tempat Lahir Pemohon
                                </div>
                                <div class="col-sm">
                                    <input type="text" id="'.$b->id.'tempat_lahir_pemohon" name="tempat_lahir_pemohon[]"
                                        class="form-control '.$b->id.'tempat_lahir_pemohon" value="">
                                </div>
                            </div>
                                <div class="row">
                                <div class="col-sm">
                                    &emsp;
                                </div>
                                <div class="col-sm">
                                    <button class="btn btn-danger remove" type="button" onclick="hapus_u(${idu})"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                </div>
                            </div>
                            
                                        </div>
                                        `);
                                        idu++;
                                    });
                                    
                                });
                                
                            </script>
                            </div>
                            <div
                                class="modal-footer">
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button
                                    type="submit"
                                    class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                data-bs-target="#hapus{{ $b->id }}">
                Hapus
            </button>
            <div class="modal fade" id="hapus{{ $b->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus Berkas</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Anda yakin ingin menghapus berkas {{ $b->no_berkas }}: {{ $b->nama_pemohon }} ?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('berkas.destroy',$b->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><b>Delete</b></button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <a class="btn btn-primary btn-sm" href="{{ route('berkas.edit',$b->id) }}">Edit</a> -->

        </td>
        <td>
            <button class="btn btn-light btn-sm" style="border-color: gray;" onclick="cek_st({{ $b->id }})">ST</button>
            <button class="btn btn-light btn-sm" style="border-color: gray;" onclick="cek_undangan({{ $b->id }})">Undangan</button>
            <button class="btn btn-light btn-sm" style="border-color: gray;" onclick="cek_ris({{ $b->id }})">Risalah</button>
            <button class="btn btn-light btn-sm" style="border-color: gray;" onclick="cek_peng({{ $b->id }})">Pengumuman</button>
            <button class="btn btn-light btn-sm" style="border-color: gray;" onclick="cek_sk({{ $b->id }})">SK</button>
        </td>
    </tr>
    @endforeach
</table>
{{ $berkas->withQueryString()->links('pagination::bootstrap-4') }}
<div class="copy hide" id="tempat-nama" style="visibility: hidden;">
    <div class="control-group">
        <label>Nama</label>
        <br>
        <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
        <hr>
    </div>
</div>
@if($berkas->total()>0)
<script>
    function cek_undangan(id) {
        let p = false;
        let warning = "Data berikut belum terisi:<br/>";
        if (!document.getElementById(`${id}nagari`).value) {
            warning = `${warning} - Nagari (letak tanah)<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}kecamatan`).value) {
            warning = `${warning} - Kecamatan (letak tanah)<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}no_surat_undangan`).value) {
            warning = `${warning} - Nomor surat undangan <br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}tanggal_surat_undangan`).value) {
            warning = `${warning} - Tanggal surat undangan <br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}jam_surat_undangan`).value) {
            warning = `${warning} - Jam surat undangan <br/>`;
            p = true;
        }

        if (p == true) {
            Swal.fire({
                title: '<strong><u>warning</u></strong>',
                icon: 'info',
                html: warning,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Oke!',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:
                    `<a href="{{ route('print') }}/undangan/${id}" style= "color: lightgray"><i class="fa fa-thumbs-down"></i> tetap download</a>`,
                cancelButtonAriaLabel: 'Thumbs down'
            })
        }
        else {
            location.href = "{{ route('print') }}/undangan/"+id; 
        }
    }

    function cek_st(id) {
        let p = false;
        let warning = "Data berikut belum terisi:<br/>";

        if (!document.getElementById(`${id}nagari`).value) {
            warning = `${warning} - Nagari (letak tanah)<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}kecamatan`).value) {
            warning = `${warning} - Kecamatan (letak tanah)<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}no_st`).value) {
            warning = `${warning} - Nomor surat tugas <br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}tanggal_st`).value) {
            warning = `${warning} - Tanggal surat tugas <br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}luas`).value) {
            warning = `${warning} - Luas tanah <br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}nama_wali_nagari`).value) {
            warning = `${warning} - Nama Wali Nagari <br/>`;
            p = true;
        }

        if (p == true) {
            Swal.fire({
                title: '<strong><u>warning</u></strong>',
                icon: 'info',
                html: warning,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Oke!',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:
                    `<a href="{{ route('print') }}/ST/${id}" style= "color: lightgray"><i class="fa fa-thumbs-down"></i> tetap download</a>`,
                cancelButtonAriaLabel: 'Thumbs down'
            })
        }
        else {
            location.href = "{{ route('print') }}/ST/"+id; 
        }
    }

    function cek_ris(id) {
        let p = false;
        let warning = "Data berikut belum terisi:<br/>";

        if (!document.getElementById(`${id}no_pbt`).value) {
            warning = `${warning} - Nomor PBT<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}tanggal_pbt`).value) {
            warning = `${warning} - Tanggal PBT<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}no_ris`).value) {
            warning = `${warning} - Nomor Risalah<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}tanggal_ris`).value) {
            warning = `${warning} - Tanggal Risalah<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}nib`).value) {
            warning = `${warning} - NIB<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}luas`).value) {
            warning = `${warning} - Luas Tanah<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}jorong`).value) {
            warning = `${warning} - Jorong (letak tanah)<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}nagari`).value) {
            warning = `${warning} - Nagari (letak tanah)<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}kecamatan`).value) {
            warning = `${warning} - Kecamatan (letak tanah)<br/>`;
            p = true;
        }
        if ($(`.${id}nik_pemohon`).val() == "") {
            warning = `${warning} - NIK Pemohon<br/>`;
            p = true;

        }
        if ($(`.${id}tempat_lahir_pemohon`).val() == "") {
            warning = `${warning} - Tempat lahir pemohon<br/>`;
            p = true;
        }
        if ($(`.${id}tanggal_lahir_pemohon`).val() == "") {
            warning = `${warning} - Tanggal lahir pemohon<br/>`;
            p = true;
        }
        if ($(`.${id}alamat_pemohon`).val() == "") {
            warning = `${warning} - Alamat pemohon<br/>`;
            p = true;
        }
        // if (!document.getElementById(`${id}nik_pemohon`).value) {
        //     warning = `${warning} - NIK Pemohon<br/>`;
        //     p=true;
        // }
        // if (!document.getElementById(`${id}tempat_lahir_pemohon`).value) {
        //     warning = `${warning} - Tempat lahir pemohon<br/>`;
        //     p=true;
        // }
        // if (!document.getElementById(`${id}tanggal_lahir_pemohon`).value) {
        //     warning = `${warning} - Tanggal lahir pemohon<br/>`;
        //     p=true;
        // }
        // if (!document.getElementById(`${id}alamat_pemohon`).value) {
        //     warning = `${warning} - Alamat pemohon<br/>`;
        //     p=true;
        // }
        if (!document.getElementById(`${id}penggunaan_saat_ini`).value) {
            warning = `${warning} - Penggunaan lahan saat ini<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}rencana_penggunaan`).value) {
            warning = `${warning} - Rencana Penggunaan<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}tanggal_surat_permohonan`).value) {
            warning = `${warning} - Tanggal Surat Permohonan<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}tanggal_penugasan_fisik`).value) {
            warning = `${warning} - Tanggal Penguasan Fisik<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}no_suket_wali`).value) {
            warning = `${warning} - No. Surat Keterangan Wali Nagari<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}tanggal_suket_wali`).value) {
            warning = `${warning} - Tanggal Surat Keterangan Wali Nagari<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}nama_wali_nagari`).value) {
            warning = `${warning} - Nama Wali Nagari<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}no_sk_kantah_panitia`).value) {
            warning = `${warning} - Nomor SK Kepala Kantah untuk Risalah Panitia<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}tgl_sk_kantah_panitia`).value) {
            warning = `${warning} - Tanggal SK Kepala Kantah untuk Risalah Panitia<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}alas_hak`).value) {
            warning = `${warning} - Alas Hak<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}tanggal_alas_hak`).value) {
            warning = `${warning} - Tanggal Alas Hak<br/>`;
            p = true;
        }

        if (p == true) {
            Swal.fire({
                title: '<strong><u>warning</u></strong>',
                icon: 'info',
                html: warning,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Oke!',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:
                    `<a href="{{ route('print') }}/risalah/${id}" style= "color: lightgray"><i class="fa fa-thumbs-down"></i> tetap download</a>`,
                cancelButtonAriaLabel: 'Thumbs down'
            })
        }
        else {
            location.href = "{{ route('print') }}/risalah/"+id; 
        }
    }

    function cek_peng(id) {
        let p = false;
        let warning = "Data berikut belum terisi:<br/>";
        if (!document.getElementById(`${id}nib`).value) {
            warning = `${warning} - NIB<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}luas`).value) {
            warning = `${warning} - Luas Tanah<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}jorong`).value) {
            warning = `${warning} - Jorong (letak tanah)<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}nagari`).value) {
            warning = `${warning} - Nagari (letak tanah)<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}kecamatan`).value) {
            warning = `${warning} - Kecamatan (letak tanah)<br/>`;
            p = true;
        }

        if (p == true) {
            Swal.fire({
                title: '<strong><u>warning</u></strong>',
                icon: 'info',
                html: warning,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Oke!',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:
                    `<a href="{{ route('print') }}/peng/${id}" style= "color: lightgray"><i class="fa fa-thumbs-down"></i> tetap download</a>`,
                cancelButtonAriaLabel: 'Thumbs down'
            })
        }
        else {
            location.href = "{{ route('print') }}/peng/"+id; 
        }
    }

    function cek_sk(id) {
        let p = false;
        let warning = "Data berikut belum terisi:<br/>";

        if (!document.getElementById(`${id}no_peng`).value) {
            warning = `${warning} - Nomor Pengumuman<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}tanggal_peng`).value) {
            warning = `${warning} - Tanggal Pengumuman<br/>`;
            p = true;
        }
        if (!document.getElementById(`${id}nagari`).value) {
            warning = `${warning} - Nagari<br/>`;
            p = true;
        }

        if (p == true) {
            Swal.fire({
                title: '<strong><u>warning</u></strong>',
                icon: 'info',
                html: warning,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Oke!',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText:
                    `<a href="{{ route('print') }}/sk/${id}" style= "color: lightgray"><i class="fa fa-thumbs-down"></i> tetap download</a>`,
                cancelButtonAriaLabel: 'Thumbs down'
            })
        }
        else {
            location.href = "{{ route('print') }}/sk/"+id; 
        }
    }


</script>
@endif
<script>
    function hapus_u(id){
                                        $(`#e${id}`).remove();
                                    }

    $(".hide").hide();
    
</script>

@endsection