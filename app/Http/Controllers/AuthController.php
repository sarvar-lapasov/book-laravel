<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserCreated;



class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['The provided credetials are incorrect'],
            ]);
        }

        return $this->success(
            '',
            ['token'=> $user->createToken($request->email)->plainTextToken]
        );

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

       return $request->session()->regenerateToken();
    }


    public function register(Request $request)
    {
        $validated = $request->validate([
            'username'=>'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        $user->roles()->attach(2);

 $users = User::get();
        $creator = [];
        foreach($users as $user){
            if($user->hasRole("creator")){
                $creator[] = $user;
            }
        }
        Notification::send($creator, new UserCreated($user));
        return $this->success('register', $user);
    }

    public function changePassword()
    {

    }

    public function user(Request $request)
    {
        return $this->response(new UserResource($request->user()));
    }
}
