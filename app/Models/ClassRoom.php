<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ClassRoom extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class)->withPivot('school_year');
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class)->withPivot('school_year');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function($model){
            $model->slug = Str::slug($model->name);
        });
        static::updating(function($model){
            if(is_null($model->slug))
                $model->slug = Str::slug($model->name);
        });
    }
}
