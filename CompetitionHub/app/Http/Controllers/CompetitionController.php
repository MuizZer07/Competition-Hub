<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Competition;

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
        return view('pages.competition.index')->with('competitions', $competitions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('pages.competition.create');
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
            'description' => 'required'
        ]);

        $competition = new Competition;
        $competition->name = $request->input('name');
        $competition->venue = $request->input('venue');
        $competition->description = $request->input('description');
        $competition->event_date = $request->input('event_date');
        $competition->reg_deadline = $request->input('reg_deadline');
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
      return view('pages.competition.show')->with('competition', $competition);
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