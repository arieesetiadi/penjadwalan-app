<?php

use Carbon\Carbon;

function dateFormat($date)
{
    return Carbon::make($date)->isoFormat('dddd, D MMMM Y');
}

function timeFormat($time)
{
    return Carbon::make($time)->format('h:i A');
}

function getOffset($daysName, $firstDate)
{
    foreach ($daysName as $i => $dayName) {
        if ($dayName == $firstDate->isoFormat('dddd')) {
            return $i;
        }
    }
}
