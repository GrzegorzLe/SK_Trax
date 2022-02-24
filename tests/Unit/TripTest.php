<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Car;
use App\Trip;
use App\User;

class TripTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->be(User::find(1), 'api');
    }
    /**
     * Test adding a trip
     *
     * @return array
     */
    public function testStore()
    {
        $car = Car::create(['make' => 'Seat', 'model' => 'Leon', 'year' => 2011]);
        $tripPayload = ['id' => 0, 'date' => Carbon::now()->format('Y-m-d'), 'miles' => 12.3,
            'car_id' => $car->id, 'car' => $car->toArray()];
        $response = $this->postJson('/api/trips', Arr::only($tripPayload, ['date', 'miles', 'car_id']));
        $tripPayload['id'] = $response->getData()->id;
        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson(Arr::only($tripPayload, ['date', 'miles', 'car_id']));

        return $tripPayload;
    }
    /**
     * Test getting a trip
     *
     * @depends testStore
     * @return array
     */
    public function testShow($tripPayload)
    {
      $this->getJson('/api/trips/' . $tripPayload['id'])
          ->assertStatus(Response::HTTP_OK)
          ->assertJson(['data' => Arr::only($tripPayload, ['date', 'miles', 'car'])]);
      return $tripPayload;
    }
    /**
     * Test updating a trip
     *
     * @depends testShow
     * @return array
     */
    public function testUpdate($tripPayload)
    {
        $tripPayload['date'] = Carbon::now()->subDays(2)->format('Y-m-d');
        $tripPayload['miles'] = 23.4;
        $this->putJson('/api/trips/' . $tripPayload['id'], Arr::only($tripPayload, ['date', 'miles', 'car_id']))
            ->assertStatus(Response::HTTP_OK)
            ->assertJson(Arr::only($tripPayload, ['date', 'miles', 'car_id']));
        return $tripPayload;
    }
    /**
     * Test getting updated trip
     *
     * @depends testUpdate
     * @return array
     */
    public function testShowAfterUpdate($tripPayload)
    {
      $this->getJson('/api/trips/' . $tripPayload['id'])
          ->assertStatus(Response::HTTP_OK)
          ->assertJson(['data' => Arr::only($tripPayload, ['date', 'miles', 'car'])]);
      return $tripPayload;
    }
    /**
     * Test deleting a trip
     *
     * @depends testShowAfterUpdate
     * @return void
     */
    public function testDestroy($tripPayload)
    {
        $this->json('delete', '/api/trips/' . $tripPayload['id'])
            ->assertStatus(Response::HTTP_OK);
        $this->assertEmpty(Trip::find($tripPayload['id']));
        Car::find($tripPayload['car_id'])->delete();
    }
}
