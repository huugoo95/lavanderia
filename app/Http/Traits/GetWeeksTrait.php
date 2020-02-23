<?php

namespace App\Http\Traits;

use Carbon\Carbon;

trait getWeeksTrait
{
    public function getMondaysOfMonth()
    {
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');
        $mondays = 0;

        while ($start <= $end) {
            if ($start->isMonday()) {
                ++$mondays;
            }
            $start->addDay();
        }
        return $mondays;
    }

}
