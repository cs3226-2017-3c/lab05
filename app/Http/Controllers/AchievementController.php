<?php
namespace App\Http\Controllers;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Student;
use App\Score;
use Carbon\Carbon;

class AchievementController extends Controller
{
	public function _construct()
	{
		$this->middleware('auth');
	}	
	public function achievementHome(Request $request){
		Validator::make($request->all(), [
			'achievement' => 'required|in:lib,qs,aic,su,hd,bw,ka,cs',
			'lib' => 'in:lib',
			'qs' => 'in:qs',
			'aic' => 'in:aicOne,aicTwo,aicThree',
			'su' => 'in:suOne,suTwo,suThree',
			'hd' => 'in:hd',
			'bw' => 'in:bw',
			'ka' => 'in:kaOne,kaTwo,kaThree,kaFour,kaFive,kaSix',
			'cs' => 'in:cs',
		])->validate();
		
		$component = $request->input('component');
		
		$component_id['lib'] = $request->input('lib');
		$component_id['qs'] = $request->input('qs');
		$component_id['aic'] = $request->input('aic');
		$component_id['su'] = $request->input('su');
		$component_id['hd'] = $request->input('hd');
		$component_id['bw'] = $request->input('bw');
		$component_id['ka'] = $request->input('ka');
		$component_id['cs'] = $request->input('cs');
		
		return redirect('achievementDetail/'.$component."/".$component_id[$component]);
	}
	
	
}