<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeAndSetPassword extends Mailable
{
   use Queueable, SerializesModels;

   protected $info;
   public function __construct($data)
   {
      $this->info = $data;
   }

   public function build()
   {
      return $this->view('mail.userRegistration', ['info' => $this->info]);
   }
}
