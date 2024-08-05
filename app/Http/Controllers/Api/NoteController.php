<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    //Add Notes
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

    //Detail Notes
    public function showNote($id) {
        $note = DB::table('notes')->where('id',$id)->first();

        if ($note) {
            return response()->json([
                'note' => $note
            ], 200);
        } else {
            return response()->json([
                'message' => 'Note not found'
            ], 404);
        }
    }

    //Edit Notes
    public function editNote(Request $request, $id) {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $note = DB::table('notes')->where('id',$id)->first();

        if (!$note) {
            return response()->json([
                'message' => 'Note not found'
            ], 404);
        }

        if (Auth::id() !== $note->id) {
            return response()->json([
                'message' => 'You do not have permission to edit this record'
            ]);
        }

        DB::table('notes')
            ->where('id', $id)
            ->update([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'updated_at' => now(),
            ]);

            $updatedNote = DB::table('notes')->where('id', $id)->first();

            return response()->json([
                'message' => 'Note was successfully updated',
                'note' => $updatedNote
            ], 200);
    }

    //Delete Notes
    public function deleteNote($id) {
        $note = DB::table('notes')->where('id', $id)->first();

        if (Auth::id() !== $note->id) {
            return response()->json([
                'message' => 'You do not have permission to edit this record'
            ]);
        }

        DB::table('notes')->where('id', $id)->delete();

        return response()->json([
            'message' => 'Note is successfully deleted'
        ], 200);
    }
}