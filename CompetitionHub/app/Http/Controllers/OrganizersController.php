<?php

namespace App\Http\Controllers;

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
        // $users = DB::select("select u.name from users u join organizers o
        //                     on u.id != o.user_id
        //                     and o.organizer_team_id = ".$id);
        
        $user = DB::table('users')->join('organizers', 'id', 'organizers.user_id')
                                   ->where('organizer_team_id', $id)->pluck('name')
                                   ->all(); 
        $users = DB::table('users')->whereNotIn('name', $user)->get();
        // $users = User::all();
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
    public function destroy($id)
    {
        //
    }
}
