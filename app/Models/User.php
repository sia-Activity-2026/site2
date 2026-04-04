<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users2';

    protected $fillable = [
        'username',
        'password',
        'gender',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
    ];

    // protected $primaryKey = userid;

    // public $timestamps = false;

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
}
