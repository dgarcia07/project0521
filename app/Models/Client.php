<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
   use HasFactory, SoftDeletes;

   protected $fillable = [
      'cod',
      'name',
      'city',
      'state'
   ];

   public function getCity()
   {
      return $this->belongsTo('App\Models\City', 'city');
   }

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

   public function scopeCity($query, $city)
   {
      if (trim($city) != '') {
         $query->whereHas('getCity', function($q) use($city) {
            $q->where('id', $city);
         });
      }
   }

   public function scopeState($query, $state)
   {
      if (trim($state) != '') {
         $query->where('state', $state);
      }
   }
}
