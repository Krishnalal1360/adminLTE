<?php

// app/Mail/ContactNotificationMail.php
namespace App\Mail;

use App\Models\Admin\ContactNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public ContactNotification $notification;

    public function __construct(ContactNotification $notification)
    {
        $this->notification = $notification;
    }

    public function build()
    {
        return $this
            ->subject($this->notification->subject)
            ->view('admin.contact.contact_notification') // view path below
            ->with(['notification' => $this->notification]);
    }
}
