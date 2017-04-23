<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoterRequest extends Model
{
    protected $table="voter_requests";

    public function user(){
        return $this->belongsTo('App\User');
    }
}
