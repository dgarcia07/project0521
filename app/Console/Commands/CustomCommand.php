<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\City;

class CustomCommand extends Command
{
   /**
   * The name and signature of the console command.
   *
   * @var string
   */
   protected $signature = 'start:project';

   /**
   * The console command description.
   *
   * @var string
   */
   protected $description = 'Genera un registro de las principales ciudades del pais';

   /**
   * Create a new command instance.
   *
   * @return void
   */
   public function __construct()
   {
      parent::__construct();
   }

   /**
   * Execute the console command.
   *
   * @return int
   */
   public function handle()
   {
      $cities = array (
         array('cod' => '11001', 'name' => 'Bogotá'),
         array('cod' => '05001', 'name' => 'Medellín'),
         array('cod' => '76001', 'name' => 'Cali'),
         array('cod' => '08001', 'name' => 'Barranquilla'),
         array('cod' => '13001', 'name' => 'Cartagena'),
         array('cod' => '47001', 'name' => 'Santa Marta'),
         array('cod' => '68669', 'name' => 'San Andres y providencia'),
         array('cod' => '68001', 'name' => 'Bucaramanga'),
         array('cod' => '41001', 'name' => 'Neiva'),
         array('cod' => '54000', 'name' => 'Cucuta')
      );

      foreach ($cities as $key => $city) {
         echo "[" . $city['name'] . "] \n";
         City::create([
            'cod' => $city['cod'],
            'name' => $city['name'],
            'state' => 1
         ]);
      }
   }
}
