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

        $students = Student::all();
        $col = array('mc','tc','hw','bs','ks','ac');
        foreach($students as $s){
            $score = Score::find($s->latest_score_id);
            foreach ($col as $c) {
                $s->{$c.'_i'} = explode(",", $score->{$c});
                $s->{$c} = array_sum($s->{$c.'_i'});
            }
            $s->spe = $s->mc+$s->tc;
            $s->dil = $s->hw+$s->bs+$s->ks+$s->ac;
            $s->sum = $s->spe + $s->dil;
        }
        $students = $students->sortByDesc(function ($a, $key) {
            return $a->sum;
        });
        
        return view('detail',['student' => $student, 'leader' => $students->first()]);
        
    }
}