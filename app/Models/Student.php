<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'exam_setup_id',
        'status'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function examSetup()
    {
        return $this->belongsToMany(ExamSetup::class);
    }

    public function cheatReports()
    {
        return $this->hasMany(CheatReport::class);
    }
}
