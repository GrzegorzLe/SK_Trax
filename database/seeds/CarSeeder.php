<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars')->insert([
            ['make' => 'Land Rover', 'model' => 'Range Rover Sport', 'year' => 2017, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['make' => 'Ford', 'model' => 'F150', 'year' => 2014, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['make' => 'Chevy', 'model' => 'Tahoe', 'year' => 2015, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['make' => 'Aston Martin', 'model' => 'Vanquish', 'year' => 2018, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['make' => 'Chevrolet', 'model' => 'C8 Corvette', 'year' => 2021, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['make' => 'Dodge', 'model' => 'Challanger', 'year' => 2019, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ]);
    }
}
