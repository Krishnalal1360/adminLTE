<?php
/*
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\Admin\UserListFactory;

class UserListModel extends Model
{
    use HasFactory;

    protected $table = 'user_lists';

    protected $fillable = [
        'adminID', // FK to users table
        'name',
        'email',
        'password',
    ];

    /**
     * Optional: hide password when serializing
     */
    /*
    protected $hidden = [
        'password',
    ];

    /**
     * Cast attributes
     */
    /*
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Factory
     */
    /*
    public static function newFactory()
    {
        return UserListFactory::new();
    }

    /**
     * Relationship to admin (UserModel)
     */
    /*
    public function admin()
    {
        return $this->belongsTo(UserModel::class, 'adminID');
    }
}
*/