<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Database\Factories\Admin\UserFactory;

class UserModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Table name
    protected $table = 'users';

    // Mass assignable fields
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',       // 1 => Admin, 2 => User
        'image',      // store file path for profile image
    ];

    // Hidden fields in serialization
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Attribute casting
    protected $casts = [
        'email_verified_at' => 'datetime',
        // Laravel 12: do not cast password as hashed automatically
    ];

    // Factory
    public static function newFactory()
    {
        return UserFactory::new();
    }

    // Optional: Relationship to blogs
    /*
    public function blog()
    {
        return $this->hasOne(BlogModel::class, 'uid', 'id');
    }
    */
}
