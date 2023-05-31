<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Task;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function task_index()
    {
        $tasks = Task::all();

        return view('content.teacher.assignment.task-index', compact('tasks'));
    }

    public function index(Task $task)
    {
        $assignments = $task->assignments()->orderBy('status')->get();

        return view('content.teacher.assignment.index', compact('assignments'));
    }

    public function show(Assignment $assignment)
    {
        return view('content.teacher.assignment.show', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        return view('content.teacher.assignment.edit', compact('assignment'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'score' => 'required|numeric|min:0|max:100',
            'note' => 'required|string|max:5000'
        ]);
        $assignment->score = $request->score;
        $assignment->note = $request->note;
        $assignment->status = 2;
        $assignment->save();

        return redirect()->route('teacher.assignment.index', $assignment->task_id)->with('success', 'Penugasan berhasil dinilai!');
    }

    public function download($file)
    {
        if (count(explode('@@', $file)) > 1) {
            $name = explode('@@', $file)[1];
        } else {
            $name = $file;
        }
        if (substr($file, 0, 1) == '/') {
            $file = substr($file, 1);
        }
        return response()->download(public_path('storage/uploads/' . $file), $name);
    }
}
