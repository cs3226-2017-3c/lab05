<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Score;
use Validator;

class DetailController extends Controller {
    public function detail($id) {
        if (!is_numeric($id)){
            return view('errors/404');
        }
        $student = Student::find($id);
        if (!$student){
            return view('errors/404');
        }
        $score = Score::find($student->latest_score_id);
        $col = array('mc','tc','hw','bs','ks','ac');
        foreach ($col as $c) {
            $student->{$c.'_i'} = explode(",", $score->{$c});
            $student->{$c} = array_sum($student->{$c.'_i'});
        }
        $student->spe = $student->mc+$student->tc;
        $student->dil = $student->hw+$student->bs+$student->ks+$student->ac;
        $student->sum = $student->spe + $student->dil;
        
        return view('detail',['student' => $student]);
        
    }
}