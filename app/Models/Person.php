<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'attachment',
        'home_address',
        'mailing_address',
    ];

    public function personalInfo()
    {
        return $this->hasMany(PersonalInfo::class);
    }
}
