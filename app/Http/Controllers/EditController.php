<?php
namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Score;

class EditController extends Controller
{
    public function edit($id) {
        $student = Student::find($id);
        $score = Score::find($student->latest_score_id);
        $col = array('mc','tc','hw','bs','ks','ac');
        foreach ($col as $c) {
            $student->{$c} = $score->{$c};
        }
        return view('edit',['student' => $student]);       
    } 

    public function store(Request $request) {
		Validator::make($request->all(), [ // as simple as this
			'nickname' => 'required|min:5|max:30',
			'fullname' => 'required|min:5|max:30',
			'kattisacct' => 'required|min:5|max:30',
			'nationality' => 'required',
            'g-recaptcha-response' => 'required|captcha',
            'mc' => array('required','regex:/^((([0-3][.][5])|[x]|([0-4]))($|,)){8}(([0-3][.][5])|[x]|([0-4]))$/'),
            'tc' => array('required','regex:/^(([0-9][.][5])|[x]|([0-9])|([1][0][.][5])|([1][0]))(,)(([0-9][.][5])|[x]|([0-9])|([1][0-3][.][05])|([1][0-3]))$/'),
            'hw' => array('required','regex:/^((([0-1][.][5])|[x]|([0-1]))($|,)){9}(([0-1][.][5])|[x]|([0-1]))$/'),
            'bs' => array('required','regex:/^(([0-1]|[x])($|,)){8}([0-1]|[x])$/'),
            'ks' => array('required','regex:/^(([0-1]|[x])($|,)){11}([0-1]|[x])$/'),
            'ac' => array('required','regex:/^(([0-6]|[x])($|,)){7}([0-6]|[x])$/'),
        ],[
            'g-recaptcha-response.required' => 'The ReCaptcha is invalid.'
        ]
		)->validate();
	
        $new_score = new Score;
        $student = Student::find($request->input('id'));

        $new_score->user_id = $request->input('id');
        $new_score->mc = $request->input('mc');
        $new_score->tc = $request->input('tc');
        $new_score->hw = $request->input('hw');
        $new_score->bs = $request->input('bs');
        $new_score->ks = $request->input('ks');
        $new_score->ac = $request->input('ac');

        $new_score->save();
        $student->latest_score_id = $new_score->id;

		$student->nickname = $request->input('nickname');
		$student->name = $request->input('fullname');
		$student->kattis = $request->input('kattisacct');
		$student->comment = $request->input('comment');
		$student->country = $request->input('nationality');
		
        $student->save();
		
		return redirect()->action('StudentController@detail',['id' => $request->input('id')]);
    }      

    private function computeSumOf ($data) {
        $arr = explode(",", $data);

        return array_sum($arr);
    } 

    public function computeSum(Request $request) {
        $MC = $request->input('mc');
        $TC = $request->input('tc');
        $HW = $request->input('hw');
        $Bs = $request->input('bs');
        $Ks = $request->input('ks');
        $Ac = $request->input('ac');

        $sum = $this->computeSumOf($MC) + $this->computeSumOf($TC) + 
        $this->computeSumOf($HW) + $this->computeSumOf($Bs) + 
        $this->computeSumOf($Ks) + $this->computeSumOf($Ac);

        return response()->json(array('sum'=> (string)$sum, 200));
    }
}
