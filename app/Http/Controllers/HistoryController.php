<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Score;
use Validator;
use View;

error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

class HistoryController extends Controller {
    public function studentHistory($id) {
        $student = Student::find($id);
        $scores = Score::where('student_id', $id)->orderBy('effective_from', 'asc')->get();
        
        $scores = $this->constructScores($scores);
        return view('studentHistory',['student' => $student, 'score' => $scores]);
        
    }

    public function emptyHistory() {
    
        return view('history_empty');
    }

    public function historyWithChart() {
        $scores = Score::all();
        $scores = $this->constructScores($scores);

        return response()->json(array('htmlString'=> View::make('history', ['score' => $scores])->render(), 200));
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