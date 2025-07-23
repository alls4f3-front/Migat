<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\Admin\UserResource;
use App\Http\Traits\UserResponseTrait;
use App\Mail\UserOtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    use UserResponseTrait;

    public function register(RegisterRequest $request)
    {
        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'otp_code' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new UserOtpMail($otp));

        return $this->success([], 'Registered successfully. OTP sent to your email.');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)
            ->where('role', 'user')
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->fail('Invalid credentials', 401);
        }

        if (!$user->otp_code || $user->otp_expires_at < now()) {
            return $this->fail('Your OTP is not verified or expired.', 403);
        }

        $token = $user->createToken('user_token')->plainTextToken;
        $user->token = $token;

        return $this->success(new UserResource($user), 'Login successful');
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->success(null, 'Logout successful');
    }
}
