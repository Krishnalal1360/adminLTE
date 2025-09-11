<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class ContactModel extends Model
{
    //
    use HasFactory, Notifiable;
    //
    protected $table = 'contact_models';
    //
    protected $fillable = [
        'name',
        'email',
        'password',
        'message',
    ];
    //
    protected $hidden = [
        //'password',
    ];
}
