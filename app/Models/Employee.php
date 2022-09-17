<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory;
    protected $fillable = ['name','email','password'];
    protected $hidden = ['password'];
    protected $guard = 'dashboard';

}
