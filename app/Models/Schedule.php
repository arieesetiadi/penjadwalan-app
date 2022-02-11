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

    public static function getPending()
    {
        return self
            ::whereDate('date', '>=', now()->format('Y-m-d'))
            ->where('status', 'pending')
            ->get();
    }

    public static function getActive()
    {
        return self
            ::whereDate('date', '>=', now()->format('Y-m-d'))
            ->where('status', 'active')
            ->get();
    }

    public static function getByBorrowerId($id)
    {
        return self
            ::where('user_borrower_id', $id)
            ->orderByDesc('id')
            ->get();
    }

    public static function getByOfficerId($id)
    {
        return self
            ::where('user_officer_id', $id)
            ->orderByDesc('id')
            ->get();
    }

    public static function getByDate($date)
    {
        return self
            ::whereDate('date', $date)
            ->orderByDesc('date')
            ->get();
    }

    public static function getInMonth($dates)
    {
        foreach ($dates as $date) {
            $data[] = self::getByDate($date);
        }

        return $data;
    }

    public static function setActive($id)
    {
        $schedule = self::find($id);

        $schedule->update([
            'status' => 'active',
            'approved_at' => now()->format('Y-m-d H:i:s'),
            'user_officer_id' => auth()->user()->id
        ]);

        return $schedule->description;
    }

    // Fungsi untuk cek ketersediaan jadwal
    public static function check($date, $start, $end)
    {
        $activeSchedules = self::getActive();
        $rules = null;

        foreach ($activeSchedules as $i => $active) {
            if ($start < $active->start) {
                $rules =
                    ($active->start >= $start) &&
                    ($active->start <= $end)
                    ||
                    ($active->end >= $start) &&
                    ($active->end <= $end);
            } else if ($end >= $active->start) {
                $rules =
                    ($start >= $active->start) &&
                    ($start <= $active->end)
                    ||
                    ($end >= $active->start) &&
                    ($end <= $active->end);
            }

            if ($rules) return false;
        }
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
                'user_officer_id' => 0,
                'is_approved' => false,
                'requested_at' => now()->format('Y-m-d H:i:s.u0')
            ]);
    }

    public static function deleteById($id)
    {
        self
            ::where('id', $id)
            ->delete();

        // Hapus notulen dari schedule
        Note::deleteByScheduleId($id);
    }

    //  =================================================================

    // Relasi dengan User - Peminjam
    public function borrower()
    {
        return $this->belongsTo(User::class, 'user_borrower_id', 'id');
    }

    // Relasi dengan User - Petugas
    public function officer()
    {
        return $this->belongsTo(User::class, 'user_officer_id', 'id');
    }
}
