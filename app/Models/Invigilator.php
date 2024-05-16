<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invigilator extends Model
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
        return $this->belongsTo(ExamSetup::class);
    }

    public function examPrePass()
    {
        return $this->hasOne(ExamPrePass::class);
    }

    public function cheatReports()
    {
        return $this->hasMany(CheatReport::class);
    }
}
