<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    //  =================================================================

    public static function check($date, $start, $end)
    {
        return false;
    }

    public static function insert($data)
    {
        self
            ::create([
                'date' => Carbon::make($data['date'])->format('Y-m-d'),
                'start' => $data['start'],
                'end' => $data['end'],
                'description' => $data['description'],
                'user_borrower_id' => auth()->user()->id,
                'is_approved' => false,
                'requested_at' => now()->format('Y-m-d H:i:s.u0')
            ]);
    }
}
