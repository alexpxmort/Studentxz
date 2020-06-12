<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


//School model que faz a conexão com a tabela  de schools_table

class School extends Model
{
    //
    protected $table = 'schools_table';

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
