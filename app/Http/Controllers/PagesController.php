<?php

namespace App\Http\Controllers;



//Controller de Paginas que retorna a view Inicial

class PagesController extends Controller
{

    public function homePage(){
        return view('admin.layouts.app');
    }

}
