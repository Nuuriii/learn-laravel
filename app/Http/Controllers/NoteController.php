<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    public function addNote(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $noteId = DB::table('notes')->insertGetId([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $note = DB::table('notes')->where('id', $noteId)->first();
        return response()->json([
            'status' => true,
            'message' => 'Note add successfully',
            'note_id' => $noteId,
            'note' => $note
        ],201);
    }
}