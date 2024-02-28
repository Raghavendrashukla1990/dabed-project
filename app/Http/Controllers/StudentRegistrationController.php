<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\StudentRegistration;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentRegistrationController extends Controller{
    
    public function index(Request $request){
        $student = new StudentRegistration();
        if($request->has('orderBy') && $request->has('order')){
            if($request->order == 'asc'){
                $student = $student->orderBy($request->orderBy,'ASC');
            }else{
                $student = $student->orderBy($request->orderBy,'DESC');
            }
        }

        if($request->has('search')){
            $student = $student->where('name','LIKE','%'.$request->search.'%')
            ->orWhere('email','LIKE','%'.$request->search.'%')
            ->orWhere('school','LIKE','%'.$request->search.'%')
            ->orWhere('father_name','LIKE','%'.$request->search.'%')
            ->orWhere('phone_number','LIKE','%'.$request->search.'%');
        }

        $student = $student->with('course:id,name')->paginate(10);
        return Inertia::render('Student/Index',[
            'student' => $student
        ]);
    }

    public function create(){
        $course     = Course::where('status','1')->get();
        return Inertia::render('Student/Form',[
            'course' => $course,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name'          => 'required|string|max:250',
            'email'         => 'required|email|max:250|unique:student_registrations',
            'dob'           => 'required',
            'phone_number'  => 'required|numeric|unique:student_registrations|digits:10',
            'school'        => 'required',
            'father_name'   => 'required|string|max:255',
            'password'      => 'required|min:8',
            'course_id'     => 'required',
        ]);

        StudentRegistration::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'dob'           => $request->dob,
            'phone_number'  => $request->phone_number,
            'school'        => $request->school,
            'father_name'   => $request->father_name,
            'password'      => Hash::make($request->password),
            'course_id'     => $request->course_id,
        ]);
        return redirect()->route('student.create')->banner('New Student Register Successfully.');
    }

    
    public function edit($ID){
        $course  = Course::where('status','1')->get();
        $student = StudentRegistration::where('id',$ID)->first();
        if($student){
            return Inertia::render('Student/Form',[
                'student'   => $student,
                'course'    => $course,
            ]);
        }
        return redirect()->route('student.index')->banner('Student Not Found.');;
    }

    public function update(Request $request, $ID){
        $request->validate([
            'name'          => 'required|string|max:250',
            'email'         => 'required|email|unique:student_registrations,email,'.$ID,
            'dob'           => 'required',
            'phone_number'  => 'required|numeric|digits:10|unique:student_registrations,phone_number,'.$ID,
            'school'        => 'required',
            'father_name'   => 'required|string|max:255',
            'password'      => 'nullable|min:8',
            'course_id'     => 'required',
        ]);

        $update['name']          = $request->name;
        $update['email']         = $request->email;
        $update['dob']           = $request->dob;
        $update['phone_number']  = $request->phone_number;
        $update['school']        = $request->school;
        $update['father_name']   = $request->father_name;
        if($request->password){
            $update['password']  = Hash::make($request->password);
        }
        $update['course_id']     = $request->course_id;
        StudentRegistration::findOrFail($ID)->update($update);
        return redirect()->route('student.edit',$ID)->banner('Student Data Update Successfully.');
    }

    public function destroy($ID){
        $course = StudentRegistration::find($ID);
        if($course){
            $course->delete();
        }
        return redirect()->route('student.index')->banner('Student Deleted Successfully.');
    }
}
