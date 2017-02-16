<?php
namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Score;
use App\Student;

class DeleteScoreController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function store(Request $request) {
    Validator::make($request->all(), [ 
      'id' => 'required',
      ])->validate();
    
    $id = $request->input('id');
    $score = Score::find($id);
    $student = Student::find($score->student_id);
    $scores = Score::where('student_id', $student->id)->orderBy('effective_from', 'desc');
    if ($scores->count() == 1){
      flash('Delete was unsuccessful, at least 1 is needed!', 'warning');
      return redirect()->action('HistoryController@history',['id' => $student->id]); 
    }

    if($student->latest_score_id == $id){
      $score->delete();
      $student->latest_score_id = Score::where('student_id', $student->id)->orderBy('effective_from', 'desc')->first()->id;
      $student->save();
    } else {
      $score->delete();
    }

    flash('Score history with id <strong>' . $id . '</strong> was deleted!', 'success');
    return redirect()->action('HistoryController@history',['id' => $student->id]); 
  }      
}
