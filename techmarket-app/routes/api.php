<?php 

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return [
        "message" => "welcome!!",
        "status" => true
    ];
});

Route::post("transfer", [TransactionController::class, "store"]);
