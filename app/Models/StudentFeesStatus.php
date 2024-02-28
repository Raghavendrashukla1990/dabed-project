<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\StudentRegistration;

class StudentFeesStatus extends Model{
    use HasFactory;
    protected $table    = 'student_fees_status';
    protected $fillable = ['course_id','student_id','installment','paid','balance','paid_date','next_installment_due_date'];

    public function course(){
        return $this->hasOne(Course::class,'id','course_id');
    }

    public function student(){
        return $this->hasOne(StudentRegistration::class,'id','student_id');
    }
}
