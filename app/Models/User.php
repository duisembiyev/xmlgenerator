<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'full_name',
        'name',
        'login',
        'password',
        'phone_number',
        'avatar',
    ];

    protected $hidden = [
        'password',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'login', 'login');
    }
}
