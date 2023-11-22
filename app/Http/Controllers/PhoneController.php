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
        $result = $phone->addNewPhone($validatedData);

        if ($result !== false) 
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
}
