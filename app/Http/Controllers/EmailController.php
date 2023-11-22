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

    public function delete_email(Request $request, $id)
    {
        $email = Email::find($id);

        if (!$email) {
            return response()->json([
                'message' => 'Email not found',
            ], 404);
        }

        $email->delete();

        return response()->json([
            'message' => 'Email deleted successfully',
        ], 200);
    }

    public function edit_email(Request $request, $id)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|unique:emails,email,' . $id,
        ]);

        $email = Email::find($id);

        if (!$email) {
            return response()->json([
                'message' => 'Email not found',
            ], 404);
        }

        $email->update(['email' => $validatedData['email']]);

        return response()->json([
            'message' => 'Email updated successfully',
            'email' => $email,
        ], 200);
    }

}
