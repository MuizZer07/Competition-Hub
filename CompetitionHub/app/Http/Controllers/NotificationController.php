<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\added_to_an_organizer_team;
use App\Notifications\updatePostNotification;
use App\ParticipationHistory;

class NotificationController extends Controller
{
    public static function addedOrganizerMember($user_id, $team_id){
        User::find($user_id)->notify(new added_to_an_organizer_team($team_id));
    }

    public function MarkasRead(){
        auth()->user()->unreadNotifications->markasread();
    
        return redirect()->back();
    }

    public static function updatePost($competition_id){
        $users = ParticipationHistory::where('competition_id', $competition_id)->pluck('participant_id')->all();
        
        foreach($users as $user_id){
            User::find($user_id)->notify(new updatePostNotification($competition_id));
        }

    }
}
