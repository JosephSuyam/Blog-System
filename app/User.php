<?php

// namespace App;

// use Illuminate\Database\Eloquent\Model;

// class User extends Model
// {
//     protected $fillable = [
//     	'name', 'email', 'password', 'usertype', 'access', 'avatar', 'provider_id', 'provider', 'access_token'
// 	];

// 	protected $hidden = [
//         'password', 'remember_token',
//     ];
// }

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'usertype', 'access', 'avatar', 'provider_id', 'provider', 'access_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
