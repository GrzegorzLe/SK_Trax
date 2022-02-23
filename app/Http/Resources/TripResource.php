<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CarResource;
use App\Car;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [ 
            'id' => $this->id,
            'date' => $this->date,
            'miles' => $this->miles,
            'total' => $this->total,
            'car' => new CarResource(Car::findOrFail($this->car_id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
