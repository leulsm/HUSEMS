<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamCoordinator extends Model
{
    use HasFactory;
    protected $table = 'exam_coordinators';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function examSetups()
    {
        return $this->hasMany(ExamSetup::class);
    }
}
