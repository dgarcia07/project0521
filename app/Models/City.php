<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
   use HasFactory, SoftDeletes;

   protected $fillable = [
      'cod',
      'name',
      'state'
   ];

   public function scopeCod($query, $cod)
   {
      if (trim($cod) != '') {
         $query->where('cod', 'like', "$cod%");
      }
   }

   public function scopeName($query, $name)
   {
      if (trim($name) != '') {
         $query->where('name', 'like', "%$name%");
      }
   }

   public function scopeState($query, $state)
   {
      if (trim($state) != '') {
         $query->where('state', $state);
      }
   }
}
