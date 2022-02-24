<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Response;
use App\Car;
use App\User;

class CarTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->be(User::find(1), 'api');
    }
    /**
     * Test adding a car
     *
     * @return array
     */
    public function testStore()
    {
        $carPayload = ['id' => 0, 'make' => 'Seat', 'model' => 'Leon', 'year' => 2011];
        $response = $this->postJson('/api/cars', $carPayload);
        $carPayload['id'] = $response->getData()->id;
        $response->assertStatus(Response::HTTP_CREATED)->assertJson($carPayload);

        return $carPayload;
    }
    /**
     * Test getting a car
     *
     * @depends testStore
     * @return array
     */
    public function testShow($carPayload)
    {
      $this->getJson('/api/cars/' . $carPayload['id'])
          ->assertStatus(Response::HTTP_OK)
          ->assertJson(['data' => $carPayload]);
      return $carPayload;
    }
    /**
     * Test updating a car
     *
     * @depends testShow
     * @return array
     */
    public function testUpdate($carPayload)
    {
        $carPayload['year'] = 2012;
        $carPayload['model'] = 'Leon Cupra';
        $this->putJson('/api/cars/' . $carPayload['id'], $carPayload)
            ->assertStatus(Response::HTTP_OK)
            ->assertJson($carPayload);
        return $carPayload;
    }
    /**
     * Test getting updated car
     *
     * @depends testUpdate
     * @return array
     */
    public function testShowAfterUpdate($carPayload)
    {
      $this->getJson('/api/cars/' . $carPayload['id'])
          ->assertStatus(Response::HTTP_OK)
          ->assertJson(['data' => $carPayload]);
      return $carPayload;
    }
    /**
     * Test deleting a car
     *
     * @depends testShowAfterUpdate
     * @return void
     */
    public function testDestroy($carPayload)
    {
        $this->json('delete', '/api/cars/' . $carPayload['id'])
            ->assertStatus(Response::HTTP_OK);
        $this->assertEmpty(Car::find($carPayload['id']));
    }
}
