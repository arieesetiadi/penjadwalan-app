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

    public static function getById($id)
    {
        return self
            ::where('id', $id)
            ->get();
    }

    public static function getPending()
    {
        return self
            ::whereDate('date', '>=', now()->format('Y-m-d'))
            ->where('status', 'pending')
            ->get();
    }

    public static function getAlmostStarted($diff)
    {
        $date = now()->format('Y-m-d');
        $then = Carbon::make(now()->format('H:i'))->addMinute($diff)->format('H:i:s');

        return self
            ::whereDate('date', $date)
            ->where('start', $then)
            ->get('id');
    }

    public static function getAlmostFinish()
    {
        $date = now()->format('Y-m-d');
        $now = Carbon::make(now()->format('H:i'))->format('H:i:s');

        return self
            ::whereDate('date', $date)
            ->where('end', $now)
            ->get('id');
    }

    public static function getActive()
    {
        return self
            ::whereDate('date', '>=', now()->format('Y-m-d'))
            ->where('status', 'active')
            ->get();
    }

    public static function getActiveByDate($date)
    {
        $date = Carbon::make($date)->format('Y-m-d');

        return self
            ::whereDate('date', $date)
            ->where('status', 'active')
            ->orderBy('start', 'asc')
            ->get();
    }

    public static function getActiveByBorrowerId($id)
    {
        return self
            ::where('user_borrower_id', $id)
            ->where('status', 'active')
            ->orderBy('start', 'asc')
            ->get();
    }

    public static function getPendingByBorrowerId($id)
    {
        return self
            ::where('user_borrower_id', $id)
            ->where('status', 'pending')
            ->orWhere('status', 'decline')
            ->orderBy('start', 'asc')
            ->get();
    }

    public static function getFinishByBorrowerId($id)
    {
        return self
            ::where('user_borrower_id', $id)
            ->where('status', 'finish')
            ->orderBy('id', 'desc')
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
            ->orderBy('start', 'asc')
            ->get();
    }

    public static function getInMonth($dates)
    {
        foreach ($dates as $date) {
            $data[] = self::getActiveByDate($date);
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

    public static function setDecline($id)
    {
        $schedule = self::find($id);

        $schedule->update([
            'status' => 'decline'
        ]);

        return $schedule->description;
    }

    public static function setFinish($id)
    {
        $schedule = self::find($id);

        $schedule->update([
            'status' => 'finish'
        ]);

        return $schedule->description;
    }

    // Fungsi untuk cek ketersediaan jadwal
    public static function check($date, $start, $end)
    {
        $activeSchedules = self::getActiveByDate($date);
        $start = Carbon::make($start)->toTimeString();
        $end = Carbon::make($end)->toTimeString();
        return [$start, $end];
        $rules = null;

        foreach ($activeSchedules as $active) {
            if ($start < $active->start) {
                $rules =
                    ($active->start >= $start) &&
                    ($active->start < $end)
                    ||
                    ($active->end >= $start) &&
                    ($active->end <= $end);
            } else if ($start >= $active->start) {
                $rules =
                    ($start >= $active->start) &&
                    ($start < $active->end)
                    ||
                    ($end >= $active->start) &&
                    ($end <= $active->end);
            }

            // Jika jadwal sudah terdaftar, return false
            if ($rules) {
                return false;
            } else {
                return true;
            }
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
                'user_borrower_id' => $data['user'],
                'user_officer_id' => auth()->user()->id,
                'status' => 'active',
                'requested_at' => now()->format('Y-m-d H:i:s.u0'),
                'approved_at' => now()->format('Y-m-d H:i:s.u0'),
                'created_at' => now()->format('Y-m-d H:i:s.u0')
            ]);
    }

    public static function insertRequest($data)
    {
        self
            ::create([
                'date' => Carbon::make($data['date'])->format('Y-m-d'),
                'start' => $data['start'],
                'end' => $data['end'],
                'description' => $data['description'],
                'user_borrower_id' => auth()->user()->id,
                'user_officer_id' => 0,
                'status' => 'pending',
                'requested_at' => now()->format('Y-m-d H:i:s.u0')
            ]);
    }

    public static function updateById($data, $id)
    {
        self
            ::where('id', $id)
            ->update([
                'date' => Carbon::make($data['date'])->format('Y-m-d'),
                'start' => $data['start'],
                'end' => $data['end'],
                'description' => $data['description'],
                'user_borrower_id' => $data['user'],
                'updated_at' => now()->format('Y-m-d H:i:s.u0')
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

    // Relasi dengan Note
    public function note()
    {
        return $this->hasOne(Note::class, 'id', 'schedule_id');
    }
}
