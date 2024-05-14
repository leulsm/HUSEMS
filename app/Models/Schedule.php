<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedule';
    protected $fillable = [
        'starting_datetime',
        'ending_datetime',
        'exam_setup_id'
    ];

    public function examSetup()
    {
        return $this->belongsTo(ExamSetup::class);
    }
}
