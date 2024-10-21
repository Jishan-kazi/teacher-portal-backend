<?php

namespace App\Http\Controllers;

use App\Http\Requests\student\SaveStudentRequest;
use App\Models\Student;
use Exception;

class StudentController extends Controller
{
    public function index() {
        try {
            $students = Student::where('teacher_id', auth()->id())->paginate(1);
            return response_format('All Students', $students, true, 200);
        } catch (\Throwable $th) {
            return response_format($th->getMessage(), null, false, 500);
        }
    }

    public function destroy($id) {
        try {
            $student = Student::find($id);
            if (!$student) {
                throw new Exception('Student not found', 1);
            }
            $student->delete();
            return response_format('Student deleted successfully', null, true, 200);
        } catch (\Throwable $th) {
            return response_format($th->getMessage(), null, false, 500);
        }
    }

    public function store(SaveStudentRequest $request) {
        try {
            // if student already exist, just update marks
            $student = Student::where('teacher_id', auth()->id())->where('name', $request->name)->where('subject', $request->subject)->first();
            if ($student) {
                $student->marks = $request->marks;
            }else{
                $student = new Student();
                $student->teacher_id = auth()->id();
                $student->name = $request->name;
                $student->subject = $request->subject;
                $student->marks = $request->marks;
            }
            $student->save();

            return response_format('Student added successfully', null, true, 200);
        } catch (\Throwable $th) {
            return response_format($th->getMessage(), null, false, 500);
        }
    }

    public function update(SaveStudentRequest $request, $id) {
        try {
            $student = Student::find($id);
            $student->name = $request->name;
            $student->subject = $request->subject;
            $student->marks = $request->marks;
            $student->save();
            return response_format('Student updated successfully', null, true, 200);
        } catch (\Throwable $th) {
            return response_format($th->getMessage(), null, false, 500);
        }
    }
}
