<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;

class PagesController extends Controller
{
    public function index(){
        $competitions = Competition::all();
        return view('pages.index')->with('competitions', $competitions);
    }
}
