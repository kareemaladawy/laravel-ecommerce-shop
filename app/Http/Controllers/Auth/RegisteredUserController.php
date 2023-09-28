<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\StoreUserRequest;
use App\Models\UserInfo;
use App\Providers\RouteServiceProvider;
use Monarobase\CountryList\CountryListFacade as Countries;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $countries = Countries::getList(app()->getLocale());
        return view('auth.register', compact('countries'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $request->validated();

        $user = User::create($request->only([
            'first_name', 'last_name',
            'email', 'password'
        ]));

        if($user){
            if(isset($request->city, $request->country, $request->phone_number)){
                if($user->info){
                    $user->info->update([
                        'city' => $request->city,
                        'country' => $request->country,
                        'phone_number' => $request->phone_number
                    ]);
                } else {
                    $user->info()->create([
                        'city' => $request->city,
                        'country' => $request->country,
                        'phone_number' => $request->phone_number
                    ]);
                }
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
