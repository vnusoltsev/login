<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginAsUserRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginAsUserController extends Controller
{
    public function index()
    {
        return inertia('Auth/LoginAsUser');
    }

    public function create(LoginAsUserRequest $request)
    {
        /** @var  User $user */
        $email = $request->get('email');

        $user = User::query()->where(['email' => $email])->first();
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
