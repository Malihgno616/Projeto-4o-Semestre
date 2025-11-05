<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transfer(Request $request)
    {
        $validated = $request->validate([
            'from_account_id' => 'required|exists:users,id',
            'to_account_id'   => 'required|exists:users,id|different:from_account_id',
            'amount'          => 'required|numeric|min:0.01',
        ]);

        if(empty($validated)) {
            return response()->json([
                'message' => 'Invalid data provided.',
                'status' => false
            ], 400);
        }
        
    }
}
