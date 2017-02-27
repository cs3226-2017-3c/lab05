<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Score;
use Validator;

class HistoryController extends Controller {
    public function studentHistory($id) {
        $student = Student::find($id);
        $scores = Score::where('student_id', $id)->orderBy('effective_from', 'asc')->get();
        
        $scores = $this->constructScores($scores);
        return view('studentHistory',['student' => $student, 'score' => $scores]);
        
    }

    public function history() {
        $scores = Score::all();
        $scores = $this->constructScores($scores);

        return view('history',['score' => $scores]);
    }

    private function constructScores($scores) {
        $col = array('mc','tc','hw','bs','ks','ac');
        foreach($scores as $score) {
            $student = Student::find($score->student_id);
            $score->student_name = $student->name;
            foreach($col as $c) {
                $temp = explode(",", $score->{$c});
                $score->{$c} = array_sum($temp);
            }
            $score->spe = $score->mc + $score->tc;
            $score->dil = $score->hw + $score->bs + $score->ks + $score->ac;
            $score->sum = $score->spe + $score->dil;
        }
        $scores = $scores->sortBy(function ($a, $key) {
            return sprintf('%-12s%s', $a->student_id, $a->effective_from);
        });
        return $scores;
    }
}