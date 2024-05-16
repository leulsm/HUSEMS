<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheatReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_setup_id',
        'invigilator_id',
        'student_id',
        'description'

    ];

    public function invigilator()
    {
        return $this->belongsTo(Invigilator::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function examSetup()
    {
        return $this->belongsTo(ExamSetup::class);
    }
}
