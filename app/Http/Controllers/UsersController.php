<?php

namespace App\Http\Controllers;
use App\User;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function profile(){
        $follow_counts = DB::table('follows')
                ->where('follower',Auth::id())
                ->count();
        $follower_counts = DB::table('follows')
                ->where('follow',Auth::id())
                ->count();
        return view('users.profile',['follow_counts'=>$follow_counts,'follower_counts'=>$follower_counts]);
    }
    public function search(){
        $follow_counts = DB::table('follows')
                ->where('follower',Auth::id())
                ->count();
        $follower_counts = DB::table('follows')
                ->where('follow',Auth::id())
                ->count();
        return view('users.search',['follow_counts'=>$follow_counts,'follower_counts'=>$follower_counts]);
    }

    public function index(Request $request){
        $keyword = $request->input('keyword');

        if(!empty($keyword)){
            $query= DB::table('users')
            ->where('username','LIKE',"%{$keyword}%");
        }
        $username = $query->get();

        $followNumbers =  DB::table('follows')
                ->where('follower',Auth::id())
                ->pluck('follow');


        $follow_counts = DB::table('follows')
                ->where('follower',Auth::id())
                ->count();
        $follower_counts = DB::table('follows')
                ->where('follow',Auth::id())
                ->count();

        return view('users.result',['keyword'=>$keyword,'followNumbers'=>$followNumbers,'follow_counts'=>$follow_counts,'follower_counts'=>$follower_counts,'username'=>$username]);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:4',
            'file_name'=>['file','mimes:jpeg,png,jpg,bmb','max:2048','nullable'],
        ],[
            'username.required' => '名前は必須項目です',
            'username.max' => '255文字以内で入力してください',
            'mail.required' => 'メールアドレスは必須項目です',
            'mail.email' => 'メールアドレス形式で入力してください',
            'mail.max' => '255文字以内で入力してください',
            'password.min' => 'パスワードは4文字以上です',
            'password.confirmed' => 'パスワード確認と同じ値を入れてください',
            'password_confirmation.min' => 'パスワード確認は4文字以上です',
            'file_name.mines' => '画像はjpeg,png,jpg,bmbで保存してください',
            ])->validate();
    }

    public function form(Request $request){
        $data = $request->input();
        $this->validator($data);
        $id = $request->input('id');
        $up_username = $request->input('username');
        $up_mail = $request->input('mail');
        $up_bio = $request->input('bio');
        $file = $request->file('file_name');
        if($file){
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $target_path = public_path('/uploads/');
        $file->move($target_path,$fileName);
        if($up_password = $request->input('password')){
        DB::table('users')
        ->where('id',$id)
        ->update(
                ['username' =>$up_username 
                ,'mail' =>$up_mail 
                ,'password' => bcrypt($up_password) 
                ,'bio' =>$up_bio 
                ,'images' =>$fileName]
        );
        }else{
        DB::table('users')
        ->where('id',$id)
        ->update(
                ['username' =>$up_username 
                ,'mail' =>$up_mail 
                ,'bio' =>$up_bio 
                ,'images' =>$fileName]
                );

        }}else{
        if($up_password = $request->input('password')){
                 DB::table('users')
                 ->where('id',$id)
                 ->update(
                        ['username' =>$up_username 
                        ,'mail' =>$up_mail 
                        ,'password' =>bcrypt($up_password) 
                        ,'bio' =>$up_bio 
                        ]
                        );
        }else{
                DB::table('users')
                ->where('id',$id)
                ->update(
                        ['username' =>$up_username 
                        ,'mail' =>$up_mail 
                        ,'bio' =>$up_bio 
                        ]
                        );
                
        }
        }
        return redirect('/profile');
    }

    public function followerprofile($id){
        $follow_counts = DB::table('follows')
                ->where('follower',Auth::id())
                ->count();
        $follower_counts = DB::table('follows')
                ->where('follow',Auth::id())
                ->count();
        $user= DB::table('users')
                ->where('id',$id)
                ->first();
        $follows= DB::table('posts')
                ->join('users','posts.user_id','=','users.id')
                ->where('posts.user_id',$id)
                ->select('users.id as uid', 'posts.posts','users.username','users.images','posts.created_at as created_at','users.bio')
                ->get();
        $followNumbers =  DB::table('follows')
                ->where('follower',Auth::id())
                ->pluck('follow');
        return view('follows.followProfile',['user'=>$user,'followNumbers'=>$followNumbers,'follows'=>$follows,'follow_counts'=>$follow_counts,'follower_counts'=>$follower_counts]);
    }


}
