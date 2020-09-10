<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $redirectTo;

    public function redirectTo(){
        switch (Auth::user()->user_type){
            case 'teacher':
                $this->redirectTo = '/home';
                return $this->redirectTo;
                break;

            case 'assistant':
                $this->redirectTo = '/posts';
                return $this->redirectTo;
                break;

            case 'student':
                $this->redirectTo = '/subjects';
                return $this->redirectTo;
                break;
        }
    }

    public function __construct()
    {
        //$this->middleware('admin')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
        {
            return redirect()->route('subjects');
        }else{
            return redirect()->route('clientLogin')
                ->with('error','Email-Address And Password Are Wrong.');
        }

    }
}
