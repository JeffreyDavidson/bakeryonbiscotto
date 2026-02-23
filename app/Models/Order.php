<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'customer_name', 'customer_email', 'customer_phone',
        'fulfillment_type', 'delivery_address', 'delivery_zip', 'delivery_fee',
        'requested_date', 'requested_time', 'notes', 'subtotal', 'total',
        'status', 'payment_status', 'payment_method',
        'paypal_invoice_id', 'paypal_invoice_url',
        'payment_deadline', 'payment_reminder_sent',
        'paid_at', 'delivered_at', 'follow_up_sent',
        'coupon_id', 'discount_amount',
    ];

    protected function casts(): array
    {
        return [
            'requested_date' => 'date',
            'paid_at' => 'datetime',
            'delivered_at' => 'datetime',
            'follow_up_sent' => 'boolean',
            'payment_deadline' => 'date',
            'payment_reminder_sent' => 'boolean',
            'subtotal' => 'decimal:2',
            'total' => 'decimal:2',
            'delivery_fee' => 'decimal:2',
            'discount_amount' => 'decimal:2',
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

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function orderNotes(): HasMany
    {
        return $this->hasMany(OrderNote::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['delivered', 'cancelled']);
    }

    public function getIsOverdueAttribute(): bool
    {
        return $this->payment_status === 'unpaid'
            && $this->payment_deadline
            && Carbon::parse($this->payment_deadline)->isPast();
    }

    public function scopeUnpaidOverdue($query)
    {
        return $query->where('payment_status', 'unpaid')
            ->whereNotNull('payment_deadline')
            ->where('payment_deadline', '<', Carbon::today());
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
