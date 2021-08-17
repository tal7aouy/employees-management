<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $countries = Country::all();
        if($request->has('search') && !empty($request->search)){
            $countries =  Country::where('name','like',"%{$request->search}%")->get();
        }
        return Inertia::render('Countries/Index',
        [
            'countries'=> $countries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return Inertia::render('Countries/Create');
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
            'country_code'=> ['required','numeric']
        ]);
        Country::create($request->all());
        return Redirect::route('countries.index')->with(['toast'=>['message'=> 'country created']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $country = Country::where('id','=',$id)->first();
        if($country){
            return Inertia::render('Countries/Edit',[
            'country'=>$country
        ]);
        }else{
            abort(404,'Not Found');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name'=> ['required','string'],
            'country_code'=> ['required','numeric']
        ]);
        $country = Country::find($id)->first();
        if($country){
            $country->update($request->all());
            return Redirect::route('countries.index')->with(['toast'=>['message'=>'Country Updated']]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $country = Country::find($id);
        if($country){
            $country->delete();
            return Redirect::route('countries.index')->with(['toast'=>['message'=>'country deleted']]);
        }else{
            // 
        }
    }
}
