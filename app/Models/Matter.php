<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code'];

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class);
    }
}
