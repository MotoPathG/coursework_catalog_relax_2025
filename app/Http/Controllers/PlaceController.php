<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\PlaceType;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::All();
        foreach($places as $value)
        {
            $value->types;
            $value->amenities;
            $value->images;
        }
        return view('place.list', [
            'places' => $places,
            'types' => PlaceType::All()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $place =  new Place;
        $place->name = $request->name;
        /*type*/
        $place->price_range = $request->price;
        $place->rating = $request->rating;
        $place->latitude = $request->latitude;
        $place->longitude = $request->longitude;
        $place->country = $request->country;
        $place->region = $request->region;
        $place->city = $request->city;
        $place->address = $request->address;
        $place->website = $request->website;
        $place->phone = $request->phone;
        $place->email = $request->email;
        $place->description = $request->description;
        $place->save();

        DB::table('place_type_relation')->insert(['place_id'=>$place->id, 'type_id'=>$request->type]);
        
        

        $image = new Image;
        $image->place_id = $place->id;
        $image->image_url = $request->image_url;
        $image->alt_text = $place->name;
        $image->is_main = true;

        $image->save();

        $place->types;
        $place->image = $request->image_url;
        return response()->json($place);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $place = Place::find($id);
       
        $place->types;
        $place->amenities;
        $place->images;
        
        return view('place.show', [
            'place' => $place,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
