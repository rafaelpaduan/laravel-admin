<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUsersPaginated($filter, $paginate, $page){

        $users = [];

        $users['count'] = User::where($filter)
                            ->count();

        $users['pages'] = number_format(ceil($users['count'] / $paginate), 0);

        $users['data'] = User::where($filter)
                            ->skip(($page - 1) * $paginate)
                            ->take($paginate)
                            ->get()
                            ->toArray();
        
        $users['items'] = count($users['data']);

        $users['actual_page'] = $page;
        $users['prev_page'] = $page - 1;
        $users['next_page'] = $page + 1;

        return $users;
    }
}
