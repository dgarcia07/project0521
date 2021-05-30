<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Auth, Mail;
use App\Mail\Welcome;
use App\Mail\WelcomeAndSetPassword;

class UserObserver
{
   public function created(User $user)
   {
      try {
         $email = $user->email;
         if (Auth::check()) {
            Mail::to($email)->queue(new WelcomeAndSetPassword($user));
         }else{
            Mail::to($email)->queue(new Welcome($user));
         }
      } catch (\Exception $e) {
         Log::debug($e);
      }
   }

   public function updated(User $user)
   {
      //
   }

   public function deleted(User $user)
   {
      //
   }

   public function restored(User $user)
   {
      //
   }

   public function forceDeleted(User $user)
   {
      //
   }
}
