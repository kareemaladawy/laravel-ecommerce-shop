<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'number',
        'user_id',
        'status',
        'payment_status',
        'grand_total',
        'payment_method',
        'transaction_id',
        'currency',
        'first_name',
        'last_name',
        'apartment',
        'floor',
        'building',
        'street',
        'city',
        'country',
        'state',
        'postal_code',
        'phone_number',
        'notes'
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'payment_status' => PaymentStatus::class,
    ];

    public function getRouteKeyName(): string
    {
        return 'number';
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeNotPending(Builder $query): void
    {
        $query->where('status', '!=', 'pending');
    }

    public function scopeNew(Builder $query): void
    {
        $query->where('created_at', '>=', Carbon::now()->subDays(30));
    }
}
