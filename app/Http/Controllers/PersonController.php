<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public function delete_person($id)
    {
        $person = Person::find($id);

        if (!$person) {
            return response()->json([
                'message' => 'Phone number not found',
            ], 404);
        }

        $person->delete();

        return response()->json([
            'message' => 'Phone deleted successfully',
        ], 200);
    }

    public function get_person_with_info($id)
    {
        $person = Person::with('emails')->with('phones')->find($id);

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

    public function edit_person(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'home_address' => 'nullable|string',
            'mailing_address' => 'nullable|string',
        ]);

        $person = Person::find($id);

        if (!$person) {
            return response()->json([
                'message' => 'Person not found',
            ], 404);
        }

        $person->name = $validatedData['name'];

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachmentIdPath = $file->store('attachments', 'public');
            $person->attachment = $attachmentIdPath;
        }

        $person->home_address = $validatedData['home_address'];

        if ($request->has('fillMailingAddress') && $validatedData['home_address']) {
            $person->mailing_address = $validatedData['home_address'];
        } else {
            $person->mailing_address = $validatedData['mailing_address'];
        }

        $person->save();

        return response()->json([
            'message' => 'Person updated successfully',
            'person' => $person,
        ], 200);
    }

}
