<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sanction extends Model
{
    use HasFactory;

    protected $fillable = ['type'];
    public $timestamps = false;

    public function punishments(): HasMany
    {
        return $this->hasMany(Punishment::class);
    }
}
