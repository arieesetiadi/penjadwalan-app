<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;

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

function makePeriod($date)
{
    // Ambil tanggal pertama dan terakhir bulan ini untuk membuat periode
    $firstDate = $date->firstOfMonth()->toDateString();
    $lastDate = $date->lastOfMonth()->toDateString();

    return CarbonPeriod::create($firstDate, $lastDate);
}
