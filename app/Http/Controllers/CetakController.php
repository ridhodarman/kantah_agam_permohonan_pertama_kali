<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    
    public function st()
    {
        $nama="nama";
        $tahun = "2021";
        return $nama;
        $template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('SK.docx'));
        $template -> setValue('nama', $nama);
        $template -> setValue('tahun', $tahun);

        $path = storage_path('s.docx');
        $template->saveAs($path);;
        return response()->download(storage_path('s.docx'));

    }
}
