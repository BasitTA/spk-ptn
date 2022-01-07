<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSawTopsisRequest;
use App\Http\Requests\UpdateSawTopsisRequest;
use App\Models\SawTopsis;

class SawTopsisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreSawTopsisRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSawTopsisRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SawTopsis  $sawTopsis
     * @return \Illuminate\Http\Response
     */
    public function show(SawTopsis $sawTopsis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SawTopsis  $sawTopsis
     * @return \Illuminate\Http\Response
     */
    public function edit(SawTopsis $sawTopsis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSawTopsisRequest  $request
     * @param  \App\Models\SawTopsis  $sawTopsis
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSawTopsisRequest $request, SawTopsis $sawTopsis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SawTopsis  $sawTopsis
     * @return \Illuminate\Http\Response
     */
    public function destroy(SawTopsis $sawTopsis)
    {
        //
    }
}
