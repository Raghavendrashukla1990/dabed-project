<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentRegistration;

class ScoreRecord extends Model{
    use HasFactory;
    protected $fillable = ['student_id','test_name','scored_marks','total_marks','rank'];

    public function student(){
        return $this->belongsTo(StudentRegistration::class);
    }
}
