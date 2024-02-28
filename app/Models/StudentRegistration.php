<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class StudentRegistration extends Model{
    use HasFactory;
    protected $fillable = ['name','email','dob','phone_number','school','father_name','password','course_id']; 

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
