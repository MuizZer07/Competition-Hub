<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Organizer;
use App\OrganizerTeam;
use App\Competition;
use App\ParticipationHistory;

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
        $teams = DB::select('Select * from organizer_teams join organizers where id = organizer_team_id and user_id = '.$ID);
        $competitions_id = ParticipationHistory::pluck('competition_id')->where('participant_id', $ID);

        $competitions = DB::select('select * from competitions c join (select p.competition_id from participation_histories p where p.participant_id = '.$ID.') p on c.id = p.competition_id');
        $comp = DB::table('organizers')
                        ->join('competitions', 'organizers.organizer_team_id', 'competitions.organizer_teams_id')
                        ->where('user_id', $ID)
                        ->pluck('competitions.name')->all();
        return view('home')->with(['teams' => $teams, 'competitions' => $competitions, 'comp'=> $comp]);
    }

    public function profile(){
        return view('pages.user.profile');
    }
}
