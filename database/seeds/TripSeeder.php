<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TripSeeder extends Seeder
{
    public $tripCount = 6;
    public $totalMiles = 55;
    public $carStats = [['tripCount' => 2, 'totalMiles' => 18.1],
        ['tripCount' => 1, 'totalMiles' => 5],['tripCount' => 1, 'totalMiles' => 10.3],
        ['tripCount' => 1, 'totalMiles' => 12]];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trips')->insert([
            ['date' => Carbon::now()->subDays(1)->format('Y/m/d'), 'miles' => '11.3', 'car_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['date' => Carbon::now()->subDays(2)->format('Y/m/d'), 'miles' => '12.0', 'car_id' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['date' => Carbon::now()->subDays(3)->format('Y/m/d'), 'miles' => '6.8', 'car_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['date' => Carbon::now()->subDays(4)->format('Y/m/d'), 'miles' => '5', 'car_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['date' => Carbon::now()->subDays(5)->format('Y/m/d'), 'miles' => '10.3', 'car_id' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['date' => Carbon::now()->subDays(6)->format('Y/m/d'), 'miles' => '9.6', 'car_id' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
