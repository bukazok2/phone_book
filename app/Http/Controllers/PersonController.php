<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public function get_all_person()
    {
        $persons = Person::with('personalInfo')->orderby('id','DESC')->get();

        return response()->json([
            'persons' => $persons
        ]);
    }
}
