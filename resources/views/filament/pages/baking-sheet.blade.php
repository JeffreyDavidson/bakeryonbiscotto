<x-filament-panels::page>
    <style>
        @media print {
            /* Hide everything except the baking list */
            .fi-sidebar, .fi-topbar, .fi-header, nav,
            [class*="fi-sidebar"], [class*="fi-topbar"],
            .no-print, .fi-header-heading, .fi-breadcrumbs {
                display: none !important;
            }
            .fi-main {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }
            .fi-page {
                padding: 0 !important;
            }
            .print-header {
                display: block !important;
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 20px;
                text-align: center;
            }
            body {
                background: white !important;
            }
        }
    </style>

    {{-- Print header (hidden on screen) --}}
    <div class="print-header" style="display: none;">
        Baking Sheet &mdash; {{ $this->formattedDate }}
    </div>

    {{-- Controls (hidden when printing) --}}
    <div class="no-print flex items-end gap-4 mb-6">
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date</label>
            <input
                type="date"
                id="date"
                wire:model.live="date"
                class="fi-input block w-full rounded-lg border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white sm:text-sm"
            />
        </div>
        <button
            type="button"
            onclick="window.print()"
            class="fi-btn inline-flex items-center gap-1.5 rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500"
        >
            <x-heroicon-m-printer class="h-4 w-4" />
            Print
        </button>
    </div>

    {{-- Baking list --}}
    @if($this->bakingItems->isEmpty())
        <div class="rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-500 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400">
            No orders for {{ $this->formattedDate }}.
        </div>
    @else
        <div class="rounded-xl border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-200">Product</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-700 dark:text-gray-200 w-24">Qty</th>
                        <th class="px-4 py-3 text-left font-semibold text-gray-700 dark:text-gray-200">Orders</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($this->bakingItems as $item)
                        <tr>
                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $item->product_name }}</td>
                            <td class="px-4 py-3 text-center text-lg font-bold text-primary-600 dark:text-primary-400">{{ $item->total_quantity }}</td>
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">
                                @foreach($item->order_numbers as $num)
                                    <span class="inline-flex items-center rounded-md bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-700 dark:bg-gray-600 dark:text-gray-300 mr-1 mb-1">{{ $num }}</span>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-filament-panels::page>
