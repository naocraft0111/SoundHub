<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ログイン後の処理
    protected function authenticated(Request $request)
    {
        // フラッシュメッセージを表示
        toastr()->success('ログインしました');
        return redirect($this->redirectTo);
    }

    // ゲストユーザー用のユーザーIDを定数として定義
    private const GUEST_USER_ID = 1;

    // ゲストログイン処理
    public function guestLogin()
    {
        // id=1 のゲストユーザー情報がDBに存在すれば、ゲストログインする
        if (Auth::loginUsingId(self::GUEST_USER_ID)) {
            toastr()->success('ゲストユーザーでログインしました');
            return redirect($this->redirectTo);
        }
        toastr()->error('ゲストログインに失敗しました');
        return redirect('/');
    }

    public function redirectToProvider(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, string $provider)
    {
        $providerUser = Socialite::driver($provider)->stateless()->user();

        $user = User::where('email', $providerUser->getEmail())->first();

        if($user) {
            $this->guard()->login($user, true);
            return $this->sendLoginResponse($request);
        }

        return to_route('register.{provider}', [
            'provider' => $provider,
            'email' => $providerUser->getEmail(),
            'token' => $providerUser->token,
        ]);
    }

    public function loggedOut()
    {
        toastr()->success('ログアウトしました');
        return redirect('/');
    }
}
