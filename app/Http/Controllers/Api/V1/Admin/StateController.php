<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\CreateStateRequest;
use App\Http\Requests\Api\V1\Admin\UpdateStateRequest;
use App\Http\Resources\Api\Admin\StateResource;
use App\Models\State;
use App\Services\StateService;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function __construct(public StateService $service)
    {
    }

    public function index()
    {
        $states = $this->service->all();
        return response()->json([
            'success' => true,
            'data' => StateResource::collection($states),
            'message' => 'Get states success'
        ]);
    }

    public function store(CreateStateRequest $request)
    {
        $state = $this->service->store($request->validated());
        return response()->json([
            'success' => true,
            'data' => StateResource::make($state),
            'message' => 'Create state success'
        ]);
    }

    public function show(State $state)
    {
        return response()->json([
            'success' => true,
            'data' => StateResource::make($state),
            'message' => 'Get state success'
        ]);
    }

    public function update(UpdateStateRequest $request, State $state)
    {
        $state = $this->service->update($request->validated(), $state);
        return response()->json([
            'success' => true,
            'data' => StateResource::make($state),
            'message' => 'Update state success'
        ]);
    }

    public function destroy(State $state)
    {
        $this->service->destroy($state);
        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'State Delete successfully'
        ]);
    }

    public function amir(){
        $url = "https://v1.vixsm.ir:2053/iXiCORa5PbAFHUG/login";

// داده‌هایی که می‌خواهید ارسال کنید
$data = [
    "username" => "amir",  // نام کاربری خود را وارد کنید
    "password" => "amir",  // رمز عبور خود را وارد کنید
];

// تبدیل داده‌ها به فرمت query string
$postData = http_build_query($data);

// مقداردهی اولیه cURL
$ch = curl_init();

// تنظیمات cURL برای ارسال درخواست POST
curl_setopt($ch, CURLOPT_URL, $url);  // تنظیم URL مقصد
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // گرفتن پاسخ و ذخیره در متغیر
curl_setopt($ch, CURLOPT_POST, true);  // مشخص کردن نوع درخواست به POST
curl_setopt($ch, CURLOPT_TIMEOUT, 0);  // Timeout in seconds
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);  // ارسال داده‌ها به صورت POST

// ارسال درخواست و دریافت پاسخ
$response = curl_exec($ch);

// بررسی وجود خطا
if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    // نمایش پاسخ
    echo $response;
}

// بستن cURL
curl_close($ch);
}
