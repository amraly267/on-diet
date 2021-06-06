<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\LoginRequest;
use App\Http\Requests\Dashboard\ForgetPasswordRequest;
use App\Http\Requests\Dashboard\ResetPasswordRequest;
use App\Notifications\Dashboard\ForgetPasswordEmail;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Http\Requests\Dashboard\ProfileRequest;
use Auth;
use DB;
use Str;

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->controllerResource = 'auth.';
        $this->storageFolder = Admin::storageFolder();
    }

    // === Open login Form ===
    public function loginForm()
    {
        return view(config('dashboard.resource_folder').$this->controllerResource.'login');
    }
    // === End function ===

    // === Submit login Form ===
    public function submitLogin(LoginRequest $request)
    {
        $data = ['email' => $request->email, 'password' => $request->password];

        if (Auth::guard('admin')->attempt($data))
        {
            return $this->successResponse(['redirect' => route('admin-home')]);
        }
        else
        {
            return $this->invalidResponse(['credential' => trans(config('dashboard.trans_file').'invalid_credentials')]);
        }
    }
    // === End function ===

    // === Open forget password Form ===
    public function forgetPasswordForm()
    {
        return view(config('dashboard.resource_folder').$this->controllerResource.'forget_password');
    }
    // === End function ===

    // === Submit forget password Form ===
    public function submitForgetPassword(ForgetPasswordRequest $request)
    {
        $existingAdmin = Admin::where('email', $request->email)->first();

        if($existingAdmin)
        {
            $token = Str::random(60);
            DB::table('admin_password_resets')->where('email', $request->email)->delete();
            DB::table('admin_password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $existingAdmin->notify(new ForgetPasswordEmail($token));
            return $this->successResponse(['message' => trans(config('dashboard.trans_file').'success_send')]);
        }
        else
        {
            return $this->invalidResponse(['email' => trans(config('dashboard.trans_file').'invalid_email')]);
        }
    }
    // === End function ===

    // === Reset password form ===
    public function resetPasswordForm(Request $request)
    {
        $existingResetPasswordRequest = DB::table('admin_password_resets')->where([['email', $request->email], ['token', $request->token]])->first();

        if($existingResetPasswordRequest)
        {
            $sentTime = new Carbon($existingResetPasswordRequest->created_at);
            $diffTime = $sentTime->diffInMinutes(Carbon::now());

            if($diffTime > config('auth.passwords.admins.expire'))
            {
                abort(419);
            }

            return view(config('dashboard.resource_folder').$this->controllerResource.'reset_password');
        }
        else
        {
            abort(404);
        }
    }
    // === End function ===

    // === Submit reset password ===
    public function submitResetPassword(ResetPasswordRequest $request)
    {
        $existingAdmin = Admin::where('email', $request->email)->first();
        $existingAdmin->password = bcrypt($request->password);
        $existingAdmin->save();
        DB::table('admin_password_resets')->where([['email', $request->email], ['token', $request->token]])->delete();
        return $this->successResponse(['redirect' => route('admin-login'), 'message' => trans(config('dashboard.trans_file').'success_reset_password')]);
    }
    // === End function ===

    // === Profile page ===
    public function profile()
    {
        return view(config('dashboard.resource_folder').$this->controllerResource.'profile', ['admin' => auth()->guard('admin')->user(), 'submitFormMethod' => 'put']);
    }
    // === End function ===

    // === Submit update profile ===
    public function updateProfile(ProfileRequest $request)
    {
        $admin = Admin::find(auth()->guard('admin')->user()->id);

        if($request->image_remove)
        {
            $this->removeImage($admin->image, $this->storageFolder);
            $admin->image = null;
        }

        if($request->hasFile('image'))
        {
            $this->removeImage($admin->image, $this->storageFolder);
            $admin->image = $this->uploadImage($request->image, $this->storageFolder);
        }

        if(strlen(trim($request->password)) > 0)
        {
            $admin->password = bcrypt($request->password);
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->save();

        return $this->successResponse(['message' => trans(config('dashboard.trans_file').'success_save')]);
    }
    // === End function ===

    // === Logout admin ===
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->to(route('admin-login'));
    }
    // === End function ===


}
