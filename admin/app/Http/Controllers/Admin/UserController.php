<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = [];
        $filter = [];
        $input = [];
        $paginate = 10;
        $page = 1;

        if($request->has('submit') || $request->has('page')){

            $filters = $request->all();

            $paginate = isset($filters['paginate']) ? $filters['paginate'] : $paginate;
            $page = isset($filters['page']) ? $filters['page'] : $page;

            unset($filters['_token']);
            unset($filters['paginate']);
            unset($filters['page']);
            unset($filters['submit']);

            foreach($filters as $key => $value){

                // Criar Middleware pra checar se o campo existe .. se nao existir, ignorar.
                // O Operador pode vir do banco quando fizer a verificacao acima

                if(isset($value)){

                    array_push($filter, [$key, 'like', '%' . $value . '%']);
                    $input[$key] = $value;
                }
            }

            $users = User::getUsersPaginated($filter, $paginate, $page);
        }

        return view('Admin.Usuarios.index', compact('users', 'input'));
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
