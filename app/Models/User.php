<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users2';

    protected $fillable = [
        'username',
        'password',
        'gender'
    ];

    protected $hidden = [
        'password',
    ];

    // protected $primaryKey = userid;

    public $timestamps = false;
}
