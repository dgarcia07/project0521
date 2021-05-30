<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
   public function up()
   {
      Schema::create('cities', function (Blueprint $table) {
         $table->id();
         $table->bigInteger('cod');
         $table->string('name');
         $table->integer('state')->default(1);
         $table->softDeletes();
         $table->timestamps();
      });
   }

   public function down()
   {
      Schema::dropIfExists('cities');
   }
}
