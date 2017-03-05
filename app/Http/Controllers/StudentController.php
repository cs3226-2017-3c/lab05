<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    * Index page when loader is loading 
    */
    public function index() {
        return view('index_empty'); 
    }


    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function indexWithdata() { 
        $students = Student::all();
        $col = array('mc','tc','hw','bs','ks','ac');
        $modifiedDate = "1970-01-01 00:00:00";
        foreach($students as $student){
            $score = Score::find($student->latest_score_id);
            $thisDate = $score->effective_from;
            if (strcmp($modifiedDate, $thisDate) < 0) {
                $modifiedDate = $thisDate;
            }
            foreach ($col as $c) {
                $student->{$c.'_i'} = explode(",", $score->{$c});
                $student->{$c} = array_sum($student->{$c.'_i'});
            }
            $student->spe = $student->mc+$student->tc;
            $student->dil = $student->hw+$student->bs+$student->ks+$student->ac;
            $student->sum = $student->spe + $student->dil;
        }
        $students = $students->sortByDesc(function ($a, $key) {
            return $a->sum;
        });

        $i = 1;
        foreach($students as $student){
            $student->rank = $i;
            $i = $i + 1;  
        }
        
        if(Auth::check() and Auth::user()->access == 1){
            // return all students
        } elseif (Auth::check()){
            $user = Auth::user();
            $new_students = $students->slice(0, 7);
            $student = $students->where('id',$user->student_id);
            $rank = $student->first()->rank;
            $student_low = $students->where('rank',$rank+1);
            $student_up = $students->where('rank',$rank-1);
            $new_students = $new_students->union($student_up);
            $new_students = $new_students->union($student);
            $new_students = $new_students->union($student_low);
            $students = $new_students;
        } else {
            $students = $students->slice(0, 7);
        }

        return response()->json(array('htmlString'=> View::make('index', ['student' => $students, 'update' => $modifiedDate])->render(), 200));
    }    
}
