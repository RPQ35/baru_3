<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        /**
         * having and showing only 1 data / file
         */
        $video = Video::first();
        if ($video) {
            $video->file_path = explode('/', $video->file_path);
            $video->file_path = url('/') . '/' . "video/" . $video->file_path[1];
            // dd($video->file_path);
        }

        return view('admin.video.index_video', compact('video'));
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
        if ($request->hasFile('video')) {
            $request->validate([
                'video' => 'mimetypes:video/mp4,video/quicktime,video/webm',
            ]);
            $path = $request->file('video')->store('videos', 'public');
            $update = false;



                $update = Video::findOrFail(1);
                if ($update) {
                    $update->file_path = $path;
                    $update->save();
                }


            else {
                Video::create([
                    'title' => 'video file',
                    'file_path' => $path,
                    'status' => 0,
                ]);
            }
            return back()->with('success', 'success');
        } else {
            session()->put('success','failed to upload');
            return back()->withErrors('No file uploaded.');
        }
    }

    /**
     * Display the specified resource.
     * custom route for video
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

/**
 * ignore - just experiment
 */

// $x = 15;
// $x = intval(ceil($x / 5));
// $y = [];
// $mx = 5;
// $d = 2;
// // dd($x);
// for ($i = 0; $i < $x; $i++) {
//     if (count($y) < $mx) {
//         if ($x == 1) {$y[]=1;
//         } else {
//             count($y) == 2 ? $d += 1 : '';
//             count($y) == 2 ? $y[] = $x : '';
//             count($y) > 2 ? $y[] = $x + $d : (0 == $x - $d ? '' : $y[] = $x - $d);
//             count($y) > 2 ? $d += 1 : (0 == $x - 1 ? $d = 0 : $d -= 1);
//         }
//     }
// }
// dd($y);