<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Score;
use Carbon\Carbon;

use Validator;

class EditScoreController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin');
  }
  public function edit($id) {
    if (!is_numeric($id)){
        return response()->view('errors/404',[],404);
    }
    $student = Student::find($id);
    if (!$student){
        return response()->view('errors/404',[],404);
    }
    $score = Score::find($student->latest_score_id);
    $col = array('mc','tc','hw','bs','ks','ac');
    foreach ($col as $c) {
      $student->{$c} = $score->{$c};
    }
    return view('score',['student' => $student]);       
  } 

  public function store(Request $request) {
		Validator::make($request->all(), [ // as simple as this
      'mc' => array('required','regex:/^((([0-3][.][5])|[x]|([0-4]))(,)){8}(([0-3][.][5])|[x]|([0-4]))$/'),
      'tc' => array('required','regex:/^(([0-9][.][5])|[x]|([0-9])|([1][0][.][5])|([1][0]))(,)(([0-9][.][5])|[x]|([0-9])|([1][0-3][.][5])|([1][0-3]))$/'),
      'hw' => array('required','regex:/^((([0-1][.][5])|[x]|([0-1]))(,)){9}(([0-1][.][5])|[x]|([0-1]))$/'),
      'bs' => array('required','regex:/^(([0-1]|[x])(,)){8}([0-1]|[x])$/'),
      'ks' => array('required','regex:/^(([0-1]|[x])(,)){11}([0-1]|[x])$/'),
      'ac' => array('required','regex:/^(([0-1]|[x])(,)){2}(([0-3]|[x])(,)){2}(([0-1]|[x])(,)){2}([0-6]|[x])(,)([0-6]|[x])$/'),
      ]
      )->validate();

    $user_id = Auth::id();

    $new_score = new Score;
    $student = Student::find($request->input('id'));

    $new_score->student_id = $request->input('id');
    $new_score->mc = $request->input('mc');
    $new_score->tc = $request->input('tc');
    $new_score->hw = $request->input('hw');
    $new_score->bs = $request->input('bs');
    $new_score->ks = $request->input('ks');
    $new_score->ac = $request->input('ac');
    $new_score->effective_from = Carbon::now();
    $new_score->created_by = $user_id;
    $new_score->updated_by = $user_id;

    $new_score->save();

    $student->latest_score_id = $new_score->id;

    $student->save();

    flash('Score of student <strong>' . $student->name . '</strong> was updated!', 'success');
    return redirect()->action('DetailController@detail',['id' => $request->input('id')]);
  }      
}
