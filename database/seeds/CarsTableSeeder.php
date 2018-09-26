<?php

use Illuminate\Database\Seeder;
use App\Cars;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car1 = new Cars;
        $car1->make = "Holden";
        $car1->model = "Commodore";
        $car1->year = 2018;
        $car1->seating = 4;
        $car1->rego = "ABC123";
        $car1->lat = -37.8083;
        $car1->lng = 144.9688;
        $car1->retired = false;
        $car1->save();
        
        $car2 = new Cars;
        $car2->make = "Ford";
        $car2->model = "Falcon";
        $car2->year = 2016;
        $car2->seating = 4;
        $car2->rego = "CBA321";
        $car2->lat = -37.8115;
        $car2->lng = 144.9646;
        $car2->retired = false;
        $car2->save();
    }
}
