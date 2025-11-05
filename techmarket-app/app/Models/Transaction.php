<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        // Add fillable attributes here
        "from_account_id",
        "to_account_id",
        "amount",
        "code",
        "status"
    ];
}
