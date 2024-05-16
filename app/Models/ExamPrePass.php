<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPrePass extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_setup_id',
        'invigilator_id',
        'exam_password',

    ];

    public function invigilator()
    {
        return $this->belongsTo(Invigilator::class);
    }
}
