<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function add_new_phone(Request $request)
    {
        $validatedData = $request->validate([
            'person_id' => 'required',
            'phone_number' => 'required|string|min:11|max:11',
        ]);

        $phone = new Phone();
        $result = $phone->firstOrCreate($validatedData);

        if ($result->wasRecentlyCreated) 
        {
            return response()->json([
                'message' => 'Phone number added successfully',
                'phone' => $result,
            ], 201);
        } 
        else 
        {
            return response()->json([
                'message' => 'Phone number already exists',
            ], 422);
        }
    }

    public function delete_phone(Request $request, $id)
    {
        $phone = Phone::find($id);

        if (!$phone) {
            return response()->json([
                'message' => 'Phone number not found',
            ], 404);
        }

        $phone->delete();

        return response()->json([
            'message' => 'Phone deleted successfully',
        ], 200);
    }

    public function edit_phone(Request $request, $id)
    {
        $validatedData = $request->validate([
            'person_id' => 'required',
            'phone_number' => 'required|string|min:11|max:11|unique:phones,phone_number,' . $id . ',id,person_id,' . $request->input('person_id'),
        ]);

        $phone = Phone::find($id);

        if (!$phone) {
            return response()->json([
                'message' => 'Phone number not found',
            ], 404);
        }

        $phone->update(['phone_number' => $validatedData['phone_number']]);

        return response()->json([
            'message' => 'Phone number updated successfully',
            'phone' => $phone,
        ], 200);
    }

}
