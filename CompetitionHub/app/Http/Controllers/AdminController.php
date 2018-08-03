<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Competition;
use App\ParticipationHistory;
use App\Organizer;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $competitions = Competition::all();
        $history = ParticipationHistory::all();
        $organizers = Organizer::all();
        return view('admin.home')->with(['competitions' => $competitions, 
                    'users'=> $users, 'history' => $history, 'organizers' => $organizers]);
    }
    
}
