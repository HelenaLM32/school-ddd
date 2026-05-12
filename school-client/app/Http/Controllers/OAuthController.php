<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirect(string $provider): RedirectResponse
    {
        $this->validateProvider($provider);
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        $this->validateProvider($provider);

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'OAuth authentication failed. Please try again.');
        }

        $user = User::updateOrCreate(
            [
                'provider'    => $provider,
                'provider_id' => $socialUser->getId(),
            ],
            [
                'name'   => $socialUser->getName() ?? $socialUser->getNickname(),
                'email'  => $socialUser->getEmail(),
                'avatar' => $socialUser->getAvatar(),
            ]
        );

        Auth::login($user, remember: true);

        return redirect()->intended(route('dashboard'));
    }

    private function validateProvider(string $provider): void
    {
        if (!in_array($provider, ['google'])) {
            abort(404);
        }
    }
}
