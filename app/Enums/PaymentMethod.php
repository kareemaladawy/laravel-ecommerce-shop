<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentMethod: string implements HasLabel, HasColor
{

    case PAYPAL = 'PayPal';
    case CARD = 'Card';

    public function isPayPal(): bool
    {
        return $this === self::PAYPAL;
    }

    public function isCard(): bool
    {
        return $this === self::CARD;
    }

    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->value] = ucfirst($case->value);
        }

        return $options;
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PAYPAL => 'PayPal',
            self::CARD => 'Card',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::PAYPAL => 'primary',
            self::CARD => 'secondary',
        };
    }
}
