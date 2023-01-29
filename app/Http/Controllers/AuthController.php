<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rules;


class AuthController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            $user = Auth::user();
            Auth::login($user);
            $response = [
                'success' => true,
                'name' => $user->name,
                'token' => $user->createToken('MyApp')->plainTextToken,
                'message' => 'User login successfully'
            ];
            return response()->json($response,200);
        }
        $response = [
            'success' => false,
            'message' => 'Unauthorised User'
        ];

        return response()->json($response);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response($user, Response::HTTP_CREATED);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $providerUser = Socialite::driver($provider)->stateless()->user();
            $user = User::where('provider_id', $providerUser->getId())->first();
            if (!$user) {
                $new_user = User::create([
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'provider_id' => $providerUser->getId(),
                    'logo' => $providerUser->getAvatar()
                ]);
                Auth::login($new_user);
            } else {
                Auth::login($user);
            }
            return redirect()->intended('login');
        }catch (\Throwable $th){
            dd('Something went wrong'. $th->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['msg' => 'Logout Successfull']);

    }
}
