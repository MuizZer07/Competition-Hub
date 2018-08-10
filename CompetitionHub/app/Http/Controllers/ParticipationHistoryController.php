<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ParticipationHistory;
use App\Competition;
use DB;

class ParticipationHistoryController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
      try {
        $history = new ParticipationHistory;
        $history->participant_id = auth()->user()->id;
        $history->competition_id =  $request->input('competition_id');
        $history->save();

        return redirect('/competitions/'.$history->competition_id)->with('success', 'You are successfully registered in the competition!');
        } catch (\Exception $e) {
            return redirect('/competitions/')->with('error', 'You have already registered as a participant in this competition');

        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    # shows all participants of a competitions
    public function showallparticipants($competition_id)
    {
        $users = DB::Table('users')
                    ->join('participation_histories', 'id', 'participant_id')
                    ->where('competition_id', $competition_id)->get();
        return view('pages.competition.allparticipants')->with('users', $users);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $competition_id)
    {
        $history = ParticipationHistory::where(['participant_id' => $user_id, 'competition_id' => $competition_id]);
        $history->delete();
        return redirect('/home')->with('success', 'Participation Canceled!');
    }
}
