<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\RickMortyApi;
use Illuminate\Http\Request;

class RickMortyApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "CERTOOOO!";
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
     * @param  \App\RickMortyApi  $rickMortyApi
     * @return \Illuminate\Http\Response
     */
    public function show(RickMortyApi $rickMortyApi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RickMortyApi  $rickMortyApi
     * @return \Illuminate\Http\Response
     */
    public function edit(RickMortyApi $rickMortyApi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RickMortyApi  $rickMortyApi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RickMortyApi $rickMortyApi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RickMortyApi  $rickMortyApi
     * @return \Illuminate\Http\Response
     */
    public function destroy(RickMortyApi $rickMortyApi)
    {
        //
    }
}
