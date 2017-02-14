<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Score;
use Validator;

class HistoryController extends Controller {
    public function history($id) {
        $student = Student::find($id);
        $score = Score::where('student_id', $id)->orderBy('effective_from', 'desc')->get();
        $col = array('mc','tc','hw','bs','ks','ac');
        foreach ($score as $sc){
            foreach ($col as $c) {
                $sc->{$c.'_i'} = explode(",", $sc->{$c});
                $sc->{$c} = array_sum($sc->{$c.'_i'});
            }
                $sc->spe = $sc->mc+$sc->tc;
                $sc->dil = $sc->hw+$sc->bs+$sc->ks+$sc->ac;
                $sc->sum = $sc->spe + $sc->dil;
        }
        return view('history',['student' => $student, 'score' => $score]);
        
    }
}