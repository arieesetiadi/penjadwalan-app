<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $guarded = [];

    //  =================================================================
    public static function deleteByScheduleId($id)
    {
        $note = self::where('schedule_id', $id);

        if (count($note->get()) > 0) {
            $note->delete();
        }
    }
}
