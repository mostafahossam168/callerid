<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoginCode;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getUser()
    {
        return $this->returnData(auth()->user());
    }
    public function login(Request $request)
    {
        $request->validate(['country_code' => 'required', 'phone' => 'required']);
        $user = User::wherePhone($request->phone)->where('type', 'client')->first();
        if (!$user) {
            return $this->returnError('البيانات غير صحيحه', 403);
        }
        $this->send_code($request->phone);
        return $this->returnSuccessMessage('تم ارسال الكود لهاتفك');
    }

    private function send_code($phone)
    {
        /* $test = [111111111, 222222222, 333333333];
        if (in_array($phone,$test)) {
            $code = 9999;
        } else {
            $code = random_int(1000, 9999);
        } */
        $code = 9999;
        return LoginCode::updateOrCreate(['phone' => $phone], ['code' => $code]);
    }





    public function register(Request $request)
    {
        $validation = [
            'country_code' => 'required',
            'name' => 'required',
            'phone' => ['required', 'unique:users,phone',],
            'password' => 'required',
        ];
        $data = $request->validate($validation);
        $data['type'] = 'client';
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $this->send_code($user->phone);
        return $this->returnSuccessMessage('تم ارسال الكود لهاتفك');
    }


    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:4',
            'fcm_token' => 'required',
            'device_id' => 'required'
        ]);
        $code = LoginCode::where('code', $request->code)->first();
        if (!$code) {
            return $this->returnError('البيانات غير صحيحه');
        }
        $user = User::wherePhone($code->phone)->first();
        if (!$user) {
            return $this->returnError('البيانات غير صحيحه');
        }
        $code->delete();
        $token = $user->createToken('authToken')->plainTextToken;
        $user->fcm_tokens()->updateOrCreate(['device_id' => $request->device_id], [
            'token' => $request->fcm_token,
            'device_id' => $request->device_id,
        ]);
        $user->token = $token;
        return $this->returnData($user, 'تم تسجيل الدخول بنجاح');
    }

    public function logout(Request $request)
    {
        $deviceId = $request->device_id;
        $user = auth()->user();
        // Revoke the token that was used to authenticate the user
        $user->currentAccessToken()->delete();
        if (!is_null($deviceId)) {
            if ($token = $user->fcTokens()->where('device_id', $deviceId)->first()) {
                $token->delete();
            }
        }

        return $this->returnSuccessMessage('تم تسجيل الخروج بنجاح');
    }


    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $validation = [
            'name' => 'required',
            'country_code' => 'required',
            'phone' => ['required', 'unique:users,phone,' . $user->id],
        ];
        $data = $request->validate($validation);
        $user->update($data);
        return $this->returnData($user, 'تم حفظ البيانات بنجاح');
    }
    public function changePassword(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'confirmed'],
        ]);
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            return $this->returnSuccessMessage('تم  حفظ البيانات بنجاح');
        }
        return $this->returnError('البيانات غير صحيحه');
    }
}
