<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\NotificationEmail;
use Mail, Log, Exception;

class SendEmailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    public $tries = 3;
    public $backoff = 10; 


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $email = new NotificationEmail($this->details);
        // Mail::to($this->details['email'])->send($email);
        try {
            $email = new NotificationEmail($this->details);
            $success = Mail::to($this->details['email'])->send($email);
            if ($success) {
                Log::info('Email sent successfully to ' . $this->details['email']);
            }
        } catch (Exception $e) {
            Log::error('Failed to send email: ' . $e->getMessage());
            throw $e;
        }
    }

    public function failed(Exception $exception)
    {
        Log::error('Email sending failed: '.$exception->getMessage());
    }

}

