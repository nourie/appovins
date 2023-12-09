<?php

namespace App\Http\Controllers;

use App\Models\Clinique;
use App\Http\Requests\StoreCliniqueRequest;
use App\Http\Requests\UpdateCliniqueRequest;

class CliniqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clinique.index', compact('malades'));

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
     * @param  \App\Http\Requests\StoreCliniqueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCliniqueRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clinique  $clinique
     * @return \Illuminate\Http\Response
     */
    public function show(Clinique $clinique)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clinique  $clinique
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinique $clinique)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCliniqueRequest  $request
     * @param  \App\Models\Clinique  $clinique
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCliniqueRequest $request, Clinique $clinique)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clinique  $clinique
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinique $clinique)
    {
        //
    }
}
