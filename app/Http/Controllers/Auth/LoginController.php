<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Passport\HasApiTokens;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

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
     use HasApiTokens;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
        protected $redirectTo = '/profile';

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
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        // $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $authenticated = $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());

        $user = User::find($authenticated->id);
        $output = [
            'access_token' => $authenticated->access_token,
            'data' => $user,
            'message' => "Login Successfully"
        ];

        activity('login')->by($user)->log('Login Successfully');


        return response()->json($output, Response::HTTP_OK);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        
        $scopes = ['check-profile'];

        $user->access_token = $token = $user->createToken('devkind', $scopes)->accessToken;
        return $user;
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        $user = auth('api')->user()->token();
          activity('logout')->by(auth('api')->user())->log('Logout Successfully');

        $user->revoke();

         

        return response()->json(Response::HTTP_UNAUTHORIZED);
        
    }

}
