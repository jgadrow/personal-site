<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WhoseTurn extends Controller
{
    public function calculate() {
        $people = [
            'Alisia',
            'Gary',
            'Dad',
            'JC',
            'Jeremy',
        ];

        $firstTuesdayAfterEpoch = 86400 * 5;
        $skipWeeks = 1;
        $secondsPerWeek = 86400 * 7;
        $numPlayers = count($people);
        $index = (time() - $firstTuesdayAfterEpoch - $skipWeeks * $secondsPerWeek) / $secondsPerWeek % $numPlayers;
        $current = $people[$index];
        $next = $people[$index < $numPlayers - 1 ? $index+1 : 0];
        $prev = $people[0 < $index ? $index-1 : $numPlayers - 1];

        return view('whose_turn', ['current' => $current, 'next' => $next, 'prev' => $prev]);
    }
}

