<?php

/*
*
* Handles all Query Model requests
* CRUD opetations
*
*/


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\NotificationController;
use DB;
use App\Query;

class QueryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($competition_id)
    {
        $queries = DB::Table('queries')->where('competition_id', $competition_id)->get();
        return view('pages.query.index')->with('queries', $queries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $competition_id)
    {
        $this->validate($request,[
            'query' => 'required'
        ]);
        $query = new Query;
        $query->query = $request->input('query');
        $query->reply = null;
        $query->isReplied = false;
        $query->user_id = auth()->user()->id;
        $query->competition_id = $competition_id;
        $query->save();

        NotificationController::newNotification($query->id);
        return redirect('/competitions/'.$competition_id)->with('success','You will be notified if any of the organizers replied to your query');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = Query::find($id);
        return view('pages.query.show')->with('query', $query);
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
        $query = Query::find($id);
        $query->reply = $request->input('reply');
        $query->isReplied = true;
        $query->save();

        NotificationController::QueryReplied($query->id);

        return redirect('/query/index/'.$query->competition_id)->with('success', 'You have replied to the query!');
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
