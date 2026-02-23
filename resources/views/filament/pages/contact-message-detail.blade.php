<div style="background: #fdf8f2; margin: -1.5rem; padding: 1.5rem; min-height: 100%;">
    {{-- Header banner --}}
    <x-admin.page-banner title="">
        <x-slot:title>
            <div style="display: flex; align-items: center; gap: 1rem; width: 100%;">
                <x-admin.avatar :name="$message->name" size="3rem" />
                <div style="flex: 1;">
                    <div style="font-weight: 700; font-size: 1.1rem; color: white;">{{ $message->name }}</div>
                    <div style="font-size: 0.75rem; color: rgba(255,255,255,0.5); margin-top: 0.125rem;">{{ $message->created_at->diffForHumans() }} · {{ $message->created_at->format('M j, Y g:i A') }}</div>
                </div>
                <x-admin.badge :type="$message->status" rounded style="padding: 0.2rem 0.625rem; font-size: 0.65rem; font-weight: 700; text-transform: uppercase;" />
            </div>
        </x-slot:title>
    </x-admin.page-banner>

    {{-- Contact info --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1rem;">
        <x-admin.pill bg="white" style="display:flex;align-items:center;gap:0.5rem;padding:0.625rem 1rem;font-size:0.85rem;">
            <span>✉️</span>
            <a href="mailto:{{ $message->email }}" style="color:#8b5e3c;text-decoration:none;font-weight:500;">{{ $message->email }}</a>
        </x-admin.pill>
        <x-admin.pill bg="white" style="display:flex;align-items:center;gap:0.5rem;padding:0.625rem 1rem;font-size:0.85rem;">
            <span>📱</span> {{ $message->phone ?? '—' }}
        </x-admin.pill>
    </div>

    {{-- Message --}}
    <x-admin.card>
        <div style="padding: 0.875rem 1.25rem; background: #fdf8f2; border-bottom: 1px solid #f3ebe0;">
            <span style="font-weight: 700; color: #3d2314; font-size: 1rem;">{{ $message->subject }}</span>
        </div>
        <div style="padding: 1.25rem; font-size: 0.9rem; color: #4a3225; line-height: 1.6; white-space: pre-wrap;">{{ $message->message }}</div>
    </x-admin.card>

    {{-- Order history --}}
    <x-admin.card title="Order History" :subtitle="(string) $orders->count()">
        @if($orders->isEmpty())
            <div style="padding: 1.5rem; text-align: center; color: #a08060; font-size: 0.85rem; font-style: italic;">No previous orders from this email</div>
        @else
            <div style="padding: 0.75rem 1.25rem; background: #fdf8f2; border-bottom: 1px solid #f3ebe0; font-size: 0.8rem; color: #a08060;">
                {{ $orders->count() }} {{ Str::plural('order', $orders->count()) }} · ${{ number_format($orders->sum('total'), 2) }} total
            </div>
            <x-admin.data-table data-admin-table>
                <x-slot:head>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th style="text-align:right;">Total</th>
                </x-slot:head>
                @foreach($orders as $order)
                    <tr>
                        <td style="font-family:monospace;font-weight:700;color:#3d2314;">{{ $order->order_number }}</td>
                        <td><x-admin.badge :type="$order->status" /></td>
                        <td style="color:#a08060;font-size:0.8rem;">{{ $order->created_at->format('M j, Y') }}</td>
                        <td style="text-align:right;font-weight:700;color:#3d2314;">${{ number_format($order->total, 2) }}</td>
                    </tr>
                @endforeach
            </x-admin.data-table>
        @endif
    </x-admin.card>
</div>
