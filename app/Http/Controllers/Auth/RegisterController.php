<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ],[
            'name.required'=>'Vui lòng điền tên tài khoản',
            'name.string'=>'Tên tài khoản không hợp lệ',
            'name.max'=>'Tên tài khoản tối đa 255 ký tự',
            'email.required'=>'Vui lòng điền chính xác email',
            'email.string'=>'Email không hợp lệ',
            'email.email'=>'Email không hợp lệ',
            'email.max'=>'Email không quá 255 ký tự',
            'email.unique'=>'Email đã được dùng',
            'password.required'=>'Vui lòng điền mật khẩu',
            'password.string'=>'Mật khẩu không hợp lệ',
            'password.min'=>'Mật khẩu phải ít nhất 8 ký tự',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu',
            'password_confirmation.string' => 'Xác nhận mật khẩu không hợp lệ',
            'password_confirmation.min' => 'Xác nhận mật khẩu phải ít nhất 8 ký tự',
            'password.confirmed'=>'Xác nhận mật khẩu không thành công', 
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
