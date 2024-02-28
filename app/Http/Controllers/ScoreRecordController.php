<?php

namespace App\Http\Controllers;

use App\Models\StudentRegistration;
use App\Models\ScoreRecord;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScoreRecordController extends Controller{
    
    public function index(){
        $score_record = ScoreRecord::with('student:id,name')->paginate(10);
        return Inertia::render('ScoreRecord/Index',['score_record' => $score_record]);
    }

    public function create(){
        $students = StudentRegistration::select('id','name')->get();
        return Inertia::render('ScoreRecord/Form',['students' => $students]);
    }

    public function store(Request $request){
        $request->validate([
            'student_id'    => 'required',
            'test_name'     => 'required',
            'scored_marks'  => 'required',
            'total_marks'   => 'required',
            'rank'          => 'required',
        ]);
        ScoreRecord::create($request->all());
        return redirect()->route('scored.record.create')->banner('New Student Scored Added.');
    }

    public function edit($ID){
        $students       = StudentRegistration::select('id','name')->get();
        $score_record   = ScoreRecord::where('id',$ID)->first();
        return Inertia::render('ScoreRecord/Form',[
            'students'     => $students,
            'score_record' => $score_record
        ]);
    }

    public function update(Request $request, $ID){
        $request->validate([
            'student_id'    => 'required',
            'test_name'     => 'required',
            'scored_marks'  => 'required',
            'total_marks'   => 'required',
            'rank'          => 'required',
        ]);
        ScoreRecord::findOrFail($ID)->update($request->all());
        return redirect()->route('scored.record.create')->banner('Student Scored Updated.');
    }

    public function destroy($ID){
        $student_fee     = ScoreRecord::where('id',$ID)->first();
        if($student_fee){
            $student_fee->delete();
        }
        return redirect()->route('scored.record.create')->banner('Student Scored Deleted.');
    }
}
