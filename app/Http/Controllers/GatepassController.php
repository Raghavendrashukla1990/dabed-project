<?php

namespace App\Http\Controllers;

use App\Models\StudentRegistration;
use App\Models\Gatepass;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GatepassController extends Controller{
    
    public function index(){
        $gate_pass = Gatepass::with('student:id,name')->paginate(10);
        return Inertia::render('GatePass/Index',['gate_pass' => $gate_pass]);
    }

    public function create(){
        $students = StudentRegistration::select('id','name')->get();
        return Inertia::render('GatePass/Form',['students' => $students]);
    }

    public function store(Request $request){
        $request->validate([
            'student_id'        => 'required',
            'class'             => 'required',
            'receiving_time'    => 'required',
            'receiver_name'     => 'required',
            'contact_number'    => 'required',
            'address'           => 'required',
            'purpose'           => 'required',
        ]);
        Gatepass::create($request->all());
        return redirect()->route('gate.pass.create')->banner('New Student Gate Pass Added.');
    }

    public function edit($ID){
        $students       = StudentRegistration::select('id','name')->get();
        $gate_pass      = Gatepass::where('id',$ID)->first();
        return Inertia::render('GatePass/Form',[
            'students'    => $students,
            'gate_pass'   => $gate_pass
        ]);
    }

    public function update(Request $request, $ID){
        $request->validate([
            'student_id'        => 'required',
            'class'             => 'required',
            'receiving_time'    => 'required',
            'receiver_name'     => 'required',
            'contact_number'    => 'required',
            'address'           => 'required',
            'purpose'           => 'required',
        ]);
        Gatepass::findOrFail($ID)->update($request->all());
        return redirect()->route('gate.pass.create')->banner('Student Gate Pass Updated.');
    }

    public function destroy($ID){
        $gate_pass     = Gatepass::where('id',$ID)->first();
        if($gate_pass){
            $gate_pass->delete();
        }
        return redirect()->route('gate.pass.create')->banner('Student Gate Pass Deleted.');
    }
}
