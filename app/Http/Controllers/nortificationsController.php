<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits;

class nortificationsController extends Controller
{
    use Traits\nortification_trait;
    public function fetch()
    {;



        return response($this->fetchNortification());
    }

    public function fetchAll()
    {;



        return response($this->fetchAllNortification());
    }







    public function inbox()
    {
        return view("Admin.inbox");
    }
}
