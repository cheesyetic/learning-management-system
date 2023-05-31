<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Support\Facades\Crypt;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::where('status', 1)->latest()->get();
        foreach ($materials as $material) {
            $material->uuid = Crypt::encrypt($material->id);
            $material->description = substr($material->description, 0, 100) . '...';
        }
        return view('content.student.material.index', compact('materials'));
    }

    public function show($id)
    {
        $material = Material::where('id', Crypt::decrypt($id))->first();
        return view('content.student.material.show', compact('material'));
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
