<?php

namespace App\Http\Controllers;

use App\Http\Resources\Attraction\AttractionCollection;
use App\Http\Resources\Attraction\AttractionResource;
use App\Models\Attraction;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttractionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attractions = Attraction::all();
        return response()->json(new AttractionCollection($attractions));
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
            'name' =>  'required|string|max:255',
            'type' =>  'required|string|max:255',
            'city_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $city = City::find($request->city_id);
        if (is_null($city)) {
            return response()->json('City not found', 404);
        }

        $attraction = Attraction::create([
            'name' => $request->name,
            'type' => $request->type,
            'city_id' => $request->city_id,
        ]);

        return response()->json([
            'Attraction created' => new AttractionResource($attraction)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function show($attraction_id)
    {
        $attraction = Attraction::find($attraction_id);
        if (is_null($attraction)) {
            return response()->json('Attraction not found', 404);
        }
        return response()->json(new AttractionResource($attraction));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function edit(Attraction $attraction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attraction $attraction)
    {
        $validator = Validator::make($request->all(), [
            'name' =>  'required|string|max:255',
            'type' =>  'required|string|max:255',
            'city_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $city = City::find($request->city_id);
        if (is_null($city)) {
            return response()->json('City not found', 404);
        }

        $attraction->name = $request->name;
        $attraction->type = $request->type;
        $attraction->city_id = $request->city_id;

        $attraction->save();

        return response()->json([
            'Attraction updated' => new AttractionResource($attraction)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attraction $attraction)
    {
        $attraction->save();

        return response()->json('Attraction deleted');
    }
}
