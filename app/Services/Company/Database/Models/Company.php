<?php

declare(strict_types=1);

namespace App\Services\Company\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'content',
        'logo',
    ];
}
