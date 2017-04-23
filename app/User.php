<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function alreadySendRequest(){
        return (bool)$this->hasOne('App\VoterRequest')->count();
    }
    public function requestAccepted(){
        return (bool)$this->hasOne('App\VoterRequest')->where('status',1)->count();
    }

    public function requestRejected(){
        return (bool)$this->hasOne('App\VoterRequest')->where('status',2)->count();
    }

    public function candidate(){
        return Candidates::where('region',Auth::user()->address)->get();
    }

    public function alreadyVote(Candidates $candidates){
        return (bool) $this->hasOne('App\VoteCounter')->where('candidate_id',$candidates->id)->count();
    }
    public function alreadyVoteElec(Elections $e){
        return (bool) $this->hasOne('App\VoteCounter')->where('election_id',$e->id)->count();
    }
    public function region(User $user){
        return User::where('id',$user->id)->first()->address;
    }
    public function electionsOf(){
        return $this->hasMany('App\Elections','region','address')->get();
    }


    public function electionWinner(Elections $elections){
        return Candidates::where('id',$elections->winner)->first();
    }


}
