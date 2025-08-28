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
        // == set que data =======================================================================================
        $que = Queues::where('is_called', 1)
            ->latest('updated_at')
            ->limit(4)
            ->get();

        // Get existing session data or empty array
        $ex_que = session('que_data', []);
        // $ex_que=[]; //->to reset session data

        // Step 1: reset all statuses to false before checking new data
        foreach ($ex_que as &$item) {
            $item['status'] = false;
        }
        unset($item); // break reference


        // Step 2: loop through current queue items
        $array_l = count($ex_que);
        foreach ($que as $a) {
            if ($array_l >= 3) {//set max data of que
                $quenum = $a->queues_number;
                $timeStr = $a->updated_at->format('Y-m-d H:i:s');
                // ensure string comparison

                // Check if this data already exists in session
                $index = array_search($quenum, array_column($ex_que, 'data'));

                if ($index !== false) {
                    // Found same data → check if time is different
                    if ($ex_que[$index]['time'] !== $timeStr) {//change same data(old) into new one
                        array_splice($ex_que, $index, 1);
                        $ex_que[] = [
                            'title' => 'apalah',
                            'data' => $quenum,
                            'status' => true,
                            'time' => $timeStr,
                        ];
                    }
                } else {
                    // make a new data that changes the oldes data
                    usort($ex_que, fn($x, $y) => strtotime($x['time']) <=> strtotime($y['time']));
                    $ex_que[0] = [
                        'title' => 'apalah',
                        'data' => $quenum,
                        'status' => true,
                        'time' => $timeStr,
                    ];

                }
            } else {
                $quenum = $a->queues_number;
                $timeStr = $a->updated_at->format('Y-m-d H:i:s');
                $index = array_search($quenum, array_column($ex_que, 'data'));

                if ($index !== false) {
                    // Found same data → check if time is different
                    if ($ex_que[$index]['time'] !== $timeStr) {
                        array_splice($ex_que, $index, 1);
                        $ex_que[] = [
                            'title' => 'apalah',
                            'data' => $quenum,
                            'status' => true,
                            'time' => $timeStr,
                        ];
                    }
                } else {//make new data
                    $ex_que[] = [
                        'title' => 'apalah',
                        'data' => $quenum,
                        'status' => true,
                        'time' => $timeStr,
                    ];
                }


            }
        }

        // Step 3: save back to session
        session(['que_data' => $ex_que]);
        $que = $ex_que;
        // ===================================================================================================
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
            'que',
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
