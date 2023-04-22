<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'nik' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ])->onlyInput('nik');
    }

    public function changePass(Request $request) {
        $validator = Validator::make($request->all(),[
            'currentPass' => 'required',
            'password' => 'required',
            'confirmPass' => 'required',
        ], [
            'currentPass.required' => "Current password field is required",
            'password.required' => "New password field is required",
            'confirmPass.required' => "Confirmation password field is required",
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation errors', $validator->errors(), 422);
        }

        if (!Hash::check($request->currentPass, Auth::user()->password)) {
            return $this->errorResponse('Credential error', 'Your current password didn\'t match our record.', 400);
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->successResponse("", "Password successfuly changed.");
        // $this->logout();
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('login');
    }

    
}
