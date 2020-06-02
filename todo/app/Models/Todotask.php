<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todotask extends Model
{
    protected $fillable = ['task', 'task_description', 'finished'];

    protected $casts = [
        'finished' => 'integer'
    ];
}
