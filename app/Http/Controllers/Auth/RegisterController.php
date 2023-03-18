<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'required|string|min:4',
        ],[
            'username.required' => '名前は必須項目です',
            'username.max' => '255文字以内で入力してください',
            'mail.required' => 'メールアドレスは必須項目です',
            'mail.email' => 'メールアドレス形式で入力してください',
            'mail.max' => '255文字以内で入力してください',
            'password.required' => 'パスワードは必須項目です',
            'password.min' => 'パスワードは4文字以上です',
            'password.confirmed' => 'パスワード確認と同じ値を入れてください',
            'password_confirmation.required' => 'パスワード確認は必須項目です',
            'password_confirmation.min' => 'パスワード確認は4文字以上です',
            ])->validate();
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            $this->validator($data);

            $this->create($data);
            $username = $request -> input('username');
            return redirect('added') -> with('username',$username);
        }
        return view('auth.register');
    }

    public function added(){
        return view('auth.added');
    }
}
