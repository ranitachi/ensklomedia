<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
Use Illuminate\Http\Request; 
use App\Model\Users;
use App\User;
use App\Model\Profile;
use Auth;
use Socialite;
class LoginController extends Controller
{


    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function socialLogin($social) {
      return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social){
        // Socialite::driver('google')->scopes(['profile','email'])->redirect();
        
        $userSocial = Socialite::driver($social)->user();
        $user = Users::where(['email' => $userSocial->getEmail()])->first();
       
        if (!$user) 
        {
            $us=new Users;
            $us->email =  $userSocial->getEmail();
            $us->password =  bcrypt($userSocial->getEmail());
            $us->registration_ip=\Request::ip();
            $us->authentication_key='-';
            $us->authorization_level=4;
            $us->login_with=$social;
            $us->created_at=date('Y-m-d H:i:s');
            $us->updated_at=date('Y-m-d H:i:s');
            $us->save();
            
            $id_user=$us->id;
            $pr=new Profile;
            $pr->user_id=$id_user;
            $pr->name=$userSocial->getName();
            $pr->created_at=date('Y-m-d H:i:s');
            $pr->updated_at=date('Y-m-d H:i:s');
            $pr->save();


            $user2 = Users::where(['email' => $userSocial->getEmail()])->first();
           
        }

        $usr = User::where(['email' => $userSocial->getEmail()])->first();
        Auth::login($usr);
        
        return redirect()->action('DashboardController@index');
    }

    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }
    
    public function logout(Request $request) {
        Auth::logout();
        return redirect()->action('DashboardController@index');
    }
}
