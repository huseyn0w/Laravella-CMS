<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use Socialite;


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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findUser($user);

        if($authUser)
        {
            Auth::login($authUser, true);
            return redirect($this->redirectTo);
        }

        $validator = $this->validateSocialUser($user);

        if(gettype($validator) === "object")
        {
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }


        $registered_user = $this->createUser($user, $provider);
        Auth::login($registered_user, true);
        return redirect($this->redirectTo);


    }

    private function findUser($user)
    {

        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) return $authUser;


    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function createUser($user, $provider)
    {

        $username = $this->get_user_name($user->email);

        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'username' => $username
        ]);


    }

    private function validateSocialUser($data)
    {
        $username = $this->get_user_name($data->email);

        $array_to_validate = [
            "email" => $data->email,
            "name" => $data->name,
            "username" => $username
        ];

        $validator = Validator::make($array_to_validate, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
        ]);

        if ($validator->fails()) {
            return $validator;
        }

        return true;
    }

    private function get_user_name(string $email):string
    {
        $position = strpos( $email,"@");
        $username =  substr($email,0, $position);

        return $username;
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
}
