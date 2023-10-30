<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDokterRequest;
use App\Models\Poliklinik;
use App\Http\Requests\StorePoliklinikRequest;
use App\Http\Requests\UpdatePoliklinikRequest;

class PoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Poliklinik::all();
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
    public function store(StorePoliklinikRequest $request)
    {
        $poli = Poliklinik::create($request->all());

        return response()->json($poli, 200);
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
    public function update(StorePoliklinikRequest $request, Poliklinik $poliklinik)
    {
        $poliklinik->update($request->all());

        return response()->json($poliklinik, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poliklinik  $poliklinik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poliklinik $poliklinik)
    {
        //
    }
}
