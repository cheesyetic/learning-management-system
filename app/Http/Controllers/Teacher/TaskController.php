<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();

        return view('content.teacher.task.index', compact('tasks'));
    }

    public function create()
    {
        return view('content.teacher.task.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:doc,docx,pdf,xls,xlsx,csv,ppt,pptx|max:50000'
            ]);

            $file = $request->file('file');
            $fileName = time() . '.' . $request->file->extension();
            $file->storeAs('uploads', $fileName, 'public');
            $input['file'] = $fileName;
        }

        $input['user_id'] = auth()->user()->id;
        $input['status'] = 0;

        Task::create($input);

        return redirect()->route('teacher.task.index')->with('success', 'Tugas berhasil dibuat!');
    }

    public function show(Task $task)
    {
        return view('content.teacher.task.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('content.teacher.task.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required',
        ]);

        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:doc,docx,pdf,xls,xlsx,csv,ppt,pptx|max:50000'
            ]);

            $file = $request->file('file');
            $fileName = time() . '.' . $request->file->extension();
            $file->storeAs('uploads', $fileName, 'public');
            $task->file = $fileName;
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;

        $task->save();

        return redirect()->route('teacher.task.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('teacher.task.index')->with('success', 'Tugas berhasil dihapus!');
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

    public function publishStatus(Task $task)
    {

        if ($task->status == 0) {
            $task->status = 1;
            $task->save();
            return redirect()->route('teacher.task.index')->with('success', 'Tugas berhasil dipublikasikan!');
        } else {
            $task->status = 0;
            $task->save();
            return redirect()->route('teacher.task.index')->with('success', 'Tugas tidak lagi dipublikasikan!');
        }
    }
}
