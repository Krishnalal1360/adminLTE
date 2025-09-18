<?php

// app/Models/Admin/ContactNotification.php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'subject',
        'body',
        'status',
        'sent_at',
    ];

    public function contact()
    {
        return $this->belongsTo(ContactModel::class, 'contact_id');
    }
}
