<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $states = State::with('country')->get();

        if ($request->has('search') && !empty($request->search)) {
            $states = State::where('name', 'like', "%{$request->search}%")->with('country')->get();
        }
        return Inertia::render('States/Index', ['states' => $states]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  Inertia::render('States/Create', ['countries' => Country::all()]);
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
            'name' => ['required', 'string'],
            'country_id' => ['required', 'numeric']
        ]);

        State::create($request->all());
        return  Redirect::route('states.index', ['toast' => ['message' => 'State created']]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $state = State::where('id', '=', $id)->first();
        return Inertia::render('States/Edit',
            [
                'state' => $state,
                'countries' => Country::all()
            ]
        );
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
            'name' => ['required', 'string'],
            'country_id' => ['required', 'numeric']
        ]);
        $state = State::where('id','=',$id)->first();
        $state->update($request->all());
        return  Redirect::route('states.index', ['toast' => ['message' => 'State updated']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $state = State::where('id', '=', $id)->first();
        if ($state) {
            $state->delete();
            return Redirect::route('states.index')->with(['toast' => ['message' => 'State deleted']]);
        }
    }
}
