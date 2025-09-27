<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TuVungCon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'note',
        'state',
    ];
}
