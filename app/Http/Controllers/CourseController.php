<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller{
   
    public function index(){
        $course = Course::paginate(10);
        return Inertia::render('Courses/Index',['course' => $course]);
    }

    public function create(){
        return Inertia::render('Courses/Form');
    }

    public function store(Request $request){
        $request->validate([
            'name'      => 'required|max:255',
            'price'     => 'required|integer|gt:0',
            'status'    => 'required|in:1,0',
        ]);
        Course::create($request->all());
        return redirect()->route('courses.create')->banner('New Course Has Been Enrolled.');
    }

    public function edit($ID){
        $course = Course::where('id',$ID)->first();
        if($course){
            return Inertia::render('Courses/Form',[
                'course'=>$course,
            ]);
        }
        return redirect()->route('courses.index')->banner('Course ID Not Found.');;
        
    }

    public function update(Request $request,$ID){
        $request->validate([
            'name'    => 'required|max:255',
            'price'   => 'required|integer|gt:0',
            'status'  => 'required|in:1,0',
        ]);

        $course = Course::findOrFail($ID);
        $course->update($request->all());
        return redirect()->route('courses.edit',$ID)->banner('Course Has Been Updated.');
    }

    public function destroy($ID){
        $course = Course::find($ID);
        if($course){
            $course->delete();
        }
        return redirect()->route('courses.index')->banner('Course Deleted Successfully.');
    }
}
