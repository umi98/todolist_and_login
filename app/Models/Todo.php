<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Todo extends Eloquent
{
    use HasFactory;

    protected $table = 'todo';

    protected $primary_key = '_id';

    protected $fillable = [
        'title',
        'description',
        'status'
    ];
}
