<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_text',
        'question_type',
        'mark',
        'exam_setup_id'
    ];

    public function examSetup()
    {
        return $this->belongsTo(ExamSetup::class);
    }
    public function answerOptions()
    {
        return $this->hasMany(AnswerOption::class);
    }
}
