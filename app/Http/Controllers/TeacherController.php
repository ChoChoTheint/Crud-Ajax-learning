<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class TeacherController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function allTeacher()
    {
        $data = Teacher::orderBy('id', 'DESC')->get();
        return response()->json($data);
    }
    public function storeTeacher(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'institute' => 'required',
        ]);
        $teacher = Teacher::insert([
            'name' => $request->name,
            'title' => $request->title,
            'institute' => $request->institute,
        ]);
        return redirect()->back();
    }
    public function editTeacher($id){
        $data = Teacher::findOrfail($id);
        return response()->json($data);
    }
    public function updateTeacher(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'institute' => 'required',
        ]);
        $data = Teacher::findorFail($id)->update([
            'name' => $request->name,
            'title' => $request->title,
            'institute' => $request->institute,
        ]);
        return response()->json($data);
    }
}
