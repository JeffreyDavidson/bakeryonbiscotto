<div class="space-y-6">
    {{-- Customer Info --}}
    <div class="grid grid-cols-2 gap-4 rounded-xl bg-gray-50 p-4 dark:bg-white/5">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
            <p class="font-medium text-gray-950 dark:text-white">{{ $customer->customer_email }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Phone</p>
            <p class="font-medium text-gray-950 dark:text-white">{{ $customer->customer_phone ?? '—' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Orders</p>
            <p class="font-medium text-gray-950 dark:text-white">{{ $customer->orders_count }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total Spent</p>
            <p class="font-medium text-gray-950 dark:text-white">${{ number_format($customer->total_spent, 2) }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Avg Order Value</p>
            <p class="font-medium text-gray-950 dark:text-white">${{ number_format($stats->avg_order_value, 2) }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Customer Since</p>
            <p class="font-medium text-gray-950 dark:text-white">{{ \Carbon\Carbon::parse($stats->first_order_date)->format('M j, Y') }}</p>
        </div>
    </div>

    {{-- Orders --}}
    <div>
        <h3 class="mb-3 text-base font-semibold text-gray-950 dark:text-white">Order History</h3>
        <div class="space-y-3">
            @foreach ($orders as $order)
                <div class="rounded-xl border border-gray-200 p-4 dark:border-white/10">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="font-mono text-sm font-semibold text-gray-950 dark:text-white">{{ $order->order_number }}</span>
                            <span class="ml-2 text-sm text-gray-500">{{ $order->created_at->format('M j, Y') }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span @class([
                                'inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset',
                                'bg-yellow-50 text-yellow-700 ring-yellow-600/20 dark:bg-yellow-400/10 dark:text-yellow-500 dark:ring-yellow-400/20' => $order->status === 'pending',
                                'bg-blue-50 text-blue-700 ring-blue-600/20 dark:bg-blue-400/10 dark:text-blue-500 dark:ring-blue-400/20' => in_array($order->status, ['confirmed', 'baking']),
                                'bg-green-50 text-green-700 ring-green-600/20 dark:bg-green-400/10 dark:text-green-500 dark:ring-green-400/20' => in_array($order->status, ['ready', 'delivered']),
                                'bg-red-50 text-red-700 ring-red-600/20 dark:bg-red-400/10 dark:text-red-500 dark:ring-red-400/20' => $order->status === 'cancelled',
                            ])>
                                {{ ucfirst($order->status) }}
                            </span>
                            <span class="font-semibold text-gray-950 dark:text-white">${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                    @if ($order->items->count())
                        <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            {{ $order->items->map(fn ($item) => $item->quantity . '× ' . $item->product_name)->join(', ') }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
