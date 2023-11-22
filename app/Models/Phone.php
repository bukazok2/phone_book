<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'person_id'
    ];

    public function addNewPhone(array $validatedData) : Phone|bool
    {
        $existingPhone = Phone::where('phone_number', $validatedData['phone_number'])
        ->where('person_id', $validatedData['person_id'])
        ->first();

        if (!$existingPhone) {
            $newPhone = new Phone($validatedData);
            $newPhone->save();

            return $newPhone;
        }

        return false;
    }
}
