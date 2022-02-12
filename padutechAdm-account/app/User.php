<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getGender(){

        return [
            "Masculino",
            "Feminino",
            "Outro"
        ];
    }

    public static function getMessages(){

        return [
            "firstName.required" => "Informe o primeiro nome",
            "firstName.max" => "O primeiro nome excede :max caracteres",
            "lastName.required" => "Informe o sobrenome",
            "lastName.max" => "O sobrenome excede :max caracteres",
            "username.required" => "O nome de usuário deve ser informado",
            "username.unique" => "O nome de usuário já existe",
            "nickName.required" => "Nos informe como você prefere de ser chamado",
            "email.required" => "O campo email não foi preenchido",
            "email.unique" => "O email informado já existe",
            "email.email" => "O email informado é inválido",
            "gender.required" => "O campo genero deve ser informado",
            "gender.in" => "O campo genero deve ser: :values"
        ];
    }
}
