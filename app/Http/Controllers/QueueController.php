<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailNotification;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function triggerNotification() {
        $details = [
            'email' => 'ahamed.saif2527@gmail.com',
            'message' => 'This is a test email.'
        ];
    
        $res = SendEmailNotification::dispatch($details);

        if ($res) {
            return 'JOB dispatched!';
        } else {
            return 'Oops.., Something went wrong..!';
        }
    
    }
}
