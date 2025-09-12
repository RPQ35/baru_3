<?php

namespace App\Livewire;

use App\Models\Queues;
use Livewire\Component;

class SignageCard extends Component
{


    public function render()
    {
        $pollInterval = 8; //->default interval
        $Interval = $pollInterval; //->backup for adding up the interval

        // == set que data =======================================================================================

        $que = Queues::where('is_called', 1)
            ->latest('updated_at')
            ->limit(4)
            ->get();

        // Get existing session data or empty array
        $ex_que = session('que_data', []);

        $ex_que = []; //->to reset session data

        // Step 1: reset all statuses to false before checking new data
        foreach ($ex_que as &$item) {
            $item['status'] = false;
        }
        unset($item); // break reference

        // Step 2: loop through current queue items
        $array_l = count($ex_que);
        foreach ($que as $a) {
            if ($array_l >= 3) { //set max data of que
                $quenum = $a->queues_number;
                $timeStr = $a->updated_at->format('Y-m-d H:i:s');
                // ensure string comparison

                // Check if this data already exists in session
                $index = array_search($quenum, array_column($ex_que, 'data'));

                if ($index !== false) {
                    // Found same data → check if time is different
                    if ($ex_que[$index]['time'] !== $timeStr) { //change same data(old) into new one
                        array_splice($ex_que, $index, 1);
                        $ex_que[] = [
                            'title' => 'apalah',
                            'data' => $quenum,
                            'status' => true,
                            'time' => $timeStr,
                        ];
                        $pollInterval = $pollInterval + $Interval;
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
                    $pollInterval = $pollInterval + $Interval;
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
                        $pollInterval = $pollInterval + $Interval;
                    }
                } else { //make new data
                    $ex_que[] = [
                        'title' => 'apalah',
                        'data' => $quenum,
                        'status' => true,
                        'time' => $timeStr,
                    ];
                    $pollInterval = $pollInterval + $Interval;
                }
            }
        }

        // Step 3: save back to session
        session(['que_data' => $ex_que]);
        $que = $ex_que;

        // =======================================================================================================
        // == set count & delay & intervall data =================================================================
        /**
         * $countes is for count how many row is active and pass it on signage.js
         */
        $countes = count(array_filter($que, fn($item) => $item['status'] === true));
        $backup_count = $countes; //->second data for count calculation

        /**
         * $delay is for delay of each audio from each card
         */
        $delay = 8000;

        $pollInterval = $pollInterval . 's'; //-> finalize the interval time

        // =======================================================================================================

        return view('livewire.signage-card', compact(
            'que',
            'pollInterval',
            'countes',
            'backup_count',
            'delay'
        ));
    }
}
