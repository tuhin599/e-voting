<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
{
    public function election(){
        return $this->belongsTo('App\Elections','election_ref','id');
    }
}
