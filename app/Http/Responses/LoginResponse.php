<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;

class LoginResponse implements ContractsLoginResponse
{
    public function toResponse($request)
    {
        $user = Auth::user();

        if ($user->isAdmin() || $user->isSuperAdmin()) {
            return redirect()->route('admin.index');
        }
        elseif ($user->isVendor()) {

            return redirect()->route('vendor.index');
        }
        elseif ($user->isWriter()) {

            return redirect()->route('writer.index');
        }
        elseif ($user->isAgent()) {

            return redirect()->route('agent.index');
        }
        elseif ($user->isDefault()) {

            return redirect()->route('preference.show');
        }
        return redirect()->intended(config('fortify.home'));
    }
}
