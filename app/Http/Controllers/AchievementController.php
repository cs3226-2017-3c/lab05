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
			'lib' => 'in:1',
			'qs' => 'in:1',
			'aic' => 'in:1,2,3',
			'su' => 'in:1,2,3',
			'hd' => 'in:1',
			'bw' => 'in:1',
			'ka' => 'in:1,2,3,4,5,6',
			'cs' => 'in:1',
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
	
	public function detail($component, $id){
		$componentIndexMax = ['lib' => 1,'qs' => 1,'aic' => 3,'su' => 3,'hd' => 1,'bw' => 1,'ka' => 6,'cs' => 1];
		
		if(!is_numeric($id) || !in_array($component, ['lib','qs','aic','su','hd','bw','ka','cs']) || 
			$id > $componentIndexMax[$component] || $id<=0){
			return view('errors/404');
		}		
		
		switch ($component){
			case 'lib':
				$component_full = 'Let it begins';
				break;
			case 'qs':
				$component_full = 'Quick starter';
				break;
			case 'aic':
				$component_full = 'Active in class';
				break;
			case 'su':
				$component_full = 'Surprise us';
				break;
			case 'hd':
				$component_full = 'High determination';
				break;
			case 'bw':
				$component_full = 'Bookworm';
				break;
			case 'ka':
				$component_full = 'Kattis apprentice';
				break;
			case 'cs':
				$component_full = 'CodeForces Specialist';
				break;
			default:
				break;
		}

		return view('achievementDetail',['component' => $component, 'component_full' => $component_full,'id' => $id]);
	}	
	
}