<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasIcon, HasColor, HasLabel {

    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';
    case COMPLETED = 'completed';
    case DECLINED = 'declined';
    case CANCELLED = 'cancelled';

    public function isCompleted(): bool
    {
        return $this === self::COMPLETED;
    }

    public function isProcessing(): bool
    {
        return $this === self::PROCESSING;
    }

    public function isCancelled(): bool
    {
        return $this === self::CANCELLED;
    }

    public function isDeclined(): bool
    {
        return $this === self::DECLINED;
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
            self::PROCESSING => 'processing',
            self::COMPLETED => 'completed',
            self::SHIPPED => 'shipped',
            self::DECLINED => 'declined',
            self::CANCELLED => 'cancelled',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::PENDING => 'heroicon-m-clock',
            self::PROCESSING => 'heroicon-m-arrow-path',
            self::COMPLETED => 'heroicon-m-check',
            self::SHIPPED => 'heroicon-m-check',
            self::DECLINED => 'heroicon-m-no-symbol',
            self::CANCELLED => 'heroicon-m-no-symbol',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::PROCESSING => 'success',
            self::COMPLETED => 'success',
            self::SHIPPED => 'success',
            self::DECLINED => 'danger',
            self::CANCELLED => 'danger',
        };
    }
}
