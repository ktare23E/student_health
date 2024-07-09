<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //

    public function store(Request $request){
        $validatedRequest = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('nurse')->attempt($request->only('email', 'password'))) {
            $nurse = Auth::guard('nurse')->user();

            if ($nurse->type === 'school') {
                return redirect()->route('nurse_dashboard');
            } elseif ($nurse->type === 'district') {
                return redirect()->route('district_nurse_dashboard');
            } elseif ($nurse->type === 'division') {
                return redirect()->route('division_nurse_dashboard');
            }
        }

        if (Auth::attempt($validatedRequest)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.index');
            }
        }

        throw ValidationException::withMessages([
            'password' => 'The provided password does not match our records.'
        ]);
    }


    public function destroy(){
        Auth::logout();

        // Invalidate the session to prevent unauthorized access
        request()->session()->invalidate();
    
        // Regenerate the CSRF token to prevent any potential reuse
        request()->session()->regenerateToken();
    
        // Redirect to login page
        return redirect()->route('login');
    }
}
