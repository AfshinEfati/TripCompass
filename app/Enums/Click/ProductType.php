<?php

namespace App\Enums\Click;

enum ProductType: string
{
    case Flight = 'flight';
    case Hotel = 'hotel';

    /**
     * Return all product types with their labels.
     */
    public static function options(): array
    {
        return array_map(fn($type) => [
            'value' => $type->value,
            'name_en' => match ($type) {
                self::Flight => 'Flight',
                self::Hotel => 'Hotel',
            },
            'name_fa' => match ($type) {
                self::Flight => 'پرواز',
                self::Hotel => 'هتل',
            },
        ], self::cases());
    }
}
