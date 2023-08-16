<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['tutor_id'];

    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class);
    }

    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(ClassRoom::class)->withPivot('school_year');
    }

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function punishments(): HasMany
    {
        return $this->hasMany(Punishment::class);
    }

    public function getCurrentClassAttribute()
    {
        return $this->level()->id ?? 0;
    }

    public function getCurrentLevelAttribute()
    {
        return $this->level()->name ?? '';
    }

    public function level()
    {
        return $this->classes()->wherePivot('school_year', config('app.school_year'))->get()->last();
    }
}
