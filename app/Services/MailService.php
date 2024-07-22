<?php

namespace App\Services;

use App\Mail\GenericMail;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public static function sendMail($to, $subject, $view, $data)
    {
        Mail::to($to)->send(new GenericMail($subject, $view, $data));
    }
}