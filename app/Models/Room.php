<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public static function insert($name)
    {
        self::create([
            'name' => $name
        ]);
    }

    public static function updateById($name, $id)
    {
        self
            ::find($id)
            ->update([
                'name' => $name
            ]);
    }
}
