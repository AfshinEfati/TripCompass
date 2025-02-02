<?php

namespace App\Enums;

enum Gender: string
{
    case Male = 'male';
    case Female = 'female';

    /**
     * Get the display name for the gender.
     */
    public static function options(): array
    {
        return array_map(fn($gender) => [
            'value' => $gender->value,
            'name_en' => match ($gender) {
                self::Male => 'Male',
                self::Female => 'Female',
            },
            'name_fa' => match ($gender) {
                self::Male => 'مرد',
                self::Female => 'زن',
            },
        ], self::cases());
    }
}
