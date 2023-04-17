<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }
    public function follow($follow)
    {
        DB::table('follows')->insert([
            'follow' => $follow,
            'follower'=> Auth::id(),
        ]);

        return redirect('/search');
    }

    public function Delete($follow)
    {
        DB::table('follows')
            ->where([
                ['follow', $follow],
                ['follower', Auth::id()],
                ])
            ->delete();
            return redirect('/search');
    }
}