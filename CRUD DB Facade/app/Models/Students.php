<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Students extends Authenticatable
{
    protected $table = 'students';

    protected $fillable = [
        'lname',
        'fname',
        'Mname',
        'username',
        'email',
        'age',
        'dob',
        'gender',
        'password',
        'timestamps'
    ];
}
