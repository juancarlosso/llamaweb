<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
    *
    * @brief
    * @author Juan Carlos Salinas Ojeda
    * @param string
    * @return
    *
    */
    public function show()
    {
        return view('home.show');
    }
}
