<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;
use App\ParticipationHistory;
use App\Organizers;
use App\OrganizerTeam;
use App\Catagory;
use DB;

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
            'except' => ['index', 'show']
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitions = Competition::all();
        $catagories = Catagory::all();
        return view('pages.competition.index')->with(['competitions'=> $competitions, 'catagories'=> $catagories]);
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
        $teams = DB::Table('organizer_teams')->join('organizers', 'id', 'organizers.organizer_team_id')->where('user_id', $user)->get();
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

        $competition = new Competition;
        $competition->name = $request->input('name');
        $competition->venue = $request->input('venue');
        $competition->description = $request->input('description');
        $competition->event_date = $request->input('event_date');
        $competition->reg_deadline = $request->input('reg_deadline');
        $competition->organizer_teams_id = $request->input('organizer_team'); // haven't fixed yet
        $competition->catagory_id = $request->input('catagory')+1;
        $competition->save();

        return redirect('/competitions')->with('success', 'competition Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $competition = Competition::find($id);
      $catagory_id = $competition->catagory_id;
      $catagory = Catagory::find($catagory_id);
      try{
        $history = ParticipationHistory::where([
            'participant_id' => auth()->user()->id,
            'competition_id' => $id
        ])->get();
  
        
      }catch(\Exception $e){
        $history = null;
      }
      return view('pages.competition.show')->with([
        'competition'=> $competition,
        'history'=> $history,
        'catagory'=> $catagory
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

        return redirect('/competitions')->with('success', 'competition Updated!');
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
        return redirect('/competitions')->with('success', 'Competition Removed!');
    
    }
}
