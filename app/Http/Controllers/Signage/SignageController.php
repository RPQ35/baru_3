<?php

namespace App\Http\Controllers\Signage;

use App\Http\Controllers\Controller;
use App\Models\Queues;
use App\Models\Running_text;
use App\Models\Video;
use Illuminate\Http\Request;

class SignageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // == set the data for video & running test ==========================================================

        $video = Video::first();
        if ($video) {
            $video->file_path = explode('/', $video->file_path);
            $video = url('/') . '/' . "video/" . $video->file_path[1];
        }

        $text = Running_text::first();
        if ($text) {
            $text = $text->texts;
        }


        return view('signage.index_signage', compact(
            'video',
            'text',
        ));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
