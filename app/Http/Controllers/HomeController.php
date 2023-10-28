<?php

namespace App\Http\Controllers;

use App\Models\Scooter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $scooters = Scooter::all();
        return view('home', compact('scooters'));
    }
}
