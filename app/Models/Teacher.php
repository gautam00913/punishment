<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Model
{
    use HasFactory;
    
    protected $fillable = ['grade', 'matter_id', 'is_principal', 'principal_at'];

    public function administration(): BelongsTo
    {
        return $this->belongsTo(Administration::class);
    }

    public function matter(): BelongsTo
    {
        return $this->belongsTo(Matter::class);
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

    public function getGuardedClassesAttribute(): string
    {
        $classes = $this->classes();
        $data = '';
        foreach($classes->get() as $key => $classe)
        {
            $data .= $classe->name;
            if($classes->count() != $key +1)
                $data .= ', ';
        }

        return $data;
    }
}
