<style>
    .order-layout {
        display: grid; grid-template-columns: 1fr 380px; gap: 1.5rem; align-items: start;
    }
    @media (max-width: 1024px) { .order-layout { grid-template-columns: 1fr; } }

    .summary-row { display: flex; justify-content: space-between; padding: 0.5rem 1rem; font-size: 0.875rem; }
    .summary-row .label { color: #a08060; }
    .summary-row .value { font-weight: 600; color: #3d2314; }
    .summary-row.total { padding: 0.75rem 1rem; border-top: 2px solid #e8d0b0; background: #fdf8f2; }
    .summary-row.total .label { font-weight: 700; color: #3d2314; font-size: 1rem; }
    .summary-row.total .value { font-weight: 800; color: #8b5e3c; font-size: 1.25rem; }
</style>

<div>
    {{-- Header --}}
    <x-admin.page-banner title="">
        <x-slot:title>
            <div style="display: flex; align-items: center; gap: 1.25rem; flex-wrap: wrap; width: 100%;">
                <div>
                    <span style="font-size: 0.65rem; font-weight: 600; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 0.1em; display: block;">Order</span>
                    <span style="font-family: monospace; font-size: 1.375rem; font-weight: 800; color: white; letter-spacing: 0.05em;">{{ $record->order_number }}</span>
                </div>
                <div style="margin-left: auto; text-align: right; display: flex; flex-direction: column; align-items: flex-end; gap: 0.375rem;">
                    <x-admin.badge :type="$record->status" rounded style="padding: 0.375rem 1rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;" />
                    @if($record->status === 'cancelled' && $record->payment_status)
                        <x-admin.badge :type="$record->payment_status" rounded />
                    @endif
                    <span style="font-size: 0.8rem; color: rgba(255,255,255,0.6);">Placed {{ $record->created_at->format('M j, Y \a\t g:i A') }}</span>
                </div>
            </div>
        </x-slot:title>
    </x-admin.page-banner>

    <div class="order-layout">
        {{-- LEFT COLUMN --}}
        <div>
            {{-- Items --}}
            <x-admin.card title="Items" :subtitle="$record->items->sum('quantity') . ' ' . ($record->items->sum('quantity') === 1 ? 'item' : 'items')" headerStyle="flat">
                <x-admin.data-table data-admin-table>
                    <x-slot:head>
                        <th style="width:3rem;text-align:center;">Qty</th>
                        <th>Product</th>
                        <th style="width:6rem;">Unit Price</th>
                        <th style="width:6rem;text-align:right;">Total</th>
                    </x-slot:head>
                    @foreach($record->items as $item)
                        <tr>
                            <td style="text-align:center;">
                                <span style="display:inline-flex;align-items:center;justify-content:center;min-width:1.75rem;height:1.75rem;border-radius:0.375rem;background:#fef3c7;font-size:0.8rem;font-weight:700;color:#92400e;">{{ $item->quantity }}</span>
                            </td>
                            <td><span style="font-weight:600;color:#3d2314;">{{ $item->product_name }}</span></td>
                            <td style="color:#9ca3af;font-size:0.8rem;">${{ number_format($item->unit_price, 2) }}</td>
                            <td style="text-align:right;font-weight:600;color:#3d2314;">${{ number_format($item->line_total, 2) }}</td>
                        </tr>
                    @endforeach
                </x-admin.data-table>
                <div style="border-top:1px solid #e5e7eb;">
                    <div class="summary-row">
                        <span class="label">Subtotal</span>
                        <span class="value">${{ number_format($record->subtotal, 2) }}</span>
                    </div>
                    @if($record->fulfillment_type === 'delivery')
                        <div class="summary-row">
                            <span class="label">Delivery Fee</span>
                            <span class="value">${{ number_format($record->delivery_fee, 2) }}</span>
                        </div>
                    @endif
                    <div class="summary-row total">
                        <span class="label">Total</span>
                        <span class="value">${{ number_format($record->total, 2) }}</span>
                    </div>
                </div>
            </x-admin.card>

            {{-- Payment --}}
            <x-admin.card title="Payment" headerStyle="flat">
                <x-slot:subtitle>
                    <x-admin.badge :type="$record->payment_status ?? 'paid'" rounded />
                </x-slot:subtitle>
                <div style="padding: 1rem 1.25rem;">
                    <x-admin.info-row label="Paid at" :value="$record->paid_at?->format('M j, Y g:i A') ?? '—'" />
                    @if($record->stripe_payment_intent)
                        <x-admin.info-row label="PayPal ID">
                            <span style="font-family:monospace;font-size:0.8rem;">{{ $record->stripe_payment_intent }}</span>
                        </x-admin.info-row>
                    @endif
                </div>
            </x-admin.card>

            {{-- Notes --}}
            <x-admin.card title="Notes" headerStyle="flat">
                <div style="padding: 1rem 1.25rem;">
                    @if($record->getRawOriginal('notes'))
                        <div style="font-size:0.875rem;color:#4a3225;line-height:1.5;white-space:pre-wrap;">{{ $record->getRawOriginal('notes') }}</div>
                    @else
                        <div style="font-size:0.875rem;color:#d1d5db;font-style:italic;">No notes for this order.</div>
                    @endif
                </div>
            </x-admin.card>
        </div>

        {{-- RIGHT COLUMN --}}
        <div>
            {{-- Customer --}}
            <x-admin.card title="Customer" headerStyle="flat">
                <div style="padding: 1rem 1.25rem;">
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.75rem;">
                        <x-admin.avatar :name="$record->customer_name" size="2.5rem" context="light" />
                        <div style="font-weight:700;color:#111827;">{{ $record->customer_name }}</div>
                    </div>
                    <x-admin.info-row label="Email" :value="$record->customer_email" :href="'mailto:' . $record->customer_email" />
                    @if($record->customer_phone)
                        <x-admin.info-row label="Phone" :value="$record->customer_phone" :href="'tel:' . $record->customer_phone" />
                    @endif
                    @php
                        $orderCount = \App\Models\Order::where('customer_email', $record->customer_email)->count();
                        $totalSpent = \App\Models\Order::where('customer_email', $record->customer_email)->whereNotIn('status', ['cancelled'])->sum('total');
                    @endphp
                    <x-admin.info-row label="Orders" :value="$orderCount" />
                    <x-admin.info-row label="Total Spent">
                        <span style="font-weight:700;color:#059669;">${{ number_format($totalSpent, 2) }}</span>
                    </x-admin.info-row>
                </div>
            </x-admin.card>

            {{-- Fulfillment --}}
            <x-admin.card title="Fulfillment" headerStyle="flat">
                <x-slot:subtitle>
                    <x-admin.badge :type="$record->fulfillment_type" rounded :label="($record->fulfillment_type === 'delivery' ? '🚗 ' : '📦 ') . ucfirst($record->fulfillment_type)" />
                </x-slot:subtitle>
                <div style="padding: 1rem 1.25rem;">
                    <x-admin.info-row label="Date" :value="$record->requested_date->format('l, M j, Y')" />
                    @if($record->requested_time)
                        <x-admin.info-row label="Time" :value="preg_match('/^\d{1,2}:\d{2}$/', $record->requested_time) ? date('g:i A', strtotime($record->requested_time)) : $record->requested_time" />
                    @endif
                    @if($record->fulfillment_type === 'delivery')
                        <x-admin.info-row label="Address" :value="$record->delivery_address" />
                        @if($record->delivery_zip)
                            <x-admin.info-row label="Zip" :value="$record->delivery_zip" />
                        @endif
                    @endif
                </div>
            </x-admin.card>

            {{-- Timeline --}}
            <x-admin.card title="Timeline" headerStyle="flat">
                <div style="padding: 1rem 1.25rem; display: flex; flex-direction: column; gap: 0.5rem;">
                    <x-admin.timeline-entry label="Ordered" :time="$record->created_at->format('M j, g:i A')" />
                    @if($record->paid_at)
                        <x-admin.timeline-entry label="Paid" :time="$record->paid_at->format('M j, g:i A')" />
                    @endif
                    @if($record->delivered_at)
                        <x-admin.timeline-entry label="Delivered" :time="$record->delivered_at->format('M j, g:i A')" dotColor="#6b4c3b" />
                    @endif
                    @if($record->status === 'cancelled')
                        <x-admin.timeline-entry label="Cancelled" dotColor="#ef4444" />
                    @endif
                </div>
            </x-admin.card>

            {{-- Activity Log --}}
            <x-admin.card title="Activity Log" :subtitle="$record->orderNotes->count() . ' ' . ($record->orderNotes->count() === 1 ? 'entry' : 'entries')" headerStyle="flat">
                <div style="padding: 1rem 1.25rem;">
                    @if($record->orderNotes->count() > 0)
                        <div style="display:flex;flex-direction:column;gap:0;">
                            @foreach($record->orderNotes->sortByDesc('created_at') as $note)
                                <div style="position:relative;padding-left:1.5rem;padding-bottom:1rem;border-left:2px solid #e8d0b0;margin-left:0.25rem;">
                                    <div style="position:absolute;left:-0.4375rem;top:0.125rem;width:0.75rem;height:0.75rem;border-radius:9999px;border:2px solid {{ $note->type === 'status_change' ? '#8b5e3c' : ($note->type === 'system' ? '#9ca3af' : '#6b4c3b') }};background:{{ $note->type === 'status_change' ? '#fef3c7' : ($note->type === 'system' ? '#f3f4f6' : '#fdf8f2') }};"></div>
                                    <div style="margin-left:0.5rem;">
                                        @if($note->type === 'status_change')
                                            <x-admin.badge type="pending" label="Status Change" rounded style="font-size:0.675rem;margin-bottom:0.25rem;" />
                                        @elseif($note->type === 'system')
                                            <x-admin.badge type="default" label="System" rounded style="font-size:0.675rem;margin-bottom:0.25rem;background:#f3f4f6;color:#6b7280;" />
                                        @endif
                                        <div style="font-size:0.8125rem;color:#3d2314;line-height:1.4;">{{ $note->content }}</div>
                                        <div style="font-size:0.7rem;color:#a08060;margin-top:0.25rem;">{{ $note->user?->name ?? 'System' }} · {{ $note->created_at->format('M j, g:i A') }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="font-size:0.8rem;color:#d1d5db;font-style:italic;">No activity yet.</div>
                    @endif
                </div>
            </x-admin.card>
        </div>
    </div>
</div>
