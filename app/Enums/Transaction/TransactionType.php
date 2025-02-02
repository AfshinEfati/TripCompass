<?php

namespace App\Enums\Transaction;

enum TransactionType: string
{
    case Click = 'click';
    case Deposit = 'deposit';
    case Rent = 'rent';

    /**
     * Return all transaction types with their labels.
     */
    public static function options(): array
    {
        return array_map(fn($type) => [
            'value' => $type->value,
            'name_en' => match ($type) {
                self::Click => 'Click Charge',
                self::Deposit => 'Deposit',
                self::Rent => 'Rent Payment',
            },
            'name_fa' => match ($type) {
                self::Click => 'هزینه کلیک',
                self::Deposit => 'واریز',
                self::Rent => 'پرداخت اجاره',
            },
        ], self::cases());
    }
}
