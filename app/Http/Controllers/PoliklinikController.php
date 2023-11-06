<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDokterRequest;
use App\Models\Poliklinik;
use App\Http\Requests\StorePoliklinikRequest;
use App\Http\Requests\UpdatePoliklinikRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Poliklinik::paginate(5);
        return response()->json($data, 200);
    }

    public function getPoli()
    {
        $data = Poliklinik::get();
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
     * @param  \App\Http\Requests\StorePoliklinikRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $validate = Validator::make(request()->all(), [
            'poliklinik' => 'required|unique:polikliniks',
            'kode_poli' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->messages(), 422);
        }

        $data = Poliklinik::create([
            'poliklinik' => request('poliklinik'),
            'kode_poli' => request('kode_poli'),
        ]);

        if ($data) {
            return response()->json(['messages' => 'Tambah data berhasil']);
        } else {
            return response()->json(['messages' => 'Tambah data gagal']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function show(Poliklinik $poliklinik)
    {
        $data = $poliklinik;
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function edit(Poliklinik $poliklinik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePoliklinikRequest  $request
     * @param  \App\Models\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'poliklinik' => 'required',
            'kode_poli' => 'numeric',
        ]);

        $data = Poliklinik::find($id);
        $data->poliklinik = $validate['poliklinik'];
        $data->kode_poli = $validate['kode_poli'];
        $data->save();

        return response()->json(['message' => 'Data berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Poliklinik::find($id);
        if (!$data) {
            return response()->json(['message' => 'data not found'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Item deleted']);
    }
}
