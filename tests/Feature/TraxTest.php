<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Database\Seeders\CarSeeder;
use Database\Seeders\TripSeeder;
use App\User;

class TraxTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->be(User::find(1), 'api');
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCarIndex()
    {
        $this->getJson('/api/cars')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data' => ['*' => ['id','make','model','year','created_at','updated_at']]])
            ->assertJsonCount(6, 'data');
    }

    public function testTripIndex()
    {
        $this->getJson('/api/trips')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data' => ['*' => ['id','date','miles','car'
                => ['id','make','model','year','created_at','updated_at'],'created_at','updated_at']]])
            ->assertJsonCount(6, 'data');
//            ->first()->assertJson(['total' => 55.0]);
    }
}
