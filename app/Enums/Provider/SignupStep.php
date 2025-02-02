<?php

namespace App\Enums\Provider;

enum SignupStep: int
{
    case BasicDetails = 1;      // Basic details entered
    case VerifyEmail = 2;       // Email verified
    case UploadDocuments = 3;   // Required documents uploaded
    case AddAddress = 4;        // Address added
    case Approval = 5;          // Admin approval

    public static function options(): array
    {
        return array_map(fn($step) => [
            'value' => $step->value,
            'name_en' => match ($step) {
                self::BasicDetails => 'Basic Details',
                self::VerifyEmail => 'Verify Email',
                self::UploadDocuments => 'Upload Documents',
                self::AddAddress => 'Add Address',
                self::Approval => 'Approval',
            },
            'name_fa' => match ($step) {
                self::BasicDetails => 'جزئیات اولیه',
                self::VerifyEmail => 'تأیید ایمیل',
                self::UploadDocuments => 'آپلود مدارک',
                self::AddAddress => 'افزودن آدرس',
                self::Approval => 'تأیید',
            },
        ], self::cases());
    }
}
