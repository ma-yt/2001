<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Category;
use App\Models\News;
class LoginController extends Controller
{
    public function login(){
        return view('xinwen.login');
    }

    public function logindo(){
        $data = request()->all();
        $res = Admin::where('username','=',$data['username'])->first();
        if(!$res){
            return redirect('/login');
        }

        if($data['pwd']!=($res->pwd)){
            return redirect('/login')->with('msg','密码错误');
        }

        return redirect('/news');
    }

    public function news(){
        $res = Category::get();
        return view('xinwen.tj',['res'=>$res]);
    }

    public function create(Request $request){
        $data = request()->except('_token');
        $res = News::create($data);

        if($res){
            return redirect('/index');
        }
    }

    public function index(){
           $res = News::all();
        return view('xinwen.index',['res'=>$res]);
    }
}
