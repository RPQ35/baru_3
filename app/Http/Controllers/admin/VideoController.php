<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (session('video')) { //->dellete file session and temporary file in storage
            Storage::disk('public')->delete(session('video'));
            session(['video' => null]);
        };

        /**
         * having and showing only 1 data / file
         */
        $video = Video::first();
        if ($video) {
            //==== custom route that will be handle by show() ====
            $video->file_path = pathinfo($video->file_path, PATHINFO_BASENAME); //->get file name
            $video->file_path = url('/') . '/' . "video/" . $video->file_path; //->give new route or path
        }

        return view('admin.video.index_video', compact('video'));
    }

    /**
     * Storing temporary video file
     */
    public function create(Request $request)
    {

        if (session('video')) { //->dellete file session and temporary file in storage
            Storage::disk('public')->delete(session('video'));
            session(['video' => null]);
        };

        // ===== validate the file ======
        if ($request->hasFile('video')) {
            $request->validate([
                'video' => 'mimetypes:video/mp4,video/quicktime,video/webm',
            ]);

            // ===== storing file and route to session ======
            $path = $request->file('video')->store('temporary', 'public');
            session(['video' => $path]);

            // ===== custom route | custom path ======
            $path = pathinfo($path, PATHINFO_BASENAME);
            $path = url('/') . '/' . "admin/video/temp/" . $path;
        } else {
            session(['video' => null]); //->null-ing if data is empty
        }
        return response()->json(['path' => $path]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        if (session('video')) {

            $path = pathinfo(session('video'), PATHINFO_BASENAME); //->get file name
            if (Storage::disk('public')->exists(session('video'))) { //->check file from session exist
                Storage::disk('public')->move('temporary/' . $path, 'videos/' . $path); //->move the file to main storage
            }

            $update = false; //->declare |prevent eror

            $check = Video::count();
            if ($check > 0) { //->check is there already have a data

                //==== update db ======
                $update = Video::findOrFail(1);
                if ($update) {
                    $update->file_path = 'videos/' . $path;
                    $update->save();
                }
            } else {
                //==== create / store db ======
                Video::create([
                    'title' => 'video file',
                    'file_path' => 'videos/' . $path,
                    'status' => 0,
                ]);
            }
            return back()->with('success', 'success');
        } else {
            session()->put('success', 'failed to upload');
            return back()->withErrors('No file uploaded.');
        }
    }

    /**
     * Display the specified resource.
     * custom route for video main
     */
    public function show($filename)
    {
        // Corrected path to include 'public'
        $path = storage_path('app/public/videos/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        $headers = [
            'Content-Type' => 'video/mp4',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ];

        return FacadesResponse::file($path, $headers);
    }

    /**
     * custom route for temporary file
     * displaying video or file
     */
    public function edit($files)
    {
        // Corrected path to include 'public'
        $path = storage_path('app/public/temporary/' . $files);

        if (!file_exists($path)) {
            abort(404);
        }

        $headers = [
            'Content-Type' => 'video/mp4',
            'Content-Disposition' => 'inline; filename="' . $files . '"',
        ];

        return FacadesResponse::file($path, $headers);
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
