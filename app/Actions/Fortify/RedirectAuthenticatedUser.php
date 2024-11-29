<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;

class RedirectAuthenticatedUser implements LoginResponse
{
    public function toResponse($request)
    {
        if (auth()->user()->role === 'staff') {
            return redirect()->intended(route('staff.home'));
        }

        return redirect()->intended(route('dashboard'));
    }
} 