<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTaken extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'answer_option_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function answerOptions()
    {
        return $this->belongsTo(AnswerOption::class);
    }
}
