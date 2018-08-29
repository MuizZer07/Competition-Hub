<?php

/**
* 
* Controller class for Competition Model
* Handles requests, responses
* CRUD opetations
* 
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;
use App\ParticipationHistory;
use App\Organizers;
use App\OrganizerTeam;
use App\Catagory;
use App\Update;
use DB;
use Carbon\Carbon;
use App\UserPreference;

class CompetitionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => ['index', 'show', 'allCompetitions', 'allCompetitionsByCatagory']
        ]);
    }
    /**
     * Display competitions in a sorted way
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $date = Carbon::today()->format('Y-m-d');
        $competitions = DB::Table('competitions')->whereDate('event_date', '>=', $date)->get();
        $catagories = Catagory::all();
       

        if(auth()->user()){ 
            $user_preferences = DB::Table('user_preferences')
            ->join('catagories', 'catagory_id', 'id')
            ->where('user_id', auth()->user()->id)->get();
            
            return view('pages.competition.index_user')->with(['competitions'=> $competitions,
            'catagories'=> $catagories,
            'date'=> $date,
            'preferences'=> $user_preferences
            ]);
        }else{
            return view('pages.competition.index')->with(['competitions'=> $competitions,
            'catagories'=> $catagories,
            'date'=> $date
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catagories = Catagory::all();
        $user = auth()->user()->id;
        $teams = DB::Table('organizer_teams')->join('organizers', 'id', 'organizers.organizer_team_id')->where('user_id', $user)->pluck('name')->all();
        return view('pages.competition.create')->with(['teams'=> $teams, 'catagories' => $catagories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'venue' => 'required',
            'event_date' => 'required',
            'reg_deadline' => 'required',
            'description' => 'required',
            'organizer_team' => 'required',
            'catagory' => 'required'
        ]);

        $organizer = $request->input('organizer_team');
        $organizer_id = OrganizerTeam::where('name', $organizer)->pluck('id')->all();

        $competition = new Competition;
        $competition->name = $request->input('name');
        $competition->venue = $request->input('venue');
        $competition->description = $request->input('description');
        $competition->event_date = $request->input('event_date');
        $competition->reg_deadline = $request->input('reg_deadline');
        $competition->organizer_teams_id = $organizer_id[0]; 
        $competition->catagory_id = $request->input('catagory')+1;
        $competition->save();

        return redirect('home')->with('success', 'competition Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $date = Carbon::today()->format('Y-m-d');
      $competition = Competition::find($id);

      $flag = false;
      if($competition->reg_deadline <= $date){
        $flag = true;
      }
      $catagory_id = $competition->catagory_id;
      $catagory = Catagory::find($catagory_id);
      $updates = Update::where('competition_id', $id)->get();

      try{
        $history = ParticipationHistory::where([
            'participant_id' => auth()->user()->id,
            'competition_id' => $id
        ])->get();
  
        
      }catch(\Exception $e){
        $history = null;
      }

    return view('pages.competition.show1')->with([
        'competition'=> $competition,
        'history'=> $history,
        'catagory'=> $catagory,
        'updates' => $updates,
        'flag' => $flag
     ]);
      
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $competition = Competition::find($id);
        return view('pages.competition.edit')->with('competition', $competition);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'venue' => 'required',
            'event_date' => 'required',
            'reg_deadline' => 'required',
            'description' => 'required'
        ]);

        $competition = Competition::find($id);
        $competition->name = $request->input('name');
        $competition->venue = $request->input('venue');
        $competition->description = $request->input('description');
        $competition->event_date = $request->input('event_date');
        $competition->reg_deadline = $request->input('reg_deadline');
        $competition->save();

        return redirect('home')->with('success', 'competition Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $competition = Competition::find($id);
        $competition->delete();
        return redirect('/home')->with('success', 'Competition Removed!');
    
    }

    /**
     * Shows all the competitions.
     */
    public function allCompetitions()
    {
        $date = Carbon::today()->format('Y-m-d');
        $competitions = DB::Table('competitions')->whereDate('event_date', '>=', $date)->get();
        $catagories = Catagory::all();
        return view('pages.competition.all')->with(['competitions'=> $competitions, 'catagories'=> $catagories]);
    }

    /**
     * Shows all the competitions by catagory.
     */
    public function allCompetitionsByCatagory()
    {
        $date = Carbon::today()->format('Y-m-d');
        $competitions = DB::Table('competitions')->whereDate('event_date', '>=', $date)->get();
        $catagories = Catagory::all();
        return view('pages.competition.catagorical')->with(['competitions'=> $competitions, 'catagories'=> $catagories]);
  
    }

}
