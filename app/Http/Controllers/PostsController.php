<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function index(){
        $follow_counts = DB::table('follows')
                ->where('follower',Auth::id())
                ->count();
        $follower_counts = DB::table('follows')
                ->where('follow',Auth::id())
                ->count();
        $posts = DB::table('posts')
                ->leftJoin('users','posts.user_id','=','users.id')
                ->join('follows','posts.user_id','=','follows.follow')
                ->where('follower',Auth::id())
                ->orWhere('posts.user_id',Auth::id())
                ->select('posts.posts','users.username','posts.user_id as uid','posts.id as pid','posts.created_at')
                ->get();
        return view('posts.index',['posts'=>$posts,'follow_counts'=>$follow_counts,'follower_counts'=>$follower_counts])
        ;
    }

    public function followlist(){
        $follow_counts = DB::table('follows')
                ->where('follower',Auth::id())
                ->count();
        $follower_counts = DB::table('follows')
                ->where('follow',Auth::id())
                ->count();
        $followNumbers =  DB::table('follows')
                ->where('follower',Auth::id())
                ->pluck('follow');
        $follow= DB::table('users')
        ->leftJoin('posts','posts.user_id','=','users.id')
        ->join('follows','users.id','=','follows.follow')
        ->where('follower',Auth::id())
        ->select('users.id as uid','posts.id as pid', 'posts.posts','users.username','users.images')
        ->get();
        return view('follows.followList',['followNumbers'=>$followNumbers,'follow'=>$follow,'follow_counts'=>$follow_counts,'follower_counts'=>$follower_counts]);
    }

    public function followerlist(){
        $follow_counts = DB::table('follows')
        ->where('follower',Auth::id())
        ->count();
        $follower_counts = DB::table('follows')
        ->where('follow',Auth::id())
        ->count();
        $followNumbers =  DB::table('follows')
                ->where('follower',Auth::id())
                ->pluck('follow');
        $follower= DB::table('users')
        ->leftJoin('posts','posts.user_id','=','users.id')
        ->join('follows','users.id','=','follows.follower')
        ->where('follow',Auth::id())
        ->select('users.id as uid','posts.id as pid', 'posts.posts','users.username','users.images','follows.follower')
        ->get();
        return view('follows.followerList',['followNumbers'=>$followNumbers,'follower'=>$follower,'follow_counts'=>$follow_counts,'follower_counts'=>$follower_counts]);
    }

    public function create(Request $request)
    {
        $post = $request->input('newPost');
        DB::table('posts')->insert([
            'posts' => $post,
            'user_id'=> Auth::id(),
            'created_at'=>now()
        ]);
 
        return redirect('/top');
    }

    public function updateform(Request $request,$id){
        $up_post =$request->input('updatePost');
        DB::table('posts')
        ->where('id',$id)
        ->update(
            ['posts' => $up_post]
        );
        return redirect('/top');
    }

    public function delete($id){
        DB::table('posts')
        ->where('id',$id)
        ->delete();

        return redirect('/top');
    }
}
