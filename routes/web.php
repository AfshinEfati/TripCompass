<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
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
});
