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

    public function add_new_person(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'home_address' => 'nullable|string',
            'mailing_address' => 'nullable|string',
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachmentIdPath = $file->store('attachments', 'public');
            $validatedData['attachment'] = $attachmentIdPath;
        }

        if ($request->has('fillMailingAddress') && $validatedData['home_address']) {
            $validatedData['mailing_address'] = $validatedData['home_address'];
        }

        $person = Person::create($validatedData);

        return response()->json([
            'message' => 'Person added successfully',
            'person' => $person,
        ], 201);
    }
}
