<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use App\Student;
use App\Score;

error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

class StudentController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function index() { 
        $students = Student::all();
        $col = array('mc','tc','hw','bs','ks','ac');
        foreach($students as $student){
            $score = Score::find($student->latest_score_id);
            foreach ($col as $c) {
                $student->{$c.'_i'} = explode(",", $score->{$c});
                $student->{$c} = array_sum($student->{$c.'_i'});
                $student->spe = $student->mc+$student->tc;
                $student->dil = $student->hw+$student->bs+$student->ks+$student->ac;
                $student->sum = $student->spe + $student->dil;
            }
        }
        $students = $students->sortByDesc(function ($a, $key) {
            return $a->sum;
        });

        return view('index', ['student' => $students]); 
    }    
}
