<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Expection;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Str;



class AuthController extends Controller

{
    use HttpResponses;
    public function register(RegisterRequest $request)
    {
        try {

            $validatedData = $request->validated();
            $existingUser = User::where('email', $validatedData['email'])->first();
            if ($existingUser) {
                return $this->error('email already exist', null, 400);
            }
            $user = User::create(
                [
                    'user_id' => Str::uuid(),
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    "password" => Hash::make($validatedData['password']),
                ]
            );
            $token =  $user->createToken("Api token for" . $user->name)->plainTextToken;
            return $this->success([
                //  "success"=> true ,
                "message" => "Registration successful.",
                "token" => $token,
            ]);
        } catch (\Exception $e) {
            Log::error("Registration error: " . $e->getMessage());
            return $this->error("Something went wrong", ["Payload error" => $e->getMessage()], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        $credentails = $request->only(['email', 'password']);

        if (!Auth::attempt($credentails)) {
            return $this->error('incorerct email or password');
        }

        $user = Auth::user();
        $token = $user->createToken("API token for " . $user->name . " " . $user->name)->plainTextToken; 
        
        return $this->success(
            [
                "message" => "Login successful",
                "user" => $user,
                "token" => $token
            ]


        );
    }
}
