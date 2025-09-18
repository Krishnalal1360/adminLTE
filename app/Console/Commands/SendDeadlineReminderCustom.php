<?php

// app/Console/Commands/SendDeadlineReminderCustom.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin\ContactModel;
use App\Models\Admin\ContactNotification;
use App\Jobs\SendCustomNotificationJob;

class SendDeadlineReminderCustom extends Command
{
    protected $signature = 'contacts:reminders-custom';
    protected $description = 'Send deadline reminders using custom notifications table';

    public function handle()
    {
        // find contacts whose deadline is today
        $contacts = ContactModel::whereDate('deadline', now()->toDateString())->get();

        if ($contacts->isEmpty()) {
            $this->info('No contacts with deadline today.');
            return 0;
        }

        foreach ($contacts as $contact) {
            // Avoid duplicates: skip if we already logged a reminder for this contact today
            $already = ContactNotification::where('contact_id', $contact->id)
                ->whereDate('created_at', now()->toDateString())
                ->where('subject', 'Deadline Reminder')
                ->exists();

            if ($already) {
                $this->info("Skipping {$contact->email} — already notified today.");
                continue;
            }

            // Insert pending notification record
            $notification = ContactNotification::create([
                'contact_id' => $contact->id,
                'subject'    => 'Deadline Reminder',
                'body'       => "Hello {$contact->name}, your deadline is today ({$contact->deadline}).",
                'status'     => 'pending',
            ]);

            // Dispatch queued job to send email
            SendCustomNotificationJob::dispatch($notification);

            $this->info("Queued notification for {$contact->email} (notification id: {$notification->id})");
        }

        return 0;
    }
}
