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
                                            <input type="text" name="no_berkas" class="form-control" placeholder="0000">
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
                                            <label>Nama Pemohon:</label>
                                            <input type="text" name="nama_pemohon" class="form-control"
                                                placeholder="Nama Pemohon">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Luas:</label>
                                            <input type="text" name="luas" class="form-control" placeholder="1234 (angka saja)">
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
                                            <input type="text" id="no_surat_undangan" name="no_surat_undangan" class="form-control" placeholder="35/03.04/I/2021" onchange="no_su()">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Tanggal Surat Undangan:</label>
                                            <input type="date" id="tanggal_surat_undangan" name="tanggal_surat_undangan" class="form-control" onchange="tgl_su()">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Jam sidang di Surat Undangan:</label>
                                            <input type="text" id="jam_surat_undangan" name="jam_surat_undangan" class="form-control" placeholder="10:00">
                                        </div>
                                        <br />
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>No. surat tugas:</label>
                                            <input type="text" id="no_st" name="no_st" class="form-control" placeholder="35/002-03.04/I/2021">
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
                                            <input type="text" id="nama_wali_nagari" name="nama_wali_nagari" class="form-control">
                                        </div>
                                        <br />
                                    </div>
                                </div>
                                <script>
                                    function no_su(){
                                        let no = document.getElementById("no_surat_undangan").value;
                                        document.getElementById("no_st").value = no.replace("03.04", "002-03.04");
                                    }

                                    function tgl_su(){
                                        let tgl = document.getElementById("tanggal_surat_undangan").value;
                                        document.getElementById("tanggal_st").value = tgl;
                                    }
                                </script>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
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
        <td>{{ $b->nama_pemohon }}</td>
        <td>{{ $b->nagari }},{{ $b->kecamatan }}</td>
        <td>
                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                    data-bs-target="#info{{ $b->id }}" style="color: white; font-weight: bold;">
                    Info
                </button>
                <div class="modal fade" id="info{{ $b->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Info Berkas</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                No. Berkas: <b>{{ $b->no_berkas }}</b><br>
                                Tahun Masuk Berkas: <b>{{ $b->tahun }}</b><br>
                                Nama Pemohon: <b>{{ $b->nama_pemohon }}</b><br>
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
                                Tanggal Pengumuman: <b>{{ $b->tgl_peng }}</b><br>
                                No. Pengumuman: <b>{{ $b->no_peng }}</b><br>
                                Sampai dengan Tanggal: <b>{{ $b->sampai_tanggal }}</b><br>
                                Tanggal SK: <b>{{ $b->tanggal_sk }}</b><br>
                                No SK: <b>{{ $b->no_sk }}</b><br>
                                Keterangan: <b>{{ $b->keterangan }}</b><br>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#st{{ $b->id }}">
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
                                    <table style="width: 100%;">
                                        <tr>
                                            <td>
                                                No Berkas
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}no_berkas" name="no_berkas" class="form-control" value="{{ $b->no_berkas }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tahun Masuk Berkas:
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}tahun" name="tahun" class="form-control" value="{{ $b->tahun }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Nama Pemohon
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}nama_pemohon" name="nama_pemohon" class="form-control" value="{{ $b->nama_pemohon }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                NIB
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}nib" name="nib" class="form-control" value="{{ $b->nib }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tanggal PBT
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_pbt" name="tanggal_pbt" class="form-control" value="{{ $b->tanggal_pbt }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                No. PBT
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}no_pbt" name="no_pbt" class="form-control" value="{{ $b->no_pbt }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Luas
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}luas" name="luas" class="form-control" value="{{ $b->luas }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Jorong
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}jorong" name="jorong" class="form-control" value="{{ $b->jorong }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Nagari
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}nagari" name="nagari" class="form-control" value="{{ $b->nagari }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Kecamatan
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}kecamatan" name="kecamatan" class="form-control" value="{{ $b->kecamatan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                No. Surat Undangan
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}no_surat_undangan" name="no_surat_undangan" class="form-control" value="{{ $b->no_surat_undangan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tanggal Surat Undangan
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_surat_undangan" name="tanggal_surat_undangan" class="form-control" value="{{ $b->tanggal_surat_undangan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Jam Surat Undangan
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}jam_surat_undangan" name="jam_surat_undangan" class="form-control" value="{{ $b->jam_surat_undangan }}" placeholder="10:00">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tanggal Surat Tugas
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_st" name="tanggal_st" class="form-control" value="{{ $b->tanggal_st }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                No. Surat Tugas
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}no_st" name="no_st" class="form-control" value="{{ $b->no_st }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tanggal Ke Lapangan
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_lap" name="tanggal_lap" class="form-control" value="{{ $b->tanggal_lap }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tgl Risalah Panitia A
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_ris" name="tanggal_ris" class="form-control" value="{{ $b->tanggal_ris }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                No. Risalah Panitia A
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}no_ris" name="no_ris" class="form-control" value="{{ $b->no_ris }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                No. SK Kepala Kantor untuk Risalah Panitia
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}no_sk_kantah_panitia" name="no_sk_kantah_panitia" class="form-control" value="{{ $b->no_sk_kantah_panitia }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tgl SK Kepala Kantor untuk Risalah Panitia
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tgl_sk_kantah_panitia" name="tgl_sk_kantah_panitia" class="form-control" value="{{ $b->tgl_sk_kantah_panitia }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                No. Surat Keterangan Wali Nagari
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}no_suket_wali" name="no_suket_wali" class="form-control" value="{{ $b->no_suket_wali }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tgl Surat Ket. Wali Nagari
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_suket_wali" name="tanggal_suket_wali" class="form-control" value="{{ $b->tanggal_suket_wali }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Nama Wali Nagari
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}nama_wali_nagari" name="nama_wali_nagari" class="form-control" value="{{ $b->nama_wali_nagari }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Penggunaan Lahan Saat Ini
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}penggunaan_saat_ini" name="penggunaan_saat_ini" class="form-control" value="{{ $b->penggunaan_saat_ini }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Rencana Penggunaan
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}rencana_penggunaan" name="rencana_penggunaan" class="form-control" value="{{ $b->rencana_penggunaan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                NIK Pemohon
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}nik_pemohon" name="nik_pemohon" class="form-control" value="{{ $b->nik_pemohon }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tempat Lahir Pemohon
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}tempat_lahir_pemohon" name="tempat_lahir_pemohon" class="form-control" value="{{ $b->tempat_lahir_pemohon }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tgl Lahir Pemohon
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_lahir_pemohon" name="tanggal_lahir_pemohon" class="form-control" value="{{ $b->tanggal_lahir_pemohon }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Alamat Pemohon
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}alamat_pemohon" name="alamat_pemohon" class="form-control" value="{{ $b->alamat_pemohon }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tgl Surat Penugasan Fisik Bidang Tanah
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_penugasan_fisik" name="tanggal_penugasan_fisik" class="form-control" value="{{ $b->tanggal_penugasan_fisik }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tanggal Surat Permohonan
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_surat_permohonan" name="tanggal_surat_permohonan" class="form-control" value="{{ $b->tanggal_surat_permohonan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tgl Pengumuman
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_peng" name="tanggal_peng" class="form-control" value="{{ $b->tanggal_peng }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                No. Pengumuman
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}no_peng" name="no_peng" class="form-control" value="{{ $b->no_peng }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Sampai dengan Tanggal
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}sampai_tanggal" name="sampai_tanggal" class="form-control" value="{{ $b->sampai_tanggal }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tanggal SK
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_sk" name="tanggal_sk" class="form-control" value="{{ $b->tanggal_sk }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                No. SK
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}no_sk" name="no_sk" class="form-control" value="{{ $b->no_sk }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Tanggal Berkas Didaftarkan
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_berkas_didaftarkan" name="tanggal_berkas_didaftarkan" class="form-control" value="{{ $b->tanggal_berkas_didaftarkan }}">
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <td>
                                                Tanggal SK Kerapatan Adat Nagari
                                            </td>
                                            <td>
                                                <input type="date" id="{{ $b->id }}tanggal_sk_kan" name="tanggal_sk_kan" class="form-control" value="{{ $b->tanggal_sk_kan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                No. SK Kerapatan Adat Nagari
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $b->id }}no_sk_kan" name="no_sk_kan" class="form-control" value="{{ $b->no_sk_kan }}">
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <td>
                                                Keterangan
                                            </td>
                                            <td>
                                                <textarea id="{{ $b->id }}ket" name="ket" class="form-control">{{ $b->ket }}</textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
            <a href="{{ route('print') }}/ST/{{ $b->id }}" onclick="cek_st({{ $b->id }})"><button class="btn btn-light btn-sm" style="border-color: gray;">ST</button></a>
            <a href="{{ route('print') }}/undangan/{{ $b->id }}" onclick="cek_undangan({{ $b->id }})"><button class="btn btn-light btn-sm" style="border-color: gray;">Undangan</button></a>
            <a href="{{ route('print') }}/risalah/{{ $b->id }}" onclick="cek_ris({{ $b->id }})"><button class="btn btn-light btn-sm" style="border-color: gray;">Risalah</button></a>
            <a href="{{ route('print') }}/peng/{{ $b->id }}" onclick="cek_peng({{ $b->id }})"><button class="btn btn-light btn-sm" style="border-color: gray;">Pengumuman</button></a>
            <a href="{{ route('print') }}/sk/{{ $b->id }}" onclick="cek_sk({{ $b->id }})"><button class="btn btn-light btn-sm" style="border-color: gray;">SK</button></a>
        </td>
    </tr>
    @endforeach
</table>
{{  $berkas->links('pagination::bootstrap-4')  }}
<script>

    function cek_undangan(id){
        let p = false;
        let warning = "Data berikut belum terisi:<br/>";
        if (!document.getElementById(`${id}nagari`).value) {
            warning = `${warning} - Nagari (letak tanah)<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}kecamatan`).value) {
            warning = `${warning} - Kecamatan (letak tanah)<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}no_surat_undangan`).value) {
            warning = `${warning} - Nomor surat undangan <br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_surat_undangan`).value) {
            warning = `${warning} - Tanggal surat undangan <br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}jam_surat_undangan`).value) {
            warning = `${warning} - Jam surat undangan <br/>`;
            p=true;
        }
        
        if(p==true){
            Swal.fire({
            title: '<strong><u>warning</u></strong>',
            icon: 'info',
            html: warning,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:
                '<i class="fa fa-thumbs-up"></i> Oke!',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText:
                '<i class="fa fa-thumbs-down"></i> Oke!',
            cancelButtonAriaLabel: 'Thumbs down'
            })
        }
    }

    function cek_st(id){
        let p = false;
        let warning = "Data berikut belum terisi:<br/>";

        if (!document.getElementById(`${id}nagari`).value) {
            warning = `${warning} - Nagari (letak tanah)<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}kecamatan`).value) {
            warning = `${warning} - Kecamatan (letak tanah)<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}no_st`).value) {
            warning = `${warning} - Nomor surat tugas <br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_st`).value) {
            warning = `${warning} - Tanggal surat tugas <br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}luas`).value) {
            warning = `${warning} - Luas tanah <br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}nama_wali_nagari`).value) {
            warning = `${warning} - Nama Wali Nagari <br/>`;
            p=true;
        }
        
        if(p==true){
            Swal.fire({
            title: '<strong><u>warning</u></strong>',
            icon: 'info',
            html: warning,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:
                '<i class="fa fa-thumbs-up"></i> Oke!',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText:
                '<i class="fa fa-thumbs-down"></i> Oke!',
            cancelButtonAriaLabel: 'Thumbs down'
            })
        }
    }

    function cek_ris(id){
        let p = false;
        let warning = "Data berikut belum terisi:<br/>";

        if (!document.getElementById(`${id}no_pbt`).value) {
            warning = `${warning} - Nomor PBT<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_pbt`).value) {
            warning = `${warning} - Tanggal PBT<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}no_ris`).value) {
            warning = `${warning} - Nomor Risalah<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_ris`).value) {
            warning = `${warning} - Tanggal Risalah<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}nib`).value) {
            warning = `${warning} - NIB<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}luas`).value) {
            warning = `${warning} - Luas Tanah<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}jorong`).value) {
            warning = `${warning} - Jorong (letak tanah)<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}nagari`).value) {
            warning = `${warning} - Nagari (letak tanah)<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}kecamatan`).value) {
            warning = `${warning} - Kecamatan (letak tanah)<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tempat_lahir_pemohon`).value) {
            warning = `${warning} - Tempat lahir pemohon<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_lahir_pemohon`).value) {
            warning = `${warning} - Tanggal lahir pemohon<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}alamat_pemohon`).value) {
            warning = `${warning} - Alamat pemohon<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}penggunaan_saat_ini`).value) {
            warning = `${warning} - Penggunaan lahan saat ini<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}rencana_penggunaan`).value) {
            warning = `${warning} - Rencana Penggunaan<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_surat_permohonan`).value) {
            warning = `${warning} - Tanggal Surat Permohonan<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_penugasan_fisik`).value) {
            warning = `${warning} - Tanggal Penugasan Fisik<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}no_suket_wali`).value) {
            warning = `${warning} - No. Surat Keterangan Wali Nagari<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_suket_wali`).value) {
            warning = `${warning} - Tanggal Surat Keterangan Wali Nagari<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}nik_pemohon`).value) {
            warning = `${warning} - NIK Pemohon<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}nama_wali_nagari`).value) {
            warning = `${warning} - Nama Wali Nagari<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}no_sk_kantah_panitia`).value) {
            warning = `${warning} - Nomor SK Kepala Kantah untuk Risalah Panitia<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tgl_sk_kantah_panitia`).value) {
            warning = `${warning} - Tanggal SK Kepala Kantah untuk Risalah Panitia<br/>`;
            p=true;
        }
        
        if(p==true){
            Swal.fire({
            title: '<strong><u>warning</u></strong>',
            icon: 'info',
            html: warning,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:
                '<i class="fa fa-thumbs-up"></i> Oke!',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText:
                '<i class="fa fa-thumbs-down"></i> Oke!',
            cancelButtonAriaLabel: 'Thumbs down'
            })
        }
    }

    function cek_peng(id){
        let p = false;
        let warning = "Data berikut belum terisi:<br/>";
        if (!document.getElementById(`${id}nib`).value) {
            warning = `${warning} - NIB<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}luas`).value) {
            warning = `${warning} - Luas Tanah<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}jorong`).value) {
            warning = `${warning} - Jorong (letak tanah)<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}nagari`).value) {
            warning = `${warning} - Nagari (letak tanah)<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}kecamatan`).value) {
            warning = `${warning} - Kecamatan (letak tanah)<br/>`;
            p=true;
        }

        if(p==true){
            Swal.fire({
            title: '<strong><u>warning</u></strong>',
            icon: 'info',
            html: warning,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:
                '<i class="fa fa-thumbs-up"></i> Oke!',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText:
                '<i class="fa fa-thumbs-down"></i> Oke!',
            cancelButtonAriaLabel: 'Thumbs down'
            })
        }
    }

    function cek_sk(id){
        let p = false;
        let warning = "Data berikut belum terisi:<br/>";
        warning = `${warning} - Tanggal Surat Permohonan<br/>`;
        warning = `${warning} - Tanggal Berkas Didaftarkan<br/>`;

        if (!document.getElementById(`${id}no_sk`).value) {
            warning = `${warning} - Nomor SK<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_sk`).value) {
            warning = `${warning} - Tanggal SK<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_surat_permohonan`).value) {
            warning = `${warning} - Tanggal surat permohonan<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_berkas_didaftarkan`).value) {
            warning = `${warning} - Tanggal berkas di daftarkan<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}no_pbt`).value) {
            warning = `${warning} - Nomor PBT<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_pbt`).value) {
            warning = `${warning} - Tanggal PBT<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}no_ris`).value) {
            warning = `${warning} - Nomor Risalah<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_ris`).value) {
            warning = `${warning} - Tanggal Risalah<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}nib`).value) {
            warning = `${warning} - NIB<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}luas`).value) {
            warning = `${warning} - Luas Tanah<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}jorong`).value) {
            warning = `${warning} - Jorong (letak tanah)<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}nagari`).value) {
            warning = `${warning} - Nagari (letak tanah)<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}kecamatan`).value) {
            warning = `${warning} - Kecamatan (letak tanah)<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tempat_lahir_pemohon`).value) {
            warning = `${warning} - Tempat lahir pemohon<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}tanggal_lahir_pemohon`).value) {
            warning = `${warning} - Tanggal lahir pemohon<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}alamat_pemohon`).value) {
            warning = `${warning} - Alamat pemohon<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}penggunaan_saat_ini`).value) {
            warning = `${warning} - Penggunaan lahan saat ini<br/>`;
            p=true;
        }
        if (!document.getElementById(`${id}rencana_penggunaan`).value) {
            warning = `${warning} - Rencana Penggunaan<br/>`;
            p=true;
        }
        if(p==true){
            Swal.fire({
            title: '<strong><u>warning</u></strong>',
            icon: 'info',
            html: warning,
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText:
                '<i class="fa fa-thumbs-up"></i> Oke!',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText:
                '<i class="fa fa-thumbs-down"></i> Oke!',
            cancelButtonAriaLabel: 'Thumbs down'
            })
        }
    }

</script>

@endsection