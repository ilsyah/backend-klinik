<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Http\Requests\StoreDokterRequest;
use App\Http\Requests\UpdateDokterRequest;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Dokter::with('poliklinik', 'pelayanan')->paginate(5);
        return response()->json($data);
    }

    public function getDokterAll()
    {
        $data = Dokter::get();
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
     * @param  \App\Http\Requests\StoreDokterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDokterRequest $request)
    {
        $dokter = Dokter::with('poliklinik')->create($request->all());
        // if ($dokter->fails()) {
        //     return response()->json($dokter->messages(), 422);
        // }

        return response()->json($dokter);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function show($dokter)
    {
        $data = Dokter::with('poliklinik', 'pelayanan')->find($dokter);

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokter $dokter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDokterRequest  $request
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'poliklinik_id' => 'required|numeric',
            'alamat' => 'required'
        ]);

        $data = Dokter::find($id);
        $data->nama = $validate['nama'];
        $data->email = $validate['email'];
        $data->poliklinik_id = $validate['poliklinik_id'];
        $data->alamat = $validate['alamat'];
        $data->save();

        return response()->json(['message' => 'data berhasil di update']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokter  $dokter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Dokter::find($id);

        if (!$data) {
            return response()->json(['message' => 'data not found'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Item deleted']);
    }

    public function getDokter(Request $request)
    {
        $poli = $request->input('poliklinik_id');

        $dokter = Dokter::with('poliklinik')->where('poliklinik_id', $poli)
            ->get();

        return response()->json($dokter);
    }
}
