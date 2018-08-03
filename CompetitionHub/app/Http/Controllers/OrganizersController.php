<?php

namespace App\Http\Controllers;

use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use App\User;
use App\Organizer;
use App\OrganizerTeam;
use DB;

class OrganizersController extends Controller
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
    public function create($id)
    {
        
        $user = DB::table('users')->join('organizers', 'id', 'organizers.user_id')
                                   ->where('organizer_team_id', $id)->pluck('name')
                                   ->all(); 
        $users = DB::table('users')->whereNotIn('name', $user)->get();
        return view('pages.organizer.create')->with(['users' => $users, 'id'=> $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request,[
            'users' => 'required'
        ]);

        $users_id = $request->input('users');
        // throw new \Exception($request->get('usersss'));
        foreach($users_id as $user){
            $organizer = new Organizer;
            $organizer->user_id = $user;
            $organizer->organizer_team_id =  $id;
            $organizer->save();

            NotificationController::addedOrganizerMember($user, $id);
        }

        return redirect('/home')->with('success', 'Organizer(s) Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
    public function destroy($user_id, $organizer_team_id)
    {
        $organizer = Organizer::where(['user_id'=> $user_id, 'organizer_team_id' => $organizer_team_id]);
        $organizer->delete();
        return redirect('/organizerteam/'.$organizer_team_id)->with('success', 'Member Removed!');
    }
}
