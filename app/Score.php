<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = array('mc','tc','hw','bs','ks','ac');
}
