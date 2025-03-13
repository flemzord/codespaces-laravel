<?php

namespace App\Http\Controllers;

use App\Models\Welcome;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $welcomes = Welcome::all();
        return view('welcome', ['welcomes' => $welcomes]);
    }
}
