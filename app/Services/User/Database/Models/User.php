<?php

declare(strict_types=1);

namespace App\Services\User\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'surname',
        'password',
        'phone',
        'avatar',
    ];


    protected $hidden = [
        'password'
    ];
}
