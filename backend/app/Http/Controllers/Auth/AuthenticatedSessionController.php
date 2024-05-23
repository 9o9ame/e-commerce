<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function storeAjax(LoginRequest $request)
    {
         if($request->ajax()){
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
            // Retrieve the user by email
            $user = User::where('email', $request->email)->first();

            // Check if user exists
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            if (Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Credentials are correct'], 200);
            } else {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
         }
    }
    public function store(LoginRequest $request): RedirectResponse
    {
         
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard.index', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
