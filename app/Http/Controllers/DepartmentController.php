<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = Department::all();
        if($request->has('search') && !empty($request->search)){
            $departments = Department::where('name','like',"%{$request->search}%")->get();
        }
        return Inertia::render(
            'Departments/Index',
            [
                'departments' => $departments
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Departments/Create');
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
            'name' => ['required', 'string']
        ]);
        Department::create($request->all());
        return Redirect::route('departments.index')->with(['toast' => ['message' => 'Department Created']]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $department = Department::where('id', '=', $id)->first();
        return Inertia::render('Departments/Edit', ['department' => $department]);
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
            'name' => ['required', 'string']
        ]);
        $department = Department::where('id','=',$id)->first();
        $department->update($request->all());
        return Redirect::route('departments.index')->with(['toast' => ['message' => 'Department Updated']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $department = Department::where('id', '=', $id)->first();
        $department->delete();
        return Redirect::route('departments.index')->with(['toast' => ['message' => 'Department Deleted']]);
    }
}
