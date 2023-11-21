<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Email;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'attachment',
        'home_address',
        'mailing_address',
    ];

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}
