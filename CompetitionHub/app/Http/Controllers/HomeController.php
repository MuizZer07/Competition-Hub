<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Organizer;
use App\OrganizerTeam;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ID = auth()->user()->id;
        $teams = DB::select('Select name from organizer_teams join organizers where user_id = '.$ID);
        return view('home')->with('teams',$teams);
    }
}
