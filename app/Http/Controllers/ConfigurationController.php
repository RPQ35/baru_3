<?php

namespace App\Http\Controllers;

use App\Models\configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $config = configuration::all();

        return view('admin.config.index_config', compact('config'));
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
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {


        $configuration = configuration::where('option', $request->input('option'))->first();

        if ($configuration) {
            $configuration->swicth = filter_var($request->input('swicth'), FILTER_VALIDATE_BOOLEAN);
            $configuration->save();
            return response()->json(['success' => true, 'message' => 'Configuration updated successfully!']);
        }

        return response()->json(['error' => 'Configuration not found.'], 404);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(configuration $configuration)
    {
        //
    }
}
