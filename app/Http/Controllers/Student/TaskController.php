<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        foreach ($tasks as $task) {
            $assignment = $task->assignments()->where('user_id', auth()->user()->id)->first();
            if ($assignment != null) {
                if ($assignment->status == 1) {
                    $task->assign_status = 1;
                } else {
                    $task->assign_status = 2;
                }
            } else {
                $task->assign_status = 0;
            }
            $deadline = Carbon::parse($task->deadline)->translatedFormat('l, j F Y H:i:s');
            $task->deadline = $deadline;

            $task->description = substr($task->description, 0, 100) . '...';
            $task->uuid = Crypt::encrypt($task->id);
        }
        $unassigned_tasks = $tasks->where('assign_status', '==', 0)->sortByDesc('updated_at')->slice(0, 3);
        $unchecked_tasks = $tasks->where('assign_status', '==', 1)->sortByDesc('updated_at')->slice(0, 3);
        $checked_tasks = $tasks->where('assign_status', '==', 2)->sortByDesc('updated_at')->slice(0, 3);

        return view('content.student.task.index', compact('unassigned_tasks', 'unchecked_tasks', 'checked_tasks'));
    }

    public function all($category)
    {
        $tasks = Task::all();
        foreach ($tasks as $task) {
            $assignment = $task->assignments()->where('user_id', auth()->user()->id)->first();
            if ($assignment != null) {
                if ($assignment->status == 1) {
                    $task->assign_status = 1;
                } else {
                    $task->assign_status = 2;
                }
            } else {
                $task->assign_status = 0;
            }
            $deadline = Carbon::parse($task->deadline)->translatedFormat('l, j F Y H:i:s');
            $task->deadline = $deadline;

            $task->description = substr($task->description, 0, 100) . '...';
            $task->uuid = Crypt::encrypt($task->id);
        }
        $tasks = $tasks->where('assign_status', '==', $category)->sortByDesc('updated_at')->slice(0, 3);

        return view('content.student.task.all', compact('tasks', 'category'));
    }

    public function show($id)
    {
        $task = Task::where('id', Crypt::decrypt($id))->first();
        $deadline = Carbon::parse($task->deadline)->translatedFormat('l, j F Y H:i:s');
        $task->deadline = $deadline;

        return view('content.student.task.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::where('id', Crypt::decrypt($id))->first();
        $assignment = $task->assignments()->where('user_id', auth()->user()->id)->first();
        return view('content.student.task.edit', compact('task', 'assignment'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'file' => 'required|mimes:jpg,png,svg,pdf,doc,docx|max:5012'
        ]);

        $file = $request->file('file');
        $fileName = time() . '@@' . $request->file->getClientOriginalName();
        $file->storeAs('uploads/' . $request->task_id, $fileName, 'public');
        $fileName = $request->task_id . '-' . $fileName;

        $task = Task::where('id', $request->task_id)->first();
        if (Carbon::now() > $task->deadline) {
            $type = 2;
        } else {
            $type = 1;
        }
        $task->assignments()->create([
            'assignment_date' => Carbon::now(),
            'status' => 1,
            'file' => $fileName,
            'type' => $type,
            'user_id' => auth()->user()->id,
            'task_id' => $request->task_id
        ]);

        return redirect()->back()->with('success', 'Penugasan berhasil dikumpulkan!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,png,svg,pdf,doc,docx|max:5012'
        ]);

        $file = $request->file('file');
        $fileName = time() . '@@' . $request->file->getClientOriginalName();
        $file->storeAs('uploads/' . $request->task_id, $fileName, 'public');
        $fileName = $request->task_id . '-' . $fileName;

        $task = Task::where('id', $request->task_id)->first();
        if (Carbon::now() > $task->deadline) {
            $type = 2;
        } else {
            $type = 1;
        }
        $task->assignments()->where('user_id', auth()->user()->id)->update([
            'assignment_date' => Carbon::now(),
            'status' => 'pending',
            'file' => $fileName,
            'type' => $type,
            'user_id' => auth()->user()->id,
            'task_id' => $request->task_id
        ]);

        return redirect()->back()->with('success', 'Penugasan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $task = Task::where('id', Crypt::decrypt($id))->first();
        $task->assignments()->where('user_id', auth()->user()->id)->delete();
        return redirect()->back()->with('success', 'Assignment deleted successfully!');
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
