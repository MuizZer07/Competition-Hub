<?php

/**
* 
* Controller class for OrganizerTeam Model
* Handles requests, responses
* CRUD opetations
* 
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrganizerTeam;
use App\Organizer;
use App\User;
use DB;

class OrganizerTeamController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',[
            'except' => ['show']
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.organizerteam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $team = new OrganizerTeam;
        $team->name = $request->input('name');
        $team->description = $request->input('description');
        $team->creator_id = auth()->user()->id;
        $team->save();
        $team_id = $team->id;

        $organizer = new Organizer;
        $organizer->user_id = auth()->user()->id;
        $organizer->organizer_team_id =  $team_id;
        $organizer->save();

        return redirect('/competitions')->with('success', 'Organizer Team Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = OrganizerTeam::find($id);
        $members = DB::select("select * from users u join organizers o
                        where u.id = o.user_id
                        and o.organizer_team_id = ".$id);

        return view('pages.organizerteam.show')->with(['team'=> $team, 'members'=> $members]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = OrganizerTeam::find($id);
        return view('pages.organizerteam.edit')->with('team', $team);
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
        $team = OrganizerTeam::find($id);
        $team->name = $request->input('name');
        $team->description = $request->input('description');
        $team->save();

        return redirect('/home')->with('success', 'Organizer Team Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
