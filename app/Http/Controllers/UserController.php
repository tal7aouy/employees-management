<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();

        if($request->has('search')&& !empty($request->search)){
          $users = User::where('username','like',"%{$request->search}%")->get();
        }
        
        return Inertia::render('Users/Index',
        ['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create');
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
            'username' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        User::create([
            'username'=> $request->username,
            'full_name'=> $request->fullname,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);
 
        return Redirect::route('users.index')->with(['toast'=>['message'=>'User Created']]);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $user = User::where('id','=',$id)->first();
        return Inertia::render('Users/Edit',[
            'user'=> $user
        ]);
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
         
        $user = User::where('id','=',$id)->first();   
        $data = $request->except('password');
        if($request->has('password')){
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return Redirect::route('users.index')->with(['toast'=>['message'=> 'User Updated']]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $user = User::where('id','=',$id)->first();
        if($user->id !== auth()->user()->id){
            $user->delete();
        }
        return redirect()->route('users.index')->with(['toast'=>['message'=> 'user deleted']]);
    }
}
