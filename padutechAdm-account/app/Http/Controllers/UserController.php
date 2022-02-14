<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get();

        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // REMEMBER TO SET Accept: application/json Header or requests will return as 404 on validation fail

        $user = $request->validate([
            "firstName" => 'required|max:30',
            "lastName" => 'required|max:100',
            "username" => [
                'required',
                Rule::unique('users')->whereNull('deleted_at')
            ],
            "nickName" => 'required',
            "password" => 'confirmed',
            "email" => 'required|email',
            "gender" => [
                'required',
                Rule::in(User::getGender())
            ]
        ], User::getMessages());

        $user['name'] = $user['firstName'] . ' ' . $user['lastName'];
        $user['password'] = Hash::make($request['password']);

        $user = User::create($user);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if(!$user){

            return response()->json([

                "code" => "404",
                "message" => "user not found"
            ]);
        }

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dbUser = User::find($id);

        if(!$dbUser){

            return response()->json([

                "code" => "404",
                "message" => "user not found"
            ]);
        }

        $user = $request->validate([
            "firstName" => 'max:30',
            "lastName" => 'max:100',
            "email" => 'email',
            "password" => 'confirmed',
            "gender" => [
                Rule::in(User::getGender())
            ]
        ]);

        if($request->firstName && $request->lastName){

            $user['name'] = $user['firstName'] . ' ' . $user['lastName'];
        }

        if($request->nickname){

            $user['nickname'] = $request->nickname;
        }

        if($request->password){

            if($request->password == $request->password_confirmation){

                $user['password'] = Hash::make($request['password']);
            }
        }

        // $dbUser->firstName = $user['firstName'];

        foreach($user as $key => $item){

            $dbUser->{$key} = $item;
        }

        $dbUser->save();

        return $dbUser;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();
    }
}
