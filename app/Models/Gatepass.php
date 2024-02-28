<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentRegistration;

class Gatepass extends Model{
    use HasFactory;
    protected $fillable = ['student_id','class','receiving_time','receiver_name','contact_number','address','purpose'];

    public function student(){
        return $this->belongsTo(StudentRegistration::class);
    }
}
