<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(Request $request)
    {
        $contentImageName = null;
        $contentFileName = null;

        if ($request->hasFile('contentImage')) {
            // Buat nama gambar
            $content = $request->file('contentImage');
            $contentImageName = time() . '_' . str($content->getClientOriginalName())->lower();

            // Move gambar ke public
            $content->move('uploaded/images/', $contentImageName);
        }

        if ($request->hasFile('contentFile')) {
            // Buat nama file
            $content = $request->file('contentFile');
            $contentFileName = time() . '_' . str($content->getClientOriginalName())->lower();

            // Move gambar ke public
            $content->move('uploaded/files/', $contentFileName);
        }

        Note::upload($request->only('title', 'scheduleId', 'contentText'), $contentImageName, $contentFileName);
    }

    public function broadcast()
    {
    }
}
