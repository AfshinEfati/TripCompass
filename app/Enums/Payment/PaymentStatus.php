<?php

namespace App\Enums\Payment;

enum PaymentStatus: string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Completed = 'completed';
    case Failed = 'failed';

    /**
     * Return the labels for a specific status or all options.
     */
    /**
     * Return all statuses with their labels.
     */
    public static function options(): array
    {
        return array_map(fn($status) => [
            'value' => $status->value,
            'name_en' => match ($status) {
                self::Pending => 'Pending',
                self::Processing => 'Processing',
                self::Completed => 'Completed',
                self::Failed => 'Failed',
            },
            'name_fa' => match ($status) {
                self::Pending => 'در انتظار',
                self::Processing => 'در حال پردازش',
                self::Completed => 'تکمیل شده',
                self::Failed => 'ناموفق',
            },
        ], self::cases());
    }
}
