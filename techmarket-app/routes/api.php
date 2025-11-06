<?php 

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Transaction;

Route::get('/', function() {
    return [
        "message" => "welcome!!",
        "status" => true
    ];
});

// Rotas para UserController
Route::get("/users", [UserController::class, "allUsers"]);
Route::post("/create-user", [UserController::class, "createUser"]);
Route::put("/update-amount", [UserController::class, "updateAmount"]);

// Rotas para TransactionController
Route::post("/transfer", [TransactionController::class, "transfer"]);
Route::get("/transactions", function(){
    return Transaction::orderBy('amount', 'desc')->take(10)->where('amount', '>=', 5000)->get();
});