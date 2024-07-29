<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web', ['except' => ['logout']]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login')->with('title', 'Авторизация');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request): RedirectResponse
    {
        // Validate the form data
        $this->validate($request, [
            'login'   => 'required',
            'password' => 'required|min:6'
        ]);

        // Attempt to log the user in
        if (Auth::guard('web')->attempt(['login' => $request->login, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('admin.index'));
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->route('login')->with('error', "Неверный логин или пароль!");
    }

    /**
     * @return RedirectResponse
     */
    protected function authenticated(): RedirectResponse
    {
        return redirect()->route('admin.index');
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::guard('web')->logout();

        return  redirect()->route('login');
    }
}
