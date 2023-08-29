<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all(); 
        if($students->count() > 0){
            return response()->json([
                'status' => 200,
                'students' => $students
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ],404);
        }
    }
    //create student record
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name" =>'required|string|max:191',
            "course" =>'required|string|max:191',
            "email" =>'required|unique:students|email|max:191',
            "phone" =>'required|digits:10',
        ]);
        if ($validator -> fails()) {

            return response()->json([
                'status' => 422,                
                'errors' => $validator->messages()
            ], 422);
        }else{
            $student = Student::create([
                'name'=> $request->name,
                'course'=> $request->course,
                'email'=> $request->email,
                'phone'=> $request->phone,
            ]);
            if($student){
                return response()->json([
                    'status'=>200,
                    'message'=>"Student Added Successfully"
                ],200);
            }
            else{
                return response()->json([
                    'status'=>500,
                    'message'=>"Something Went Wrong"
                ],500);
            }
        }
    }
    //show single student
    public function show($id)
    {
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status'=>200,
                'student'=>$student
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message'=>'Student Not Found'
            ],404);
        }
    }
    //edit student record
    public function edit($id)
    {
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status'=>200,
                'student'=>$student
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message'=>'Student Not Found'
            ],404);
        }
    }
    //update student
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            "name" =>'required|string|max:191',
            "course" =>'required|string|max:191',
            "email" =>'required|email|max:191',
            "phone" =>'required|digits:10',
        ]);
        if ($validator -> fails()) {

            return response()->json([
                'status' => 422,                
                'errors' => $validator->messages()
            ], 422);
        }else{
            $student= Student::find($id);
            
            if($student){
                $student->update([
                    'name'=> $request->name,
                    'course'=> $request->course,
                    'email'=> $request->email,
                    'phone'=> $request->phone,
                ]);
                return response()->json([
                    'status'=>200,
                    'message'=>"Student updated Successfully"
                ],200);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>"No Such Student Found"
                ],404);
            }
        }
    }
    //delete student 
    public function destroy($id)
    {
        $student = Student::find($id);
        if($student){
            $student->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Student deleted Successfully"
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"No Such Student Found"
            ],404);
        }
    }
}
