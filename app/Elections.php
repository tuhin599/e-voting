<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elections extends Model
{
    public function candidates(){
        return $this->hasMany('App\Candidates','election_ref','id');
    }
    public function winner(Elections $elections){
        return Candidates::where('id',$elections->winner)->first();
    }
}
