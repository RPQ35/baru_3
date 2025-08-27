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
        $que = Queues::where('is_called', 1)
            ->latest('updated_at')
            ->limit(4)
            ->get();
        // dd($que);

        // Get existing session data or empty array
        $ex_que = session('que_data', []);
        // $ex_que=[];

        // Step 1: reset all statuses to false before checking new data

        foreach ($ex_que as &$item) {
            $item['status'] = false;
        }
        unset($item); // break reference

        $array_l = count($ex_que);
        // dd($array_l);
        // Step 2: loop through current queue items
        foreach ($que as $a) {
            if ($array_l >= 3) {
                $quenum = $a->queues_number;
                $timeStr = $a->updated_at->format('Y-m-d H:i:s');
                // ensure string comparison

                // Check if this data already exists in session
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
                    // else: leave status as false (since no change)
                } else {
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
                    // dd($index);
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
                } else {
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
        // dd(session('que_data'));


        $video = Video::first();
        if ($video) {
            $video->file_path = explode('/', $video->file_path);
            $video = url('/') . '/' . "video/" . $video->file_path[1];
        }

        $text = Running_text::first();
        if ($text) {
            $text = $text->texts;
        }
        ;

        return view('signage.index_signage', compact('video', 'que', 'text'));
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
