<?php

namespace App\Traits;

use App\Models\Payment;


trait PaymentManagement
{
    /**
     * @param mixed $ticket
     * @param string $driver
     * @return array
     */
    public function getPay(mixed $ticket, string $driver = 'behpardakht'): array
    {
        return [
            'orderId' => $ticket->id,
            'amount' => $ticket->price,
            'localDate' => date('Ymd'),
            'localTime' => date('Gis'),
            'additionalData' => 'پرداخت',
            'mobileNo' => $ticket->mobile,
            'cartItem' => 'متن دلخواه'
        ];
    }

    /**
     * @param object $action
     * @param string $driver
     * @return string
     */
    public function getPayAction(object $action, string $driver = 'behpardakht'): string
    {
        return "{$action->action}?RefId={$action->inputs->RefId}";
    }

    /**
     * @param int $resCode
     * @return string[]
     */
    public function getBehPardakhtStatus(int $resCode): array
    {
        return match ($resCode) {
            0 => [
                'status' => 'reference',
                'provider_response' => 'تراکنش با موفقیت انجام شد'
            ],
            11 => [
                'status' => 'rejected',
                'provider_response' => 'شماره کارت نامعتبر است'
            ],
            12 => [
                'status' => 'rejected',
                'provider_response' => 'موجودی کافي نیست'
            ],
            13 => [
                'status' => 'rejected',
                'provider_response' => 'رمز نادرست است'
            ],
            14 => [
                'status' => 'rejected',
                'provider_response' => 'تعداد دفعات وارد کردن رمز بیش از حد مجاز است'
            ],
            15 => [
                'status' => 'rejected',
                'provider_response' => 'کارت نامعتبر است'
            ],
            16 => [
                'status' => 'rejected',
                'provider_response' => 'دفعات برداشت وجه بیش از حد مجاز است'
            ],
            17 => [
                'status' => 'rejected',
                'provider_response' => 'کاربر از انجام تراکنش منصرف شده است'
            ],
            18 => [
                'status' => 'rejected',
                'provider_response' => 'تاريخ انقضای کارت گذشته است'
            ],
            19 => [
                'status' => 'rejected',
                'provider_response' => 'مبلغ برداشت وجه بیش از حد مجاز است'
            ],
            111 => [
                'status' => 'rejected',
                'provider_response' => 'صادر کننده کارت نامعتبر است'
            ],
            112 => [
                'status' => 'rejected',
                'provider_response' => 'خطای سويیچ صادر کننده کارت'
            ],
            113 => [
                'status' => 'rejected',
                'provider_response' => 'پاسخي از صادر کننده کارت دريافت نشد'
            ],
            114 => [
                'status' => 'rejected',
                'provider_response' => 'دارنده کارت مجاز به انجام اين تراکنش نیست'
            ],
            21 => [
                'status' => 'rejected',
                'provider_response' => 'پذيرنده نامعتبر است'
            ],
            23 => [
                'status' => 'rejected',
                'provider_response' => 'خطای امنیتي رخ داده است'
            ],
            24 => [
                'status' => 'rejected',
                'provider_response' => 'اطلاعات کاربری پذيرنده نامعتبر است'
            ],
            25 => [
                'status' => 'rejected',
                'provider_response' => 'مبلغ نامعتبر است'
            ],
            31 => [
                'status' => 'rejected',
                'provider_response' => 'پاسخ نامعتبر است'
            ],
            32 => [
                'status' => 'rejected',
                'provider_response' => 'فرمت اطالعات وارد شده صحیح نمي باشد'
            ],
            33 => [
                'status' => 'rejected',
                'provider_response' => 'حساب نامعتبر است'
            ],
            34 => [
                'status' => 'rejected',
                'provider_response' => 'خطای سیستمي'
            ],
            35 => [
                'status' => 'rejected',
                'provider_response' => 'تاريخ نامعتبر است'
            ],
            41 => [
                'status' => 'rejected',
                'provider_response' => 'شماره درخواست تکراری است'
            ],
            42 => [
                'status' => 'rejected',
                'provider_response' => 'تراکنش Sale يافت نشد'
            ],
            43 => [
                'status' => 'rejected',
                'provider_response' => 'قبلا درخواست تایید داده شده است'
            ],
            44 => [
                'status' => 'rejected',
                'provider_response' => 'درخواست تایید يافت نشد'
            ],
            45 => [
                'status' => 'rejected',
                'provider_response' => 'تراکنش قبلا واریز شده است'
            ],
            46 => [
                'status' => 'rejected',
                'provider_response' => 'تراکنش واریز نشده است'
            ],
            47 => [
                'status' => 'rejected',
                'provider_response' => 'تراکنش واریز یافت نشد'
            ],
            48 => [
                'status' => 'rejected',
                'provider_response' => 'مبلغ برگشت داده شده است'
            ],
            412 => [
                'status' => 'rejected',
                'provider_response' => 'شناسه قبض نادرست است'
            ],
            413 => [
                'status' => 'rejected',
                'provider_response' => 'شناسه پرداخت نادرست است'
            ],
            414 => [
                'status' => 'rejected',
                'provider_response' => 'سازمان صادر کننده قبض نامعتبر است'
            ],
            415 => [
                'status' => 'rejected',
                'provider_response' => 'زمان جلسه کاری به پايان رسیده است'
            ],
            416 => [
                'status' => 'rejected',
                'provider_response' => 'خطا در ثبت اطلاعات'
            ],
            417 => [
                'status' => 'rejected',
                'provider_response' => 'شناسه پرداخت کننده نامعتبر است'
            ],
            418 => [
                'status' => 'rejected',
                'provider_response' => 'اشکال در تعريف اطلاعات مشتری'
            ],
            419 => [
                'status' => 'rejected',
                'provider_response' => 'تعداد دفعات ورود اطالعات از حد مجاز گذشته است'
            ],
            421 => [
                'status' => 'rejected',
                'provider_response' => 'ip نامعتبر است'
            ],
            51 => [
                'status' => 'rejected',
                'provider_response' => 'تراکنش تکراری است'
            ],
            54 => [
                'status' => 'rejected',
                'provider_response' => 'تراکنش مرجع موجود نیست'
            ],
            55 => [
                'status' => 'rejected',
                'provider_response' => 'تراکنش نامعتبر است'
            ],
            61 => [
                'status' => 'rejected',
                'provider_response' => 'خطا در واريز'
            ],
            62 => [
                'status' => 'rejected',
                'provider_response' => 'مسیر بازگشت به سايت در دامنه ثبت شده برای پذيرنده
قرار ندارد.'
            ],
            98 => [
                'status' => 'rejected',
                'provider_response' => 'سقف استفاده از رمز ايستا به پايان رسیده است.'
            ],
            995 => [
                'status' => 'rejected',
                'provider_response' => 'علق کارت بانکي به مشتری احراز نشد'
            ],
        };
    }
    public function getZibalStatus(int $status): array
    {
        return match ($status){
            -1 => [
                'status' => 'rejected',
                'provider_response' => 'در انتظار پرداخت'
            ],
            -2 => [
                'status' => 'rejected',
                'provider_response' => 'خطای داخلی'
            ],
            1 => [
                'status' => 'done',
                'provider_response' => 'پرداخت شده - تایید شده'
            ],
            2 => [
                'status' => 'payed',
                'provider_response' => 'پرداخت شده - تایید نشده'
            ],
            3 => [
                'status' => 'rejected',
                'provider_response' => 'لغوشده توسط کاربر'
            ],
            4 => [
                'status' => 'rejected',
                'provider_response' => 'شماره کارت نامعتبر است'
            ],
            5 => [
                'status' => 'rejected',
                'provider_response' => 'موجودی حساب کافی نیست'
            ],
            6=>[
                'status' => 'rejected',
                'provider_response' => 'رمز واردشده اشتباه می‌باشد.'
            ],
            7=>[
                'status' => 'rejected',
                'provider_response' => 'تعداد دفعات ورود رمز بیش از حد مجاز است.'
            ],
            8=>[
                'status' => 'rejected',
                'provider_response' => '‌تعداد پرداخت اینترنتی روزانه بیش از حد مجاز می‌باشد.'
            ],
            9=>[
                'status' => 'rejected',
                'provider_response' => 'مبلغ پرداخت اینترنتی روزانه بیش از حد مجاز می‌باشد.'
            ],
            10=>[
                'status' => 'rejected',
                'provider_response' => '‌صادر کننده‌ی کارت نامعتبر می‌باشد.'
            ],
            11=>[
                'status' => 'rejected',
                'provider_response' => 'خطای سوییچ'
            ],
            12=>[
                'status' => 'rejected',
                'provider_response' => 'کارت قابل دسترسی نمی‌باشد.'
            ],
        };
    }
    public function getSepStatus(int $status): array
    {
        return match ($status) {
            2 => [
                'status' => 'reference',
                'provider_response' => 'تراکنش با موفقیت انجام شد'
            ],
            1 => [
                'status' => 'rejected',
                'provider_response' => 'کاربر از انجام تراکنش منصرف شده است'
            ],
            3 => [
                'status' => 'rejected',
                'provider_response' => 'پرداخت انجام نشد'
            ],
            4 => [
                'status' => 'rejected',
                'provider_response' => 'تراکنش منقضی شد'
            ],
            5 => [
                'status' => 'rejected',
                'provider_response' => 'پارامترهای ارسال نامعتبر'
            ],
            8 => [
                'status' => 'rejected',
                'provider_response' => 'آدرس سرور پذیرنده نامعتبر است'
            ],
            10 => [
                'status' => 'rejected',
                'provider_response' => ' توکن ارسال شده یافت نشد'
            ],
            11 => [
                'status' => 'rejected',
                'provider_response' => 'با این شماره ترمینال فقط تراکنش های توکنی قابل پرداخت هستند'
            ],
            12 => [
                'status' => 'rejected',
                'provider_response' => ' شماره ترمینال ارسال شده یافت نشد'
            ],
            21 => [
                'status' => 'rejected',
                'provider_response' => 'محدودیت های مدل چند حسابی رعایت نشده'
            ],
        };
    }

    /**
     * @param int $id
     * @return array
     */
    public function prepareForPay(int $id): array
    {
        return [
            'verifyUrl' => "https://parsitrip.com/api/v1/payment/verify/$id"
        ];

    }
}
