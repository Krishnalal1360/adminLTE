<?php

// app/Jobs/SendCustomNotificationJob.php
namespace App\Jobs;

use App\Models\Admin\ContactNotification;
use App\Mail\ContactNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendCustomNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public ContactNotification $notification;

    // Optional: retry settings
    public $tries = 3;        // try up to 3 times
    public $backoff = 60;     // wait 60 seconds between attempts

    public function __construct(ContactNotification $notification)
    {
        $this->notification = $notification;
    }

    public function handle(): void
    {
        $contact = $this->notification->contact;

        if (! $contact || ! $contact->email) {
            $this->notification->update(['status' => 'failed']);
            return;
        }

        try {
            Mail::to($contact->email)->send(new ContactNotificationMail($this->notification));

            $this->notification->update([
                'status'  => 'sent',
                'sent_at' => now(),
            ]);

            Log::info("Custom notification sent to {$contact->email} (id: {$this->notification->id})");
        } catch (\Throwable $e) {
            // update status and log the error (job will be retried automatically up to $tries)
            $this->notification->update(['status' => 'failed']);
            Log::error("Failed to send notification id {$this->notification->id}: " . $e->getMessage());
            // rethrow to allow the job system to handle retries if desired:
            throw $e;
        }
    }
}
