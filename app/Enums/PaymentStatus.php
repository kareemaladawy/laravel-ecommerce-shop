<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatus: string implements HasIcon, HasLabel, HasColor {

    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'failed';

    public function isPending(): bool
    {
        return $this === self::PENDING;
    }

    public function isCompleted(): bool
    {
        return $this === self::COMPLETED;
    }

    public function isFailed(): bool
    {
        return $this === self::FAILED;
    }

    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case){
            $options[$case->value] = ucfirst($case->value);
        }

        return $options;
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::PENDING => 'pending',
            self::COMPLETED => 'completed',
            self::FAILED => 'failed',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PENDING => 'heroicon-m-clock',
            self::COMPLETED => 'heroicon-m-check',
            self::FAILED => 'heroicon-m-no-symbol',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::COMPLETED => 'success',
            self::FAILED => 'danger',
        };
    }
}
