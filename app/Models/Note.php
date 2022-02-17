<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    //  =================================================================
    public static function deleteByScheduleId($id)
    {
        $note = self::where('schedule_id', $id);

        if (count($note->get()) > 0) {
            $note->delete();
        }
    }

    public static function upload($data, $imageName, $fileName)
    {
        self
            ::create([
                'title' => $data['title'],
                'content_text' => $data['contentText'],
                'content_image' => $imageName,
                'content_file' => $fileName,
                'schedule_id' => $data['scheduleId'],
                'created_at' => now()->format('Y-m-d H:i:s')
            ]);
    }
}
