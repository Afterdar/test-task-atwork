<?php

declare(strict_types=1);

namespace App\Services\Comments\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'company_id',
        'content',
        'rating',
    ];
}
