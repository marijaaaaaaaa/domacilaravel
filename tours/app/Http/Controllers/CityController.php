<?php

namespace App\Http\Controllers;

use App\Http\Resources\City\CityCollection;
use App\Http\Resources\City\CityResource;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return response()->json(new CityCollection($cities));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:cities',
            'founded' => 'required|integer|between:0,2023',
            'country_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $country = Country::find($request->country_id);
        if (is_null($country)) {
            return response()->json('Country not found', 404);
        }

        $city = City::create([
            'name' => $request->name,
            'founded' => $request->founded,
            'country_id' => $request->country_id
        ]);

        return response()->json([
            'City inserted' => new CityResource($city)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($city_id)
    {
        $city = City::find($city_id);
        if (is_null($city)) {
            return response()->json('City not found', 404);
        }
        return response()->json(new CityResource($city));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'founded' => 'required|integer|between:0,2023',
            'country_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $country = Country::find($request->country_id);
        if (is_null($country)) {
            return response()->json('Country not found', 404);
        }

        $city->name = $request->name;
        $city->founded = $request->founded;
        $city->country_id = $request->country_id;

        $city->save();

        return response()->json([
            'City updated' => new CityResource($city)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();

        return response()->json('City deleted');
    }
}
