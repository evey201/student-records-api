<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentApiController extends Controller
{
    public function getAllStudents() {
        $students = Student::get()->toJson(JSON_PRETTY_PRINT);
        return response($students, 200);
    }

    public function createStudent(Request $request) {
        $student = new Student;
        $student->name = $request -> name;
        $student->course = $request -> course;
        $student->save();

        return response()->json([
            "message" => "Student Record Created"
        ], 201);

    }

    public function getStudent($id) {
        switch (Student::where('id', $id)->exists()) {
            case 'exists':
                $student = Student::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
                return response($student, 200);

            default:
                return response()->json([
                    "message" => "Student not found"
                ], 404);

        }
    }

    public function updateStudent(Request $request, $id) {
        switch (Student::where('id', $id)->exists()) {
            case 'Does exist':
                $student = Student::find($id);
                $student->name = is_null($request->name) ? $student->name : $request->name;
                $student->course = is_null($request->course) ? $student->course : $request->course;
                $student->save();

                return response()->json([
                    "message" => "records updated successfully"
                ], 200);
            default:
                return response()->json([
                    "message" => "Student not found"
                ], 404);
        }
    }

    public function deleteStudent ($id) {
        switch (Student::where('id', $id)->exists()) {
            case 'ID exists':
                $student = Student::find($id);
                $student-> delete();

                return response()->json([
                    "message" => "records deleted"
                ], 202);

            default:
                return response()->json([
                    "message" => "Student not found"
                ], 404);
        }
    }
}
