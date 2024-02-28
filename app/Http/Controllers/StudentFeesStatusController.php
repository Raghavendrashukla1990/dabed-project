<?php

namespace App\Http\Controllers;

use App\Models\StudentFeesStatus;
use App\Models\StudentRegistration;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentFeesStatusController extends Controller{
    
    public function index(){
        $student_fee = StudentFeesStatus::with('student:id,name')->with('course:id,name')->paginate(10);
        return Inertia::render('StudentFees/Index',[
            'student_fee' => $student_fee,
        ]);
    }

    public function create(){
        $students     = StudentRegistration::select('id','name','course_id')->with('course:id,name,price')->get();
        return Inertia::render('StudentFees/Form',[
            'students' => $students,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'course_id'                 => 'required',
            'student_id'                => 'required',
            'installment'               => 'required|integer|gt:0',
            'paid'                      => 'required|integer|gt:0',
            'balance'                   => 'required|integer|gt:0',
            'paid_date'                 => 'required',
            'next_installment_due_date' => 'required',
            'status'                    => 'required|in:1,0',
        ]);
        StudentFeesStatus::create($request->all());
        return redirect()->route('student.fee.create')->banner('Student Fees Added.');
    }

    public function edit($ID){
        $students     = StudentRegistration::select('id','name','course_id')->with('course:id,name,price')->get();
        $student_fee  = StudentFeesStatus::where('id',$ID)->with('student:id,name')->with('course:id,name')->first();
        return Inertia::render('StudentFees/Form',[
            'student_fee'   => $student_fee,
            'students'      => $students
        ]);
    }

    public function update(Request $request, $ID){
        $request->validate([
            'course_id'                 => 'required',
            'student_id'                => 'required',
            'installment'               => 'required|integer|gt:0',
            'paid'                      => 'required|integer|gt:0',
            'balance'                   => 'required|integer|gt:0',
            'paid_date'                 => 'required',
            'next_installment_due_date' => 'required',
            'status'                    => 'required|in:1,0',
        ]);

        StudentFeesStatus::findOrFail($ID)->update($request->all());
        return redirect()->route('student.fee.edit',$ID)->banner('Student Fee Updated.');
    }

    public function destroy($ID){
        $student_fee     = StudentFeesStatus::where('id',$ID)->first();
        if($student_fee){
            $student_fee->delete();
        }
        return redirect()->route('student.fee.index')->banner('Student Fee Deleted Successfully.');
    }
}
