<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AuthenticatesUsers;
use App\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    protected $redirectTo = '/admin/dashboard'; // Điều hướng sau khi đăng nhập thành công

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout'); // Sử dụng middleware 'guest:admin'
    }

    function adminLogin()
    {
        return view('admins.login');
    }

    function adminHandleLogin(Request $request)
    {
        // return $request->all();
        $remember = ($request->has('remember')) ? true : false;

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect()->route('adminDashboard');
        } else {
            return redirect()->back()->with('errorLogin', 'Thông tin email hoặc mật khẩu không chính xác');
        }
    }
    function userHandleRegister(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ], [
            'name.required' => 'Vui lòng điền tên tài khoản',
            'name.string' => 'Tên tài khoản không hợp lệ',
            'name.max' => 'Tên tài khoản tối đa 255 ký tự',
            'email.required' => 'Vui lòng điền chính xác email',
            'email.string' => 'Email không hợp lệ',
            'email.email' => 'Email không hợp lệ',
            'email.max' => 'Email không quá 255 ký tự',
            'email.unique' => 'Email đã được dùng',
            'password.required' => 'Vui lòng điền mật khẩu',
            'password.string' => 'Mật khẩu không hợp lệ',
            'password.min' => 'Mật khẩu phải ít nhất 8 ký tự',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu',
            'password_confirmation.string' => 'Xác nhận mật khẩu không hợp lệ',
            'password_confirmation.min' => 'Xác nhận mật khẩu phải ít nhất 8 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không thành công',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('userLogin')->with([
            'status' => 'Đăng ký thành công, mời đăng nhập!',
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }

    function userHandleResetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'email_exists'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ], [
            'email.required' => 'Vui lòng điền chính xác email',
            'email.string' => 'Email không hợp lệ',
            'email.email' => 'Email không hợp lệ',
            'email.max' => 'Email không quá 255 ký tự',
            'email.email_exists' => 'Email không tồn tại',
            'password.required' => 'Vui lòng điền mật khẩu',
            'password.string' => 'Mật khẩu không hợp lệ',
            'password.min' => 'Mật khẩu phải ít nhất 8 ký tự',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu',
            'password_confirmation.string' => 'Xác nhận mật khẩu không hợp lệ',
            'password_confirmation.min' => 'Xác nhận mật khẩu phải ít nhất 8 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không thành công',
        ]);
        User::where('email', $request->email)->update([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('userLogin')->with([
            'status' => 'Đặt lại mật khẩu thành công, mời đăng nhập!',
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }

    function userHandleLogout()
    {
        Auth::logout();
        return redirect()->route('userLogin');
    }
    function adminDashboard()
    {
        return "ok";
    }
}
