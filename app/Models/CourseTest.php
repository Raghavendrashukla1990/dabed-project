<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class CourseTest extends Model{
    use HasFactory;
    protected $fillable = ['course_id','test_name','total_marks'];

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
