<x-filament-panels::page>
    <style>
        @media print {
            .fi-sidebar, .fi-topbar, .fi-header, nav,
            [class*="fi-sidebar"], [class*="fi-topbar"],
            .no-print, .fi-header-heading, .fi-breadcrumbs,
            .fi-page-header { display: none !important; }
            .fi-main { margin: 0 !important; padding: 0 !important; width: 100% !important; }
            .fi-page { padding: 0 !important; }
            .print-header { display: flex !important; }
            .print-only { display: block !important; }
            body { background: white !important; }
            .baking-card { break-inside: avoid; }
            .checkbox-col { width: 40px; }
            .checkbox-col input { width: 18px; height: 18px; }
        }
    </style>

    {{-- Print header --}}
    <div class="print-header items-center justify-between mb-6 pb-4 border-b-2 border-gray-800" style="display: none;">
        <div>
            <h1 class="text-2xl font-bold">🧁 Baking Sheet</h1>
            <p class="text-gray-600">{{ $this->formattedDate }}</p>
        </div>
        <div class="text-right text-sm text-gray-500">
            <p>{{ $this->stats->total_orders }} orders · {{ $this->stats->total_items }} items</p>
            <p>{{ $this->stats->pickup_count }} pickup · {{ $this->stats->delivery_count }} delivery</p>
        </div>
    </div>

    {{-- Controls --}}
    <div class="no-print mb-6">
        <div class="flex items-center gap-3 mb-4">
            <button wire:click="previousDay" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white p-2 text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                <x-heroicon-m-chevron-left class="h-5 w-5" />
            </button>

            <input type="date" wire:model.live="date"
                class="rounded-lg border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white text-sm" />

            <button wire:click="nextDay" class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white p-2 text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700">
                <x-heroicon-m-chevron-right class="h-5 w-5" />
            </button>

            @unless($this->isToday)
                <button wire:click="goToToday" class="inline-flex items-center gap-1.5 rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300">
                    Today
                </button>
            @endunless

            <div class="ml-auto">
                <button onclick="window.print()" class="inline-flex items-center gap-1.5 rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500">
                    <x-heroicon-m-printer class="h-4 w-4" />
                    Print
                </button>
            </div>
        </div>

        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $this->formattedDate }}</h2>
    </div>

    @if($this->bakingItems->isEmpty())
        <div class="rounded-xl border-2 border-dashed border-gray-300 bg-white p-12 text-center dark:border-gray-600 dark:bg-gray-800">
            <x-heroicon-o-cake class="mx-auto h-12 w-12 text-gray-400" />
            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No orders for this day</h3>
            <p class="mt-1 text-sm text-gray-500">Enjoy the day off! 🎉</p>
        </div>
    @else
        {{-- Stats bar --}}
        <div class="no-print grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
            <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Orders</p>
                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $this->stats->total_orders }}</p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Total Items</p>
                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $this->stats->total_items }}</p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Pickups</p>
                <p class="mt-1 text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $this->stats->pickup_count }}</p>
            </div>
            <div class="rounded-xl border border-gray-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800">
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Deliveries</p>
                <p class="mt-1 text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $this->stats->delivery_count }}</p>
            </div>
        </div>

        {{-- Baking checklist --}}
        <div class="baking-card rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    🧁 What to Bake
                    <span class="text-sm font-normal text-gray-500">({{ $this->bakingItems->count() }} products)</span>
                </h3>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700">
                        <th class="checkbox-col px-4 py-3 print-only" style="display: none;"></th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider w-28">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Orders</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach($this->bakingItems as $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="checkbox-col px-4 py-4 print-only" style="display: none;">
                                <input type="checkbox" class="rounded border-gray-400" />
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-gray-900 dark:text-white text-base">{{ $item->product_name }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center min-w-[3rem] rounded-full bg-primary-100 px-3 py-1.5 text-lg font-bold text-primary-700 dark:bg-primary-900/30 dark:text-primary-400">
                                    {{ $item->total_quantity }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($item->order_numbers as $num)
                                        <span class="inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:ring-gray-600">
                                            {{ $num }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="border-t-2 border-gray-200 dark:border-gray-600">
                    <tr>
                        <td class="checkbox-col print-only" style="display: none;"></td>
                        <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">Total</td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center min-w-[3rem] rounded-full bg-gray-800 px-3 py-1.5 text-lg font-bold text-white dark:bg-white dark:text-gray-900">
                                {{ $this->bakingItems->sum('total_quantity') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $this->stats->total_orders }} orders</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Order timeline --}}
        <div class="baking-card rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    📋 Order Details
                    <span class="text-sm font-normal text-gray-500">(by pickup/delivery time)</span>
                </h3>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach($this->orders as $order)
                    <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <span class="font-bold text-gray-900 dark:text-white">{{ $order->order_number }}</span>
                                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset
                                    {{ $order->fulfillment_type === 'delivery'
                                        ? 'bg-amber-50 text-amber-700 ring-amber-200 dark:bg-amber-900/30 dark:text-amber-400 dark:ring-amber-800'
                                        : 'bg-blue-50 text-blue-700 ring-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:ring-blue-800' }}">
                                    {{ ucfirst($order->fulfillment_type) }}
                                </span>
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-50 text-yellow-700 ring-yellow-200',
                                        'confirmed' => 'bg-blue-50 text-blue-700 ring-blue-200',
                                        'baking' => 'bg-purple-50 text-purple-700 ring-purple-200',
                                        'ready' => 'bg-green-50 text-green-700 ring-green-200',
                                        'delivered' => 'bg-gray-50 text-gray-700 ring-gray-200',
                                    ];
                                @endphp
                                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $statusColors[$order->status] ?? 'bg-gray-50 text-gray-700 ring-gray-200' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                {{ $order->requested_time ?? 'No time set' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
                            <x-heroicon-m-user class="h-4 w-4" />
                            {{ $order->customer_name }}
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($order->items as $item)
                                <span class="inline-flex items-center gap-1 rounded-lg bg-gray-100 px-2.5 py-1 text-sm dark:bg-gray-700">
                                    <span class="font-semibold text-primary-600 dark:text-primary-400">{{ $item->quantity }}×</span>
                                    <span class="text-gray-700 dark:text-gray-300">{{ $item->product_name }}</span>
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</x-filament-panels::page>
