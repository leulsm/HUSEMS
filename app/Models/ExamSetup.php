<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_title',
        'exam_type',
        'duration_time',
        'status',
        'total_mark',
        'pass_mark',

    ];

    public function examCoordinator()
    {
        return $this->belongsTo(ExamCoordinator::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }
}
