<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Punishment extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'student_id', 'sanction_id', 'canceled', 'signature', 'school_year'];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
    public function sanction(): BelongsTo
    {
        return $this->belongsTo(Sanction::class);
    }

}
