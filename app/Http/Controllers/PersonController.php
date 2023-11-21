<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public function get_person_with_info($id)
    {
        $person = Person::with('personalInfo')->find($id);

        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }

        return response()->json([
            'person' => $person
        ]);
    }

    public function get_all_person()
    {
        $persons = Person::all();

        return response()->json([
            'persons' => $persons
        ]);
    }
}
