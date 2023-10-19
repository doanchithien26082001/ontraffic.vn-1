<?php

namespace App\Http\Controllers;

use App\TrafficType;
use App\Device;
use App\TimeOnsite;
use App\TimeOnsitePrice;
use App\UserLevel;
use App\Traffic;
use App\TrafficDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TrafficController extends Controller
{
    function getTotalBuyTraffic(Request $request)
    {
        $userId = Auth::user()->id;
        $timeOnsiteId = $request->timeOnsiteId;
        $userLevelId = UserLevel::where('user_id', $userId)->first()->level_id;
        $timeOnsitePrice = TimeOnsitePrice::where([
            ['time_onsite_id', $timeOnsiteId],
            ['level_id', $userLevelId]
        ])->first()->price;
        $dataTotalPrice = number_format($request->totalBuyTraffic * $timeOnsitePrice, 0, ',', '.') . " Coin";
        return response()->json($dataTotalPrice);
    }
    function getOnsitePrice(Request $request)
    {
        $userId = Auth::user()->id;
        $timeOnsiteId = $request->timeOnsiteId;
        $userLevelId = UserLevel::where('user_id', $userId)->first()->level_id;
        $timeOnsitePrice = TimeOnsitePrice::where([
            ['time_onsite_id', $timeOnsiteId],
            ['level_id', $userLevelId]
        ])->first()->price;
        $totalPrice = number_format($request->totalBuyTraffic * $timeOnsitePrice, 0, ',', '.') . " Coin";
        $dataResponse = [
            'timeOnsitePrice' => $timeOnsitePrice,
            'totalPrice' => $totalPrice
        ];
        return response()->json($dataResponse);
    }
    function createTraffic()
    {
        $trafficTypeIds  = TrafficType::pluck('id')->toArray();
        if (in_array(request()->type_id, $trafficTypeIds)) {
            $dataTimeOnsite = TimeOnsite::all();
            $dataDevices = Device::all();
            $trafficType = TrafficType::find(request()->type_id);
            $minPrice = TimeOnsitePrice::orderBy('price', 'asc')->limit(1)->first()->price;
            return view('users.create-traffic', compact('trafficType', 'dataDevices', 'dataTimeOnsite', 'minPrice'));
        } else {
            return abort(404);
        }
    }
    function handleCreateTraffic(Request $request)
    {
        $user = Auth::user();
        $userLevel = $user->userLevels->first()->level->level_name;
        $maxLine = 1;
        if ($userLevel == "Nhà phân phối") {
            $maxLine = 3;
        }
        $trafficTypeIds  = TrafficType::pluck('id')->toArray();
        if (in_array(request()->type_id, $trafficTypeIds)) {
            $rules = [
                'url_target' => 'required|string|max:1000',
                'url_img' => 'required|max:1000|mimes:jpeg,jpg,png,gif,webp',
                'traffic_of_date' => 'required|numeric|between:240,30000',
                'time_onsite' => 'required',
                'total_buy_traffic' => 'required|numeric|min:500|gt:traffic_of_date',
                'device' => 'required',
                'number_phone' => 'required',
            ];
            $messages = [
                'url_target.required' => 'Nội dung này là bắt buộc',
                'url_target.string' => 'Nội dung không hợp lệ',
                'url_target.max' => 'Độ dài tối đa 1000',
                'url_img.required' => 'Ảnh mô tả là bắt buộc',
                'url_img.max' => 'Ảnh mô tả tối đa 1000MB',
                'url_img.mimes' => 'Ảnh mô tả phải thuộc kiểu jpeg,jpg,png,gif,webp',
                'time_onsite.required' => 'Vui lòng chọn gói Time on site',
                'traffic_of_date.required' => 'Số traffic/ngày là bắt buộc',
                'traffic_of_date.numeric' => 'Số traffic/ngày không hợp lệ',
                'traffic_of_date.between' => 'Traffic/ngày min 240, max 30000',
                'total_buy_traffic.required' => 'Tổng traffic mua là bắt buộc',
                'total_buy_traffic.numeric' => 'Tổng traffic mua không hợp lệ',
                'total_buy_traffic.min' => 'Tổng traffic mua ít nhất 500',
                'total_buy_traffic.gt' => 'Tổng traffic phải nhiều hơn số traffic/ngày',
                'device.required' => 'Vui lòng chọn thiết vị chạy traffic',
                'number_phone.required' => 'Vui lòng nhập số điện thoại liên hệ',
            ];

            if ($request->type_id == 1) {
                $rules['key_words'] = "required|max_lines:$maxLine";
                $messages['key_words.required'] = 'Nội dung này là bắt buộc';
                $messages['key_words.max_lines'] = 'Cấp ' . $userLevel . ' chỉ cho phép tối đa ' . $maxLine . ' từ khoá';
                $dataInsert['key_words'] = json_encode(explode("\n", $request->key_words));
            }
            if ($request->type_id == 2) {
                $rules['url_contain_backlink'] = 'required|string|max:1000';
                $rules['key_words'] = "required|max_lines:$maxLine";
                $messages['url_contain_backlink.required'] = 'Nội dung này là bắt buộc';
                $messages['url_contain_backlink.string'] = 'Nội dung không hợp lệ';
                $messages['url_contain_backlink.max'] = 'Độ dài tối đa 1000';
                $messages['key_words.required'] = 'Nội dung này là bắt buộc';
                $messages['key_words.max_lines'] = 'Cấp ' . $userLevel . ' chỉ cho phép tối đa ' . $maxLine . ' từ khoá';
                $dataInsert['url_contain_backlink'] = $request->url_contain_backlink;
                $dataInsert['key_words'] = json_encode(explode("\n", $request->key_words));
            }
            if ($request->type_id == 3) {
                $dataInsert['key_words'] = json_encode([]);
            }
            $request->validate($rules, $messages);

            //end validate form
            $currentCoin = Auth::user()->coin;
            $userId = Auth::user()->id;
            $timeOnsiteId = $request->time_onsite;
            $userLevelId = UserLevel::where('user_id', $userId)->first()->level_id;
            $timeOnsitePrice = TimeOnsitePrice::where([
                ['time_onsite_id', $timeOnsiteId],
                ['level_id', $userLevelId]
            ])->first()->price;
            $dataTotalPrice = $request->total_buy_traffic * $timeOnsitePrice;
            if ($currentCoin < $dataTotalPrice) {
                return redirect()->back()->with('response', 'Tạo tiến trình không thành công! Tài khoản của bạn không đủ Coin thanh toán!');
            }

            //save Img
            $file = $request->url_img;
            $info = pathinfo($file->getClientOriginalName());
            $fileName = $info['filename'];
            $extension = $info['extension'];
            $fullName = time() . '-' . Str::slug($fileName) . '.' . $extension;
            $file->move(public_path('client/uploads/traffic-img'), $fullName);
            $url_img = 'client/uploads/traffic-img/' . $fullName;

            //insert database
            $dataInsert['url_taget'] = $request->url_target;
            $dataInsert['url_img'] = $url_img;
            $dataInsert['traffic_of_date'] = $request->traffic_of_date;
            $dataInsert['total_buy_traffic'] = $request->total_buy_traffic;
            $dataInsert['time_onsite_id'] = $request->time_onsite;
            $dataInsert['package_price'] = $request->package_price;
            $dataInsert['traffic_type_id'] = $request->type_id;
            $dataInsert['number_phone'] = $request->number_phone;
            $dataInsert['user_id'] = $user->id;
            $dataInsert['coin_payment'] = $dataTotalPrice;
            $dataInsert['traffic_status'] = 'Đang xử lý';
            $lastId = Traffic::create($dataInsert);
            foreach ($request->device as $value) {
                TrafficDevice::create([
                    'traffic_id' => $lastId->id,
                    'device_id' => $value,
                ]);
            }
            return "ok";
        } else {
            return abort(404);
        }
    }
}
