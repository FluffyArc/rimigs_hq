<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    public function subject(){
        return $this->belongsTo('App\Subject','id_subject','id');
    }


}
