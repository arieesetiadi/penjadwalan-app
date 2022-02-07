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
