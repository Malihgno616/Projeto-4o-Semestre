<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'phone_number',
        'birthdate',
        'amount',
    ];
}

// no tinker do laravel no terminal: App\Models\User::create(['name' => 'Bob', 'amount' => 100]);
