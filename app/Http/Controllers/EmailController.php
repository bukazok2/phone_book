<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function add_new_email(Request $request)
    {
        $validatedData = $request->validate([
            'person_id' => 'required',
            'email' => 'required|string|email|unique:emails,email',
        ]);

        $email = Email::create([
            'person_id' => $validatedData['person_id'],
            'email' => $validatedData['email'],
        ]);

        return response()->json([
            'message' => 'Email added successfully',
            'email' => $email,
        ], 201);
    }

}
