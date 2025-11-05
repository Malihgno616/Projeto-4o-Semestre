<?php 

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Models\Transaction;

Route::get('/', function() {
    return [
        "message" => "welcome!!",
        "status" => true
    ];
});

Route::post("/transfer", [TransactionController::class, "transfer"]);

Route::get("/transactions", function(){
    return Transaction::orderBy('amount', 'desc')->take(8)->get();
});