<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berkas_pemohon;

class Berkas_pemohonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berkas = Berkas_pemohon::latest()->paginate(5);

        return view('berkas.index',compact('berkas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        // return view('berkas.index', [
        //     'berkas' => Berkas_pemohon::latest()->paginate(5)
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berkas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
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

        Berkas_pemohon::create($request->all());

        return redirect()->route('berkas.index')
                        ->with('success','Berkas berkasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Berkas_pemohon $berkas)
    {
        return view('berkas.show',compact('berkas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Berkas_pemohon $berkas)
    {
        return view('berkas.edit',compact('berkas'));
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
        $request->validate([
            'nama_pemohon' => 'required'
        ]);

        $berkas = Berkas_pemohon::find($id);
        //return $request;
        //return $berkas->no_sk;

        $berkas->update($request->all());

        return redirect()->back()->with('success', 'Berkas '.$berkas->no_berkas.' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berkas = Berkas_pemohon::find($id);
        $berkas->delete();

        //return redirect()->route('berkas.index')->with('success','Berkas telah dihapus');
        return redirect()->back()->with('success','Berkas telah dihapus');
    }

    public function cari_nama(Request $request){
        $nama_pemohon = strtolower($request->nama_pemohon);

        $sql = Berkas_pemohon::whereRaw('lower(nama_pemohon) like (?)',["%{$nama_pemohon}%"])->paginate(5);
            return view ('berkas.index',[
                'nama_pemohon' => $nama_pemohon,
                'berkas' => $sql
            ])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function cari_noberkas(Request $request){
        $no_berkas = $request->no_berkas;

        $sql = Berkas_pemohon::whereRaw('no_berkas like (?)',["%{$no_berkas}%"])->paginate(5);
            return view ('berkas.index',[
                'no_berkas' => $no_berkas,
                'berkas' => $sql
            ])->with('i', (request()->input('page', 1) - 1) * 5);
    }

}
