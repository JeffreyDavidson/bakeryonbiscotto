<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'customer_name', 'customer_email', 'customer_phone',
        'fulfillment_type', 'delivery_address', 'delivery_zip', 'delivery_fee',
        'requested_date', 'requested_time', 'notes', 'subtotal', 'total',
        'status', 'payment_status',
        'stripe_session_id', 'stripe_payment_intent', 'paid_at',
        'delivered_at', 'follow_up_sent',
    ];

    protected function casts(): array
    {
        return [
            'requested_date' => 'date',
            'paid_at' => 'datetime',
            'delivered_at' => 'datetime',
            'follow_up_sent' => 'boolean',
            'subtotal' => 'decimal:2',
            'total' => 'decimal:2',
            'delivery_fee' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            if (empty($order->order_number)) {
                $order->order_number = 'BOB-' . strtoupper(Str::random(8));
            }
        });
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['delivered', 'cancelled']);
    }

    public function getIsDeliveryAttribute(): bool
    {
        return $this->fulfillment_type === 'delivery';
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'warning',
            'confirmed' => 'info',
            'baking' => 'primary',
            'ready' => 'success',
            'delivered' => 'gray',
            'cancelled' => 'danger',
            default => 'gray',
        };
    }
}
