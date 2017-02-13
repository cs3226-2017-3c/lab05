<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use View;

error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);
ini_set("error_log", "/tmp/php-error.log");

class StudentController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function indexWithData() { 
        $students = DB::table('student')->get()->map(function ($value, $key) {
            $arr = array('mc','tc','hw','bs','ks','ac');
            foreach ($arr as $column) {
                $value->{$column.'_i'} = explode(",", $value->{$column});
                $value->{$column} = array_sum($value->{$column.'_i'});
            }
            $value->spe = $value->mc+$value->tc;
            $value->dil = $value->hw+$value->bs+$value->ks+$value->ac;
            $value->sum = $value->spe + $value->dil;
            return $value;
        })->sortByDesc(function ($a, $key) {
            return $a->sum;
        });

        return response()->json(array('htmlString'=> View::make('index', ['student' => $students])->render(), 200));
    } 

    public function index() { 
        return view('index_empty'); 
    } 

    public function detail($id) {
        if (!is_numeric($id)){
            return view('errors/404');
        }
        $students = DB::table('student')->get()->map(function ($value, $key) {
            $arr = array('mc','tc','hw','bs','ks','ac');
            foreach ($arr as $column) {
                $value->{$column.'_i'} = explode(",", $value->{$column});
                $value->{$column} = array_sum($value->{$column.'_i'});
            }
            $value->spe = $value->mc+$value->tc;
            $value->dil = $value->hw+$value->bs+$value->ks+$value->ac;
            $value->sum = $value->spe + $value->dil;
            return $value;
        })->sortByDesc(function ($a, $key) {
            return $a->sum;
        });

        $leader = $students->first();
        $student = $students->filter(function ($value, $key) use ($id) {
            return $value->id == $id;
        })->first();
        if (! $student){
            return view('errors/404');
        } else {
            return view('detail',['student' => $student, 'leader' => $leader]);
        }
    }

         
}
