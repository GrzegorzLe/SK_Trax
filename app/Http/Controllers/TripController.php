<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Resources\TripResource;
use App\Http\Resources\TripCollection;
use App\Trip;

class TripController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tripCollection = TripResource::collection(Trip::all());
        $total = 0;
        foreach ($tripCollection as &$myTrip)
        {
            $total = bcadd($total, $myTrip->miles, 2);
            $myTrip->total = $total;
        }
        return $tripCollection;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'date',
            'miles' => 'required|numeric',
            'car_id' => 'required|exists:cars,id'
        ]);

        // TODO: Find more seemless way to format date from form
        $trip = Trip::create(['date' => Str::limit($request->get('date'), 10),
                     'miles' => $request->get('miles'), 'car_id' => $request->get('car_id')]);

        return $trip;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new TripResource(Trip::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'date',
            'miles' => 'required|numeric',
            'car_id' => 'required|exists:cars,id'
        ]);

        $trip = Trip::findOrFail($id);
        $trip->date = $request->get('date');
        $trip->miles = $request->get('miles');
        $trip->car_id = $request->get('car_id');
        $trip->save();

        return $trip;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();

        return;
    }
}
