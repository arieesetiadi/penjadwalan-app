<?php

use Carbon\Carbon;
use App\Models\Schedule;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;

function dateFormat($date)
{
    return Carbon::make($date)->isoFormat('dddd, D MMMM Y');
}

function dateTimeFormat($datetime)
{
    $date = Carbon::make($datetime)->isoFormat('dddd, D MMMM Y');
    $time = Carbon::make($datetime)->format('h:i A');

    return $date . ' - ' . $time;
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

function makeStatus($status)
{
    switch ($status) {
        case 1:
            return '<span class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Pending">
                        <i class="bi bi-clock-fill text-warning"></i>
                    </span>';
            break;
        case 2:
            return '<span class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Disetujui">
                        <i class="bi bi-hand-thumbs-up-fill text-primary"></i>
                    </span>';
            break;
        case 3:
            return '<span class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ditolak">
                        <i class="bi bi-x-circle-fill text-danger"></i>
                    </span>';
            break;
        case 4:
            return '<span class="" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Selesai">
                        <i class="bi bi-check-circle-fill text-success"></i>
                    </span>';
            break;
    }
}

function getCalendarData()
{
    $current = session('currentMonth') ? Carbon::make(session('currentMonth')) : now();
    $data['daysName'] = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    $data['datesOfMonth'] = makePeriod($current);
    $data['offset'] = getOffset($data['daysName'], $current->firstOfMonth());
    // $data['activeSchedules'] = Schedule::getActive();
    $data['current'] = $current;

    // Ambil seluruh data perhari di bulan ini
    $data['dataInMonth'] = Schedule::getInMonth($data['datesOfMonth']);

    return $data;
}

function getRunningByUserId($id)
{
    return Schedule::getRunningByUserId($id);
}

function str($content)
{
    return Str::of($content);
}

function isToday($date)
{
    return $date->format('Y-m-d') == now()->format('Y-m-d');
}

function isPass($date)
{
    return $date->format('Y-m-d') < now()->format('Y-m-d');
}

function isNoteEmpty($request)
{
    // if (is_null($request->contentText) && is_null($request->contentImage) && is_null($request->contentFile)) {
    //     return true;
    // }

    if (is_null($request->contentText) && count($request->contentImages) == 0 && count($request->files) == 0) {
        return true;
    }
}
