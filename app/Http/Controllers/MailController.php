<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\NewMail;
use Mail;
use Illuminate\Support\Facades\Redis;

class MailController extends Controller
{
    public function mail()
    {
        Redis::throttle('key')->allow(3)->every(60)->then(function () {
            Mail::to('test@mail.com')->queue(new NewMail());
        }, function () {
            // Could not obtain lock...
        
            // return $this->release(3);
        });
    }
}
