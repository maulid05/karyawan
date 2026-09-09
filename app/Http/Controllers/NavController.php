<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use App\Http\Requests\StoreNavRequest;
use App\Http\Requests\UpdateNavRequest;

class NavController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNavRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Nav $nav)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nav $nav)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNavRequest $request, Nav $nav)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nav $nav)
    {
        //
    }
}
