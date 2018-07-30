<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Catagory;
use App\Organizer;
use App\OrganizerTeam;
use App\Competition;
use App\ParticipationHistory;
use App\UserPreference;

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
        # database query to show all the organizer teams, participating competitions, organizing competitions of the current user
        $ID = auth()->user()->id;
        $teams = DB::select('Select * from organizer_teams join organizers where id = organizer_team_id and user_id = '.$ID);
        $competitions_id = ParticipationHistory::pluck('competition_id')->where('participant_id', $ID);

        $competitions = DB::select('select * from competitions c join (select p.competition_id from participation_histories p where p.participant_id = '.$ID.') p on c.id = p.competition_id');
        $comp = DB::table('organizers')
                        ->join('competitions', 'organizers.organizer_team_id', 'competitions.organizer_teams_id')
                        ->where('user_id', $ID)->get();
        # shows the dashboard for the user
        return view('home')->with(['teams' => $teams, 'competitions' => $competitions, 'comp'=> $comp]);
    }

    /**
     * Edit all the information of the current user
     *
     */
    public function editProfile()
    {
        $Catagory = Catagory::all();
        $user = auth()->user();
        return view('pages.user.edit')->with(['user'=> $user, 'catagory' => $Catagory]);
    }

    /**
     * Update User's profile (optional for a user)
     *
     */
    public function updateuser(Request $request)
    {
        # updating the user table with attributes
        $user = auth()->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone');
        $user->institution = $request->input('institution');
        $user->occupation = $request->input('occupation');
        $user->website = $request->input('website');
        $user->about = $request->input('about');
        $user->save();

        # user preferences record, each user can have multiple preferences
        $preferences = $request->input('catagory');
        if(!$preferences == null){
            foreach($preferences as $preference){
                $user_preference = new UserPreference;
                $user_preference->user_id = auth()->user()->id;
                $user_preference->catagory_id = $preference+1;
                $user_preference->save();
            }
        }
        
        # redirecting to the dashboard
        return redirect('home')->with('success', 'Profile Updated!');
    }
}
