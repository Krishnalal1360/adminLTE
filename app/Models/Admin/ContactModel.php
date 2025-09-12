<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class ContactModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'contacts'; // make sure migration uses this table

    protected $fillable = [
        'name',
        'email',
        'phone',   // add this if you have phone column
        'message',
    ];
}
