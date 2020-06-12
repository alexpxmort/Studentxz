<?php

namespace App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\Model;


//Roles model que faz a conexão com a tabela  de roles_tables
class Roles extends Model
{
    protected $table = 'roles_tables';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
