<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function loginSocial(Request $request, string $provider): RedirectResponse
    {
        $this->validateProvider($request);

        return Socialite::driver($provider)->redirect();
    }

    public function callbackSocial(Request $request, string $provider)
    {
        $this->validateProvider($request);

        $response = Socialite::driver($provider)->user();

        $user = User::firstOrCreate(
            ['email' => $response->getEmail()],
            ['password' => Str::password()]
        );

        $data = ['provider_id' => $response->getId()];

        if($user->wasRecentlyCreated){
            $first_last_name = explode(" ", $response->getName() ?? $response->getNickname());
            $data['first_name'] = $first_last_name[0];
            $data['last_name'] = $first_last_name[1];
            event(new Registered($user));
        }

        $user->update($data);

        Auth::login($user, remember:true);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function validateProvider(Request $request): array
    {
        return $this->getValidationFactory()->make(
            $request->route()->parameters(),
            ['provider' => 'in:facebook,google,github']
        )->validate();
    }
}
