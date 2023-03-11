<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:15', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'regex:/\A([a-zA-Z0-9]{8,})+\z/u', 'min:8', 'confirmed'],
            'age' => ['nullable', 'sometimes', 'numeric', 'min:1', 'max:200']
        ]);
    }

    // ユーザー登録後の処理
    protected function registered(Request $request)
    {
        toastr()->success('ユーザー登録が完了しました');
        return redirect($this->redirectTo);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $age = isset($data['age']) ? $data['age'] : null;
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'age' => $age
        ]);
    }

    public function showProviderUserRegistrationForm(Request $request, string $provider)
    {
        $token = $request->token;

        $providerUser = Socialite::driver($provider)->userFromToken($token);

        return view('auth.social_register', [
            'provider' => $provider,
            'email' => $providerUser->getEmail(),
            'token' => $token,
        ]);
    }

    public function registerProviderUser(Request $request, string $provider)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:15', 'unique:users'],
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'regex:/\A([a-zA-Z0-9]{8,})+\z/u', 'min:8', 'confirmed'],
            'age' => ['nullable', 'sometimes', 'numeric', 'min:1', 'max:200']
        ]);

        $token = $request->token;

        $providerUser = Socialite::driver($provider)->userFromToken($token);

        $age = isset($request->age) ? $request->age : null;
        $user = User::create([
            'name' => $request->name,
            'email' => $providerUser->getEmail(),
            'password' => Hash::make($request['password']),
            'age' => $age
        ]);

        $this->guard()->login($user, true);
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }
}
