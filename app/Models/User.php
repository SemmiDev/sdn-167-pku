<?php

namespace App\Models;

use App\Models\Base\User as BaseUser;
use Illuminate\Auth\Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends BaseUser
{
    use HasRoles, Authenticatable;

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'password',
		'remember_token'
	];
}
