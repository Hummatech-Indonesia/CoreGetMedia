<?php

namespace App\Services\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use SebastianBergmann\Type\VoidType;

class LoginService
{
    public function __construct()
    {
    }

    /**
     * Handle a login request to the application.
     *
     * @param LoginRequest $request
     * @return void
     *
     * @throws ValidationException
     */


    public function handleLogin(LoginRequest $request)
    {
        $data = $request->validated();
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = auth()->user();

        if (!$user->email_verified_at) {
            auth()->logout();
            return back();
        }

            $role = auth()->user()->roles->pluck('name')[0];
            switch ($role) {
                case "user":
                    return redirect('profile-user');
                    break;
                case "author":
                    return redirect('profile-author');
                    break;
                case 'admin':
                    return redirect('dashboard');
                    break;
                case 'super admin':
                    return redirect('dashboard');
                    break;
                default:
                    return redirect()->back()->withErrors("Ada Yang Salah");
                    break;
            }
        } else {
            return redirect()->back()->withErrors(trans('auth.login_failed'))->withInput();
        }
    }
}
