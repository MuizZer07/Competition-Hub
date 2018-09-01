<?php

/**
* 
* Controller class after User Authentication
* Handles requests, responses
* CRUD opetations
* 
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Catagory;
use App\Organizer;
use App\OrganizerTeam;
use App\Competition;
use App\ParticipationHistory;
use App\UserPreference;
use App\Http\Controllers\NotificationController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => ['profile']
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # database query to show all the organizer teams, participating competitions, organizing competitions of the current user
        $user = auth()->user();
        $ID = $user->id;
        $teams = DB::select('Select * from organizer_teams join organizers where id = organizer_team_id and user_id = '.$ID);
        $competitions_id = ParticipationHistory::pluck('competition_id')->where('participant_id', $ID);

        $competitions = DB::select('select * from competitions c join (select p.competition_id from participation_histories p where p.participant_id = '.$ID.') p on c.id = p.competition_id');
        $comp = DB::table('organizers')
                        ->join('competitions', 'organizers.organizer_team_id', 'competitions.organizer_teams_id')
                        ->where('user_id', $ID)->get();

        

        # profile information checking 
        $string = "";
        if($user->position == null || $user->duration == null || $user->institution == null){
           $string = $string.'Current education status, ';
        }
        if($user->phone_number == null){
            $string = $string.'Phone Number, ';
        }
        if($user->address == null){
        $string = $string.'Address, ';
        }
        if($user->about == null){
        $string = $string.'About, ';
        }
        if($user->occupation == null){
            $string = $string.'Occupation, ';
        }
        if($user->website == null){
            $string = $string.'Website, ';
        }

        if($string != null){
            $string = 'Your profile is not completed! Following feilds are required: '.$string;
        }

        # Alerts the user if he is participating a competition on the current date
        NotificationController::EventAlert();
           
        # shows the dashboard to the user
        return view('home')->with(['teams' => $teams, 'competitions' => $competitions, 
                    'comp'=> $comp, 'error' => $string]);
    }

    /**
     * User Profile Page
     * 
     */
    public function profile($id){
        $user = User::find($id);
        $teams = DB::select('Select * from organizer_teams join organizers where id = organizer_team_id and user_id = '.$id);
        $competitions = DB::select('select * from competitions c join (select p.competition_id from participation_histories p where p.participant_id = '.$id.') p on c.id = p.competition_id');

        return view('pages.user.profile')->with(['competitions' => $competitions, 'teams' => $teams, 'user'=> $user]);
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
        $user->address = $request->input('address');
        $user->institution = $request->input('institution');
        $user->position = $request->input('position');
        $user->duration = $request->input('duration');
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

    /**
     * User Settings Page
     * 
     */
    public function settings(){
        $user = auth()->user();
        return view('pages.user.settings')->with('user', $user);
    }
}
