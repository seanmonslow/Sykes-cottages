<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $request->validate([
            'type' => 'integer|nullable',
            'name' => 'string|nullable',
            'beach' => 'integer|nullable',
            'pets' => 'integer|nullable',
            'sleeps' => 'integer|nullable',
            'beds' => 'integer|nullable',
            'date' => 'date|nullable'
        ]);

        $properties = Property::query();

        if($request->has('name')){

            if($request->query('name') != ""){

                if($request->query('type') == '1'){

                    $properties->where('property_name', $request->query('name'));

                } else if($request->query('type') == '2'){

                    $properties->where('property_name', 'like', '%'.$request->query('name').'%');

                }

            }

        }

        if($request->has('beach')){
            if($request->query('beach') == '2'){

                $properties->where('near_beach', 1);

            } else if($request->query('beach') == '1'){

                $properties->where('near_beach', 0);

            }
        }

        if($request->has('pets')){

            if($request->query('pets') == '2'){

                $properties->where('accepts_pets', 1);

            } else if($request->query('pets') == '1'){

                $properties->where('accepts_pets', 0);

            }

        }

        if(intval($request->query('sleeps')) > 0){

            $properties->where('sleeps', '>=', $request->query('sleeps'));

        }

        if(intval($request->query('beds')) > 0){

            $properties->where('beds', '>=', $request->query('beds'));

        }

        if($request->has('date')){

            if($request->query('date') != ""){

                $date = $request->query('date');

                $properties->whereHas('bookings', function (Builder $query) use ($date){
                    $query->where('start_date', '<=', $date)->where('end_date', '>=', $date);
                }, '=', 0);

            }
        }

        $properties = $properties->paginate(2);

        if($request->has('date')){

            if($request->query('date') != ""){

                foreach($properties AS $property){
                    $property->calculatePrice($request->query('date'));
                }

            }

        }

        return view('home', ["properties" => $properties->appends(request()->query())]);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        //
    }
}
