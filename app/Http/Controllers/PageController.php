<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function tickets()
    {
        return view('listTicket');
    }
    public function tickets2()
    {
        return view('listTicket2');
    }

    public function about()
    {
        return view('about');
    }
}
