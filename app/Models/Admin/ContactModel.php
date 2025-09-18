<?php

// app/Models/Admin/ContactModel.php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = ['name','email','phone','message','deadline'];

    public function customNotifications()
    {
        return $this->hasMany(ContactNotification::class, 'contact_id');
    }
}

