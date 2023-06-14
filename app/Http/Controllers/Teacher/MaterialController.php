<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MaterialController extends Controller
{
  public function index()
  {
    $materials = Material::all();
    return view('content.teacher.material.index', compact('materials'));
  }

  public function create()
  {
    return view('content.teacher.material.create');
  }

  public function show(Material $material)
  {
    return view('content.teacher.material.show', compact('material'));
  }

  public function edit(Material $material)
  {
    return view('content.teacher.material.edit', compact('material'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string|max:5000',
      'file' => 'required|mimes:doc,docx,pdf,xls,xlsx,csv,ppt,pptx|max:5012'
    ]);

    if ($request->hasFile('file')) {
      $file = $request->file('file');
      $fileName = time() . '.' . $request->file->extension();
      $file->storeAs('uploads', $fileName, 'public');
    }

    $input = $request->all();
    $input['file'] = $fileName;
    $input['user_id'] = auth()->user()->id;
    $input['status'] = 0;

    Material::create($input);

    return redirect()->route('teacher.material.index')->with('success', 'Material created successfully');
  }

  public function update(Request $request, Material $material)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string|max:5000',
    ]);


    if ($request->hasFile('file')) {
      $request->validate([
        'file' => 'mimes:doc,docx,pdf,xls,xlsx,csv,ppt,pptx|max:5012'
      ]);

      $file = $request->file('file');
      $fileName = time() . '.' . $request->file->extension();
      $file->storeAs('uploads', $fileName, 'public');
      $material->file = $fileName;
    }

    $material->title = $request->title;
    $material->description = $request->description;
    $material->save();

    return redirect()->route('teacher.material.index')->with('success', 'Material updated successfully');
  }

  public function destroy(Material $material)
  {
    $material->delete();

    return redirect()->route('teacher.material.index')->with('success', 'Material deleted successfully');
  }

  public function publishStatus(Material $material)
  {

    if ($material->status == 0) {
      $material->status = 1;
      $material->save();
      return redirect()->route('teacher.material.index')->with('success', 'Material published successfully');
    } else {
      $material->status = 0;
      $material->save();
      return redirect()->route('teacher.material.index')->with('success', 'Material unpublished successfully');
    }
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
