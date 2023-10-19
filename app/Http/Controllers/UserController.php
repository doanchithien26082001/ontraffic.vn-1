<?php

namespace App\Http\Controllers;

use App\BankAcount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\QrPayment;
use App\Payment;
use App\SupportType;
use App\Support;
use App\AdminSupportResponse;
use App\Level;
use App\UserResponse;
use App\SupportImage;
use App\UserLevel;
use App\TimeOnsitePrice;
use App\UserSupportResponse;

class UserController extends Controller
{
    function userLogin()
    {
        if (Auth::check())
            return redirect()->route('userDashboard');
        return view('auth.login');
    }

    function userHandlelogin(Request $request)
    {
        $remember = ($request->has('remember')) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember))
            return redirect()->route('userDashboard');
        return redirect()->back()->with('errorLogin', 'Thông tin email hoặc mật khẩu không chính xác');
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
        $lastUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'transfer_content' => Str::upper(Str::random(5) . substr(time(), -2)),
            'password' => Hash::make($request->password),
            'total_money' => 0,
            'coin' => 0,
        ]);
        //Save QR Payment 
        $dataBank = BankAcount::all();
        foreach ($dataBank as $bank) {
            $imagePath = 'https://img.vietqr.io/image/' . $bank->bank_id . '-' . $bank->acount_number . '-icInBDc.jpg?&addInfo=' . $lastUser->transfer_content . '&accountName=' . str_replace(' ', '%', $bank->acount_name);
            $imageData = file_get_contents($imagePath);
            $imageName = time() . '_' . uniqid() . '.jpg';
            $publicPath = public_path('client/images/qr-payment');
            file_put_contents($publicPath . '/' . $imageName, $imageData);
            QrPayment::create([
                'qr_img' => 'client/images/qr-payment/' . $imageName,
                'user_id' => $lastUser->id,
                'bank_acount_id' => $bank->id
            ]);
        }
        UserLevel::create([
            'user_id' => $lastUser->id,
            'level_id' => 1
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

    function userDashboard()
    {
        $user = Auth::user();
        $userLevel = $user->userLevels->first()->level->level_name;
        return view('users.dashboard', compact('userLevel'));
    }

    function userAcount()
    {
        return view('users.acount');
    }

    function userHandleUpdateInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id . 'id',
            'number_phone' => 'max:255',
        ], [
            'name.string' => 'Tên không hợp lệ',
            'name.required' => 'Vui lòng không bỏ trống Tên tài khoản',
            'name.max' => 'Tên tối đa 255',
            'email.email' => 'Email không hợp lệ',
            'email.required' => 'Vui lòng không bỏ trống Email',
            'email.unique' => 'Email đã được sử dụng',
            'email.max' => 'Email tối đa 255 ký tự',
            'number_phone.max' => 'Số điện thoại quá giới hạn',
        ]);
        User::where('id', Auth::user()->id)->update(['name' => $request->name, 'email' => $request->email, 'number_phone' => $request->number_phone]);
        return redirect()->back()->with(['update-info' => 'Cập nhật thông tin thành công']);
    }

    function userHandleUpdatePassword(Request $request)
    {
        $currentUser = Auth::user();
        if (!Hash::check($request->old_password, $currentUser->password)) {
            return redirect()->back()->with('old_password', 'Mật khẩu hiện tại không đúng');
        }
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ], [
            'password.required' => 'Vui lòng điền mật khẩu',
            'password.string' => 'Mật khẩu không hợp lệ',
            'password.min' => 'Mật khẩu phải ít nhất 8 ký tự',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu',
            'password_confirmation.string' => 'Xác nhận mật khẩu không hợp lệ',
            'password_confirmation.min' => 'Xác nhận mật khẩu phải ít nhất 8 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không thành công',
        ]);
        User::where('id', $currentUser->id)->update(['password' => $request->password]);
        return redirect()->back()->with(['update-password' => 'Cập nhật mật khẩu thành công']);
    }

    function userPayment(Request $request)
    {
        $transactionHistory = Payment::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('users.payment', compact('transactionHistory'));
    }

    function findHistory(Request $request)
    {
        $valueInput = $request->value;
        $valueHistory = Payment::where('id_payment', 'LIKE', '%' . $valueInput . '%')->get();
        $result = "";
        if ($valueHistory->count() > 0)
            foreach ($valueHistory as $value) {
                $result .= "<tr>
                              <td class='text-center align-middle text-no-wrap'>
                                " . $value->id_payment . "</td>
                              <td class='text-center align-middle text-no-wrap'>
                                " . date('H:i d/m/Y', strtotime($value->created_at)) . "</td>
                              <td class='text-center align-middle text-no-wrap'>
                                " . number_format($value->money, 0, ',', '.') . " đ</td>
                              <td class='text-center align-middle text-no-wrap'>
                                " . number_format($value->money_total, 0, ',', '.') . " đ</td>
                           </tr>";
            }
        else {
            $result = "<tr>
                        <td colspan='4' class='text-left align-middle text-no-wrap text-bold'>Không tìm thấy ID nạp <strong>'" . $valueInput . "'</strong></td>
                    </tr>";
        }
        return response()->json($result);
    }

    function createSupport(Request $request)
    {
        $supportTypes = SupportType::all();
        return view('users.create-support', compact('supportTypes'));
    }
    function userSupport(Request $request)
    {
        $listSupport = Support::join('support_types', 'support_types.id', '=', 'supports.sp_type_id')
            ->where('user_id', Auth::user()->id)
            ->select('supports.id_support', 'supports.status', 'supports.created_at', 'support_types.name')
            ->orderBy('created_at', 'DESC')
            ->get();
        if ($request->status) {
            switch ($request->status) {
                case "pendding":
                    $listSupport = Support::join('support_types', 'support_types.id', '=', 'supports.sp_type_id')
                        ->where([
                            ['user_id', Auth::user()->id],
                            ['supports.status', 'Chờ hỗ trợ'],
                        ])
                        ->select('supports.id_support', 'supports.status', 'supports.created_at', 'support_types.name')
                        ->orderBy('created_at', 'DESC')
                        ->get();
                    break;
                case "progress":
                    $listSupport = Support::join('support_types', 'support_types.id', '=', 'supports.sp_type_id')
                        ->where([
                            ['user_id', Auth::user()->id],
                            ['supports.status', 'Đang hỗ trợ'],
                        ])
                        ->select('supports.id_support', 'supports.status', 'supports.created_at', 'support_types.name')
                        ->orderBy('created_at', 'DESC')
                        ->get();
                    break;
                default:
                    $listSupport = Support::join('support_types', 'support_types.id', '=', 'supports.sp_type_id')
                        ->where([
                            ['user_id', Auth::user()->id],
                            ['supports.status', 'Đã hỗ trợ'],
                        ])
                        ->select('supports.id_support', 'supports.status', 'supports.created_at', 'support_types.name')
                        ->orderBy('created_at', 'DESC')
                        ->get();
            }
        }

        $supportTypes = SupportType::all();
        return view('users.support', compact('supportTypes', 'listSupport'));
    }
    function renderSupport(Request $request)
    {
        if ($request->sp_type_id) {
            $listSupport = Support::join('support_types', 'support_types.id', '=', 'supports.sp_type_id')
                ->where([
                    ['user_id', Auth::user()->id],
                    ['support_types.id', $request->sp_type_id],
                ])
                ->select('supports.id_support', 'supports.status', 'supports.created_at', 'support_types.name')
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $listSupport = Support::join('support_types', 'support_types.id', '=', 'supports.sp_type_id')
                ->where('user_id', Auth::user()->id)
                ->select('supports.id_support', 'supports.status', 'supports.created_at', 'support_types.name')
                ->orderBy('created_at', 'DESC')
                ->get();
        }
        $dataRender = "";
        if ($listSupport->count() > 0) {
            foreach ($listSupport as $support) {
                $dataRender .= " <a href='" . route('getSupportById', $support->id_support) . "' class='card-body p-2 mb-1 bg-custom-01 bd-style-1 support-item'>
                <div class='row'>
                    <div class='col-auto mb-1'>
                        <img src='" . asset('client/images/user.png') . "'
                            style='width:50px;height:auto'>
                    </div>
                    <div class='col'>
                        <div class='row gx-1'>
                            <div class='col-12'>
                                <div class='row gx-1'>
                                    <div class='col-auto'>
                                        <span class='badge rounded-pill bg-primary'>Hỗ trợ
                                            " . $support->name . "</span>
                                        <span
                                            class='badge rounded-pill bg-warning'>" . $support->status . "</span>
                                    </div>
                                </div>
                            </div>
                            <div class='col-12'>
                                <span class='badge rounded-pill bg-light text-dark'><i
                                        class='bi bi-clock'></i>
                                    " . date('H:i d/m/Y', strtotime($support->created_at)) . "</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>";
            }
        } else {
            $dataRender = "<a href='' class='card-body p-2 mb-1 bg-custom-01 bd-style-1'>
                            <div class='row'>
                               <div class='col-12'>
                                   <p class='mb-0'>Chưa có dữ liệu cho nội dung này!</p>
                                </div>
                            </div>
                        </a>";
        }
        return response()->json($dataRender);
    }
    function getSupportById(Request $request, $id)
    {
        $support = Support::where('id_support', $id)->first();
        $userResponses = UserSupportResponse::all();
        return view('users.detail-support', compact('support', 'userResponses'));
    }
    function userResponse(Request $request, $id)
    {
        $request->validate([
            'response_detail' => 'required',
        ], [
            'response_detail.required' => 'Vui lòng nhập phản hồi'
        ]);
        UserSupportResponse::create([
            'admin_rp_id' => $id,
            'responses_detail' => $request->response_detail
        ]);
        return redirect()->back();
    }
    function completedSupport(Request $request, $id)
    {
        Support::where('id_support', $id)->update([
            'status' => 'Đã hỗ trợ'
        ]);
        return redirect('support?status=completed');
    }
    function handleSupport(Request $request)
    {
        $request->validate([
            'sp_type_id' => 'required',
            'support_title' => 'required|string|max:255',
            'support_detail' => 'required',
            'img_upload' => 'max:4000',
            'img_upload.*' => 'max:1000|mimes:jpeg,jpg,png,gif,webp',
        ], [
            'support_type.required' => 'Mời chọn vấn đề cần hỗ trợ',
            'support_title.required' => 'Mời nhập tiêu đề hỗ trợ',
            'support_title.string' => 'Mời nhập tiêu đề hỗ trợ hợp lệ',
            'support_title.max' => 'Tiêu đề hỗ trợ tối đa 255 ký tự',
            'support_title.required' => 'Mời nhập tiêu đề hỗ trợ',
            'support_detail.required' => 'Mời nhập nội dung hỗ trợ',
            'img_upload.max' => 'Dung lượng tất cả ảnh không quá 4MB',
            'img_upload.*.max' => 'Dung lượng mỗi ảnh không quá 1MB',
            'img_upload.*.mimes' => 'Tất cả ảnh phải thuộc loại jpeg, jpg, png, gif',
        ]);
        $lastId = Support::create([
            'id_support' => Str::upper(Str::random(5) . substr(time(), -1)),
            'sp_type_id' => $request->sp_type_id,
            'support_title' => $request->support_title,
            'support_detail' => $request->support_detail,
            'status' => 'Chờ hỗ trợ',
            'user_id' => Auth::user()->id,
        ]);
        if ($request->img_upload) {
            $files = $request->img_upload;
            $urlImgs = [];
            foreach ($files as $file) {
                $info = pathinfo($file->getClientOriginalName());
                $fileName = $info['filename'];
                $extension = $info['extension'];
                $fullName = time() . '-' . Str::slug($fileName) . '.' . $extension;
                $file->move(public_path('client/uploads/support-img'), $fullName);
                $src = 'client/uploads/support-img/' . $fullName;
                $urlImgs[] = $src;
            }
            foreach ($urlImgs as $urlImg) {
                SupportImage::create([
                    'support_id' => $lastId->id_support,
                    'url_img' => $urlImg
                ]);
            }
        }
        return redirect('support?status=pendding');
    }

    function run()
    {
        Artisan::call('storage:link', []);
        $output = Artisan::output(); // Lấy kết quả trả về từ lệnh
        if (strpos($output, 'The [public/storage] directory has been linked.') !== false) {
            return "Liên kết tạo thành công!";
        } else {
            return "Liên kết đã tồn tại hoặc có lỗi xảy ra.";
        }
    }
    function random()
    {
        $minPrice = TimeOnsitePrice::orderBy('price', 'asc')->limit(1)->first()->price;
        return $minPrice;
        // $userId = Auth::user()->id;
        // $timeOnsiteId = $request->value;
        // $userLevelId = UserLevel::where('user_id', $userId)->first()->level_id;
        $timeOnsitePrice = TimeOnsitePrice::where([
            ['time_onsite_id', 1],
            ['level_id', 3]
        ])->get();
        return $timeOnsitePrice;
        return Str::upper(Str::random(5) . substr(time(), -3));
    }

}
