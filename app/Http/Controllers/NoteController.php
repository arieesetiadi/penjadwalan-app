<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Mail\BroadcastNotes;
use App\Models\Note;
use App\Models\Schedule;
use Illuminate\Support\Facades\Mail;
class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload($id)
    {
        $data = [
            'title' => 'Upload Notulen',
            'scheduleId' => $id,
            'noteTitle' => 'Notulen ' . Schedule::getById($id)[0]->description
        ];

        return view('schedule.upload-notulen', $data);
    }

    public function store(NoteRequest $request)
    {
        // Redirect back jika tidak ada notulen yang dicantumkan
        if (isNoteEmpty($request)) {
            return back()->with('noteEmpty', 'Cantumkan minimal satu informasi dari 3 pilihan dibawah sebagai notulen rapat.');
        }

        // Upload gambar dan ambil semua nama gambar
        $imageNames = $this->uploadImages($request->contentImages);

        // Upload file dan ambil semua nama file
        $fileNames = $this->uploadFiles($request->contentFiles);

        Note::upload($request->only('title', 'scheduleId', 'contentText'), $imageNames, $fileNames);
        $this->broadcast($request->only('title', 'scheduleId', 'contentText'), $imageNames, $fileNames);

        return redirect()->to('/')->with('status', 'Berhasil menambah notulen rapat');
    }

    public function broadcast($note, $imageNames, $fileNames)
    {
        Mail::send(new BroadcastNotes($note, $imageNames, $fileNames));
    }

    public function uploadImages($images)
    {
        $imageNames = '';

        if (!is_null($images)) {
            if (count($images) > 0) {
                foreach ($images as $image) {
                    // Buat nama gambar
                    $imageName = time() . '_' . str($image->getClientOriginalName())->lower();
                    $imageNames .= $imageName . '|';

                    // Move gambar ke public
                    $image->move('uploaded/images/', $imageName);
                }
            }
        }

        return $imageNames;
    }

    public function uploadFiles($files)
    {
        $fileNames = '';

        if (!is_null($files)) {
            if (count($files) > 0) {
                foreach ($files as $file) {
                    // Buat nama file
                    $fileName = time() . '_' . str($file->getClientOriginalName())->lower();
                    $fileNames .= $fileName . '|';

                    // Move gambar ke public
                    $file->move('uploaded/files/', $fileName);
                }
            }
        }

        return $fileNames;
    }
}
