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
            }elseif(Auth::user()->type == 'school'){
                return redirect()->route('business_admin.index');
            }elseif(Auth::user()->type == 'district'){
                return redirect()->route('admin.index');
            }elseif(Auth::user()->type == 'division'){
                return redirect()->route('business_admin.index');
            }        
        }

        return back()->with('status', 'Invalid login details');
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
