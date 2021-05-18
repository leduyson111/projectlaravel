<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class silderController extends Controller
{
    //

    public function index(){

        return view("backend.slide.index");

    }
    public function create(){

        return view("backend.slide.create");

    }
    public function delete(){

        return view("backend.slide.delete");

    }
    public function edit(){

        return view("backend.slide.edit");

    }

}
