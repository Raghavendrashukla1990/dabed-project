<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseTest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseTestController extends Controller{
    
    public function index(){
        $course_test = CourseTest::with('course:id,name')->paginate(10);
        return Inertia::render('CourseTest/Index',[
            'course_test' => $course_test
        ]);
    }

    public function create(){
        $course = Course::all();
        return Inertia::render('CourseTest/Form',[
            "course" => $course
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'course_id'     => 'required',
            'test_name'     => 'required|max:255',
            'total_marks'   => 'required|integer|gt:0',
        ]);
        CourseTest::create($request->all());
        return redirect()->route('course.test.create')->banner('New Course Test Has Been Enrolled.');
    }

    public function edit($id){
        $course = CourseTest::where('id',$id)->first();
        if($course){
            return Inertia::render('Courses/Form',[
                'course'=>$course,
            ]);
        }
        return redirect()->route('courses.index')->banner('Course ID Not Found.');;
        
    }

    public function update(Request $request,$id){
        $request->validate([
            'name'    => 'required|max:255',
            'price'   => 'required|integer|gt:0',
        ]);

        $course = Course::findOrFail($id);
        $course->update($request->all());
        return redirect()->route('courses.edit',$id)->banner('Course Has Been Updated.');
    }

    public function destroy($id){
        $course = Course::find($id);
        if($course){
            $course->delete();
        }
        return redirect()->route('courses.index')->banner('Course Deleted Successfully.');
    }
}
