<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminRole = Roles::where('name','Admin');
        $gestorRole = Roles::where('name','Gestor');
        $alunoRole =  Roles::where('name','Aluno');

        $admUser =    User::create(
           [
            'name'=>'Alex adm',
            'email'=>'lexpadm@gmail.com',
            'password'=>Hash::make('password'),
            'remember_token'=>Str::random(10),
           ]
        );

        $admUser->roles()->attach(1);
    }
}
