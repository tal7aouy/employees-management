<?php

namespace App\Http\Controllers;

use App\Models\City;
use Inertia\Inertia;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = City::with('state')->get();
        if($request->has('search') && !empty($request->search)){
            $cities = City::where('name','like',"%{$request->search}%")->with('state')->get();
        }
        return Inertia::render('Cities/Index',
        [
            'cities'=> $cities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Cities/Create',
        [
            'states'=> State::all()
        ]);
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
           'name'=> ['required','string'],
           'state_id'=> ['required','numeric']
       ]);
       City::create($request->all());
       return Redirect::route('cities.index')->with(['toast'=>['message'=>'City created']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $city = City::where('id','=',$id)->first();
        return Inertia::render('Cities/Edit',
        [
            'states'=> State::all(),
            'city'=> $city
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
           'name'=> ['required','string'],
           'state_id'=> ['required','numeric']
       ]);
       $city = City::where('id','=',$id)->first();
       $city->update($request->all());
       return Redirect::route('cities.index')->with(['toast'=>['message'=>'City updated']]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $city = City::where('id','=',$id)->first();
        if($city){
            $city->delete();
           return Redirect::route('cities.index')->with(['toast'=>['message'=>'City deleted']]);

        }else{
            //todo
        }
       
    }
}
