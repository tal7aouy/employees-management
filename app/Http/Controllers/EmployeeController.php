<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Employee;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
                $employees = Employee::with('department')->get();

        if($request->has('search') && !empty($request->search)){
            $employees = Employee::where('first_name','like',"%{$request->search}%")->orWhere('last_name','like',"%{$request->search}%")->with('department')->get();
        }
        if($request->has('department_id') && !empty($request->department_id)){
            $employees = Employee::where('department_id','=',intval($request->department_id))->with('department')->get();
        }
        return Inertia::render('Employees/Index', ['employees' => $employees,'departments'=> Department::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render(
            'Employees/Create',
            [
                'states' => State::all(),
                'countries' => Country::all(),
                'departments' => Department::all(),
                'cities' => City::all()
            ]
        );
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
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'middle_name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'department_id' => ['required', 'numeric'],
            'city_id' => ['required', 'numeric'],
            'state_id' => ['required', 'numeric'],
            'country_id' => ['required', 'numeric'],
            'zip_code' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
            'date_hired' => ['required', 'date'],
        ]);
        Employee::create($request->all());
        return Redirect::route('employees.index')->with(['toast' => ['message' => 'Employee Created']]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $employee = Employee::where('id', '=', $id)->first();
        return Inertia::render(
            'Employees/Edit',
            [
                'states' => State::all(),
                'countries' => Country::all(),
                'departments' => Department::all(),
                'cities' => City::all(),
                'employee' => $employee
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
    public function update(Request $request,int $id)
    {
       $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'middle_name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'department_id' => ['required', 'numeric'],
            'city_id' => ['required', 'numeric'],
            'state_id' => ['required', 'numeric'],
            'country_id' => ['required', 'numeric'],
            'zip_code' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
            'date_hired' => ['required', 'date'],
        ]);
        $employee = Employee::where('id','=',$id)->first();
        $employee->update($request->all());
        return Redirect::route('employees.index')->with(['toast' => ['message' => 'Employee Updated']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $employee = Employee::where('id', '=', $id)->first();
        if ($employee) {
            $employee->delete();
            return Redirect::route('employees.index')->with(['toast' => ['message' => 'Employee Deleted']]);
        }
    }
}
