<?php

namespace App\Http\Controllers;

use App\Models\Pelayanan;
use App\Http\Requests\StorePelayananRequest;
use App\Http\Requests\UpdatePelayananRequest;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pelayanan::with('poliklinik')->where('status', '=', null)->orderBy('id', 'asc')->get();
        return response()->json($data, 200);
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
     * @param  \App\Http\Requests\StorePelayananRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePelayananRequest $request)
    {
        $tanggal = $request->input('tanggal');
        $poli = $request->input('poliklinik_id');

        $lastAntrian = Pelayanan::where('tanggal', $tanggal)
            ->where('poliklinik_id', $poli)
            ->orderBy('antrian', 'desc')
            ->first();
        $noAntri = $lastAntrian ? $lastAntrian->antrian + 1 : 1;

        $data = Pelayanan::create([
            'antrian' => $noAntri,
            'penjamin' => $request->penjamin,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'tanggal' => $tanggal,
            'nik' => $request->nik,
            'poliklinik_id' => $poli,
        ]);

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelayanan  $pelayanan
     * @return \Illuminate\Http\Response
     */
    public function show($pelayanan)
    {
        $data = Pelayanan::with('poliklinik')->find($pelayanan);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelayanan  $pelayanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelayanan $pelayanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePelayananRequest  $request
     * @param  \App\Models\Pelayanan  $pelayanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pelayanan)
    {
        $nilai = '1';

        $data = Pelayanan::find($pelayanan);
        $data->status = $nilai;
        $data->save();

        return response()->json(['message' => 'berhasil']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelayanan  $pelayanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelayanan $pelayanan)
    {
        //
    }

    public function getAntri(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $poli = $request->input('poliklinik_id');

        $lastAntrian = Pelayanan::where('tanggal', $tanggal)
            ->where('poliklinik_id', $poli)
            ->orderBy('antrian', 'desc')
            ->first();
        if ($lastAntrian) {
            $enxtAntrian = $lastAntrian->antrian + 1;
        } else {
            $enxtAntrian = 1;
        }

        return response()->json(['antrian' => $enxtAntrian]);
    }
}
