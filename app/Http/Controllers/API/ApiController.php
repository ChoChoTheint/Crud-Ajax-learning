<?php

namespace App\Http\Controllers\API;

use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    public function teacherList(){
        $teacher = Teacher::get();
        $response = [
            'status' => 'success',
            'data' => $teacher
        ];
        return Response::json($teacher);
    }
    public function teacherCreate(Request $request){
        $data = [
            'name' => $request->name,
            'title' => $request->title,
            'institute' => $request->institute
        ];

        Teacher::create($data);
        $response = [
            'status' => '200',
            'message' => 'success',
        ];

        return Response::json($response);
    }
    public function teacherDelete($id){
        $data = Teacher::where('id',$id)->first();
        if(empty($data)){
            return Response::json([
                'status' => '200',
                'message' => 'There is no such data in table'  
            ]);
        }
        Teacher::where('id',$id)->delete();
        return Response::json([
            'status' => '200',
            'message' => 'success',
           
       ]);
    }
    public function teacherDetail($id){
       $data = Teacher::where('id',$id)->first();
       if(empty($data)){
        return Response::json([
            'status' => '200',
            'message' => 'fail',
            'data' => $data
        ]);
       }

       return Response::json([
            'status' => '200',
            'message' => 'success',
            'data' => $data
       ]);
    }
    public function teacherUpdate(Request $request){
        dd($request);
        $data = [
            'id' => $request->id,
            'name' => $request->name,
            'title' => $request->title,
            'institute' => $request->institute
        ];

        $check = Teacher::where('id',$request->id)->first();
        if(!empty($check)){
            Teacher::where('id',$request->id)->update($data);
            return Response::json([
                'status' => 200,
                'message' => "success",
                'data' => $data
            ]);
        }
        return Response::json([
            'status' => 200,
            'message' => "There is no such data"
        ]);
    }
}
