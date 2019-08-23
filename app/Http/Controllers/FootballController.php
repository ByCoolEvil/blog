<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FootballController extends Controller
{
    public function add()
    {
        return view('football.add');
    }

    public function doadd(Request $request)
    {
        $data=$request->all();
        $res=DB::table('guess')->insert($data);
        if($res){
            echo json_encode(['msg'=>1]);
        }else{
            echo json_encode(['msg'=>2]);
        }
    }

    public function index(Request $request)
    {
        $data=DB::table('guess')->get();
        return view('football.index', ['re' => $data]);
    }

    public function guess(Request $request)
    {
        $id=$_GET['id'];
        $qw=DB::table('quiz')->where('guess',$id)->first();
        if($qw){
            return view('football.error');
        }else{
            $user = DB::table('guess')->where('id',$id)->first();
            return view('football.guess', ['re' => $user]);
        }
    }

    public function doguess(Request $request)
    {
        $data=$request->all();
        //dd($data);
        $date['guess']=$data['guess'];
        $date['quiz']=$data['quiz'];
        $res=DB::table('quiz')->insert($date);
        if($res){
            return redirect('football/index');
        }else{
            return redirect('football/guess');
        }
    }

    public function goguess(Request $request)
    {
        $id=$_GET['id'];
        $res = DB::table('guess')->where('id', $id)->value('result');
        if($res){
            return view('football.errors');
        }else{
            $user = DB::table('guess')->where('id',$id)->first();
            return view('football.goguess', ['re' => $user]);
        }
    }

    public function result(Request $request)
    {
        $data=$request->all();
        //dd($data);
        $date['result']=$data['result'];
        $date['id']=$data['id'];
        $res=DB::table('guess')->where('id', $date['id'])->update(['result' => $date['result']]);
        if($res){
            return redirect('football/index');
        }else{
            return redirect('football/goguess');
        }
    }

    public function results(Request $request)
    {
        $id=$_GET['id'];
        $re=DB::table('guess')->join('quiz', 'guess.id', '=', 'quiz.guess')->where('id',$id)->first();
        if($re){
            return view('football.loindex', ['user' => $re]);
        }else{
            return view('football.errorss');
        }
    }
}