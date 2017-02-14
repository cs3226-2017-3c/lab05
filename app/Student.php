<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = array('name', 'nickname','kattis','country','mc','tc','hw','bs','ks','ac','avatar','comment');
}
