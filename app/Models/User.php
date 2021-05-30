<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'password',
        'state',
        'confirmation_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeName($query, $name)
   {
      if (trim($name) != '') {
         $query->where('name', 'like', "%$name%");
      }
   }

   public function scopeEmail($query, $email)
   {
      if (trim($email) != '') {
         $query->where('email', 'like', "%$email%");
      }
   }

   public function scopeState($query, $state)
   {
      if (trim($state) != '') {
         $query->where('state', $state);
      }
   }
}
