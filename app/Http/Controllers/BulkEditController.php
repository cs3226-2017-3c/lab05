<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Student;
use App\Score;
use Carbon\Carbon;

use Validator;

class BulkEditController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function editHome(Request $request) {
        Validator::make($request->all(), [ // as simple as this
            'component' => 'required|in:tc,mc,bs,hw,ks',
            'mc' => 'in:1,2,3,4,5,6,7,8,9',
            'tc' => 'in:1,2',
            'hw' => 'in:1,2,3,4,5,6,7,8,9,10',
            'bs' => 'in:1,2,3,4,5,6,7,8,9',
            'ks' => 'in:1,2,3,4,5,6,7,8,9,10,11,12',
        ])->validate();

        $component = $request->input('component');

        $component_id['mc'] = $request->input('mc');
        $component_id['tc'] = $request->input('tc');
        $component_id['hw'] = $request->input('hw');
        $component_id['bs'] = $request->input('bs');
        $component_id['ks'] = $request->input('ks');

        return redirect('bulkEdit/'.$component."/".$component_id[$component]);       
    } 

    public function edit($component, $id) {
        $students = Student::all();

        foreach($students as $student){
            $score = Score::find($student->latest_score_id);

            $arr= explode(",", $score->{$component});

            $student->{'data'} = $arr[$id-1];
        }

        switch ($component) {
            case 'mc':
                $component_full = 'Mini Contest';
                break;
            case 'tc':
                $component_full = 'Team Contest';
                break;
            case 'hw':
                $component_full = 'Homework';
                break;
            case 'bs':
                $component_full = 'Problem B';
                break;
            case 'hw':
                $component_full = 'Kattis Set';
                break;
            default:
                break;
        }

        return view('bulkEdit',['component' => $component,'component_full' => $component_full,'id' => $id, 'students' => $students]);       
    } 


    public function store(Request $request, $component, $index) {
        $regex['mc'] = array('required','regex:/^(([0-3][.][5])|[x]|([0-4]))$/');
        $regex['tc'] = array('required','regex:/^(([0-9][.][5])|[x]|([0-9])|([1][0-3][.][05])|([1][0-3]))$/');
		$regex['hw'] = array('required','regex:/^(([0-1][.][5])|[x]|([0-1]))$/');
        $regex['bs'] = array('required','regex:/^([0-1]|[x])$/');
        $regex['ks'] = array('required','regex:/^([0-1]|[x])$/');

        Validator::make($request->all(), [
            $component.".*" => $regex[$component],
            'g-recaptcha-response' => 'required|captcha'
        ],[
            'g-recaptcha-response.required' => 'The ReCaptcha is invalid.'
        ]
		)->validate();

        $user_id = Auth::id();
	
        foreach ($request->input($component) as $id => $value) {
            $new_score = new Score;

            $student = Student::find($id);
            $score = Score::find($student->latest_score_id);

            $new_score->student_id = $id;
            $col = array('mc','tc','hw','bs','ks','ac');
            foreach ($col as $c) {
                if ($c != $component){
                    $new_score->{$c} = $score->{$c};
                } else {
                    $arr = explode(",", $score->{$c});
                    $arr[$index-1] = $value;
                    $new_score->{$c} = implode(",", $arr);
                }
                
            }

            $new_score->effective_from = Carbon::now();
            $new_score->created_by = $user_id;
            $new_score->updated_by = $user_id;

            $new_score->save();

            $student->latest_score_id = $new_score->id;

            $student->save();            
        }
       
		return redirect()->action('StudentController@index');
    }      
}
