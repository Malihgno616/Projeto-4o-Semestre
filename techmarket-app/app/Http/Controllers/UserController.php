<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function allUsers()
    {
        $users = User::all();
        return response()->json([
            'message' => 'Users retrieved successfully',
            'data' => $users
        ], 200);
    }

    public function selectUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);    
        }

        return response()->json([
            'message' => 'User retrieved successfully',
            'data' => $user
        ], 200);
    }

    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:11|unique:users,cpf',
            'phone_number' => 'required|string|max:20',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'cpf' => $validatedData['cpf'],
            'phone_number' => $validatedData['phone_number'] ?? null,
            'birthdate' => $validatedData['date'] ?? null,
            'amount' => $validatedData['amount'] ?? 0,
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'data' => $user
        ], 201);

    }

    public function updateAmount(Request $request)
    {
        $validatedData = $request->validate([
            'cpf' => 'required|string|exists:users,cpf',
            'amount' => 'required|numeric',
        ]);
        
        $user = User::where('cpf', $validatedData['cpf'])->first();
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);    
        }

        $user->amount += $validatedData['amount'];

        $user->save();

        return response()->json([
            'message' => 'User amount updated successfully',
            'data' => $user
        ], 200);

    }

}
