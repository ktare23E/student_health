<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    //

    public function store(Request $request){
        $validatedRequest = request()->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if(!Auth::attempt($validatedRequest)){
            throw ValidationException::withMessages([
                'password' => 'Sorry, those credentials does not exist.'
            ]);
        }
        
        if(Auth::attempt($validatedRequest)){
            //check user type and redirect accordingly
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.index');
            }   
        }

        if (Auth::guard('nurse')->attempt($request->only('email', 'password'))) {
            return 'dre sulod ning gana';
            $nurse = Auth::guard('nurse')->user();

            if ($nurse->type === 'school') {
                return 'Kani ang ning gana';
            } elseif ($nurse->type === 'district') {
                return redirect()->intended('/nurse/district/dashboard');
            } elseif ($nurse->type === 'division') {
                return redirect()->intended('/nurse/division/dashboard');
            }
        }

        return 'error tanan';
        // return back()->with('status', 'Invalid login details');
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
