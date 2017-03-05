<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Score;
use Validator;

class HistoryController extends Controller {
    private $weekZero = "Last Friday of November 2016";
    private $CSS_COLOR_NAMES = ["rgb(141,209,158)","rgb(198,145,166)","rgb(33,222,225)","rgb(107,155,175)","rgb(57,249,180)","rgb(25,253,91)","rgb(55,237,24)","rgb(127,180,180)","rgb(46,92,97)","rgb(106,251,186)","rgb(220,107,115)","rgb(163,252,59)","rgb(153,229,200)","rgb(61,3,228)","rgb(90,136,187)","rgb(43,31,78)","rgb(18,174,240)","rgb(48,205,163)","rgb(113,253,35)","rgb(63,32,174)","rgb(156,227,48)","rgb(136,127,61)","rgb(16,237,98)","rgb(125,7,18)","rgb(69,116,8)","rgb(190,158,169)","rgb(128,53,15)","rgb(157,51,175)","rgb(247,27,229)","rgb(150,142,23)","rgb(102,130,247)","rgb(181,198,165)","rgb(58,186,0)","rgb(180,56,4)","rgb(30,67,53)","rgb(84,225,186)","rgb(176,134,46)","rgb(73,128,100)","rgb(198,234,179)","rgb(159,57,219)","rgb(76,123,2)","rgb(43,127,255)","rgb(17,76,127)","rgb(230,104,27)","rgb(29,181,88)","rgb(199,124,118)","rgb(77,138,50)","rgb(38,53,40)","rgb(241,251,74)","rgb(111,104,193)"];
    public function setWeekZero($date) {
        $weekZero = $date;
    }

    public function studentHistory($id) {
        if (!is_numeric($id)){
            return response()->view('errors/404',[],404);
        }
        $student = Student::find($id);
        if (!$student){
            return response()->view('errors/404',[],404);
        }
        $scores = Score::where('student_id', $id)->orderBy('effective_from', 'asc')->get();
        $scores = $this->constructScores($scores);

        return view('studentHistory',['student' => $student, 'score' => $scores]);
    }

    public function studentHistoryDataSet($id) {
        $student = Student::find($id);
        $scores = Score::where('student_id', $id)->orderBy('effective_from', 'asc')->get();
        $scores = $this->constructScores($scores);
        $dataSets = $this->constructDataSets($scores, false);
        
        return response()->json($dataSets);
    }

    public function history() {
        return view('history');
    }

    public function historyDataSet() {
        $scores = Score::all();
        $scores = $this->constructScores($scores);
        $dataSets = $this->constructDataSets($scores, true);
        usort($dataSets, array($this, "compare"));
        for ($i = 0; $i < 10; $i++) {
            $dataSets[$i]->hidden = false;
        } 

        return response()->json($dataSets);
    }

    private function constructDataSets($scores, $isChartHidden) {
        $dummyObject = new Score;
        $dummyObject->student_id = -1;
        $dummyObject->score_id = -1;
        $scores->push($dummyObject);

        $preStudentId = "";
        $preStudentName = "";
        $studentCount = 0;
        $dataSetArray = array();
        $tempData = array();
        
        foreach ($scores as $score) {
            $thisStudentId = $score->student_id;
            if ($preStudentId != $thisStudentId) {
                if (sizeof($tempData) > 0) {
                    $data = $this->retrieveUsefulSumData($tempData);

                    $dataSet = (object)array();
                    $dataSet->label=$preStudentName;
                    $dataSet->fill=false;
                    $dataSet->lineTension=0;
                    $dataSet->backgroundColor=$this->CSS_COLOR_NAMES[$studentCount];
                    $dataSet->borderColor=$this->CSS_COLOR_NAMES[$studentCount];
                    $dataSet->hidden=$isChartHidden;
                    $dataSet->data=$data;
                    array_push($dataSetArray, $dataSet);
                    unset($tempData);
                    $tempData = array();
                    $studentCount = $studentCount + 1;
                    if ($studentCount == sizeof($this->CSS_COLOR_NAMES)) {
                        $studentCount = 0;
                    }
                }
                $preStudentId = $thisStudentId;
                $preStudentName = $score->student_name;
            }
            $tempObject = (object)array("date"=>$score->effective_from, "sum"=>$score->sum);
            array_push($tempData, $tempObject);
        }
        return $dataSetArray;
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

    private function convertWeekToDate($currWeek) {
        $tempDate = new Carbon($this->weekZero, 'Asia/Singapore');
        $tempDate->addDays(7*$currWeek);
        return $tempDate;
    }

    private function retrieveUsefulSumData($tempData) {
        $data = array();
        $currentWeekDate = new Carbon($this->weekZero, 'Asia/Singapore');
        $bufferSum = 0;
        foreach ($tempData as $tempObject) {
            $thisDate = new Carbon($tempObject->date, 'Asia/Singapore');
            while ($currentWeekDate->diffInDays($thisDate, false) > 0) {    
                array_push($data, $bufferSum);
                $currentWeekDate->addDays(7);
            }
            $bufferSum = $tempObject->sum;
        }
        array_push($data, $bufferSum);

        return $data;
    }

    private function compare($dataSetA, $dataSetB) {
        $dataA = $dataSetA->data;
        $dataB = $dataSetB->data;

        $sumA = $dataA[sizeof($dataA)-1];
        $sumB = $dataB[sizeof($dataB)-1];

        if ($sumA == $sumB) {
            return 0;
        }
        return ($sumA > $sumB) ? -1 : 1;
    }
}