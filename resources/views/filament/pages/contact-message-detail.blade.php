<style>
    .cm-wrap { background: #fdf8f2; margin: -1.5rem; padding: 1.5rem; min-height: 100%; }
    .cm-badge { display: inline-flex; padding: 0.2rem 0.625rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; }
    .cm-badge-new { background: #fef3c7; color: #92400e; }
    .cm-badge-read { background: #e8d0b0; color: #3d2314; }
    .cm-badge-replied { background: #d1fae5; color: #065f46; }
    .cm-contact { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1rem; }
    .cm-contact-item { display: flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1rem; background: white; border: 1px solid #e8d0b0; border-radius: 0.5rem; font-size: 0.85rem; color: #3d2314; }
    .cm-contact-item a { color: #8b5e3c; text-decoration: none; font-weight: 500; }
    .cm-contact-item a:hover { text-decoration: underline; }
    .cm-order-row { display: flex; align-items: center; justify-content: space-between; padding: 0.625rem 1.25rem; border-bottom: 1px solid #f3ebe0; font-size: 0.85rem; }
    .cm-order-row:last-child { border-bottom: none; }
    .cm-order-row:hover { background: #fdf8f2; }
    .cm-order-num { font-family: monospace; font-weight: 700; color: #3d2314; }
    .cm-order-meta { display: flex; align-items: center; gap: 0.5rem; }
    .cm-order-date { color: #a08060; font-size: 0.8rem; }
    .cm-order-total { font-weight: 700; color: #3d2314; }
</style>

<div class="cm-wrap">
    {{-- Header banner --}}
    <x-admin.page-banner title="">
        <x-slot:title>
            <div style="display: flex; align-items: center; gap: 1rem; width: 100%;">
                <div style="width: 3rem; height: 3rem; border-radius: 9999px; background: rgba(255,255,255,0.15); border: 2px solid rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.125rem; flex-shrink: 0;">{{ strtoupper(substr($message->name, 0, 1)) }}</div>
                <div style="flex: 1;">
                    <div style="font-weight: 700; font-size: 1.1rem; color: white;">{{ $message->name }}</div>
                    <div style="font-size: 0.75rem; color: rgba(255,255,255,0.5); margin-top: 0.125rem;">{{ $message->created_at->diffForHumans() }} · {{ $message->created_at->format('M j, Y g:i A') }}</div>
                </div>
                <span class="cm-badge cm-badge-{{ $message->status }}">{{ ucfirst($message->status) }}</span>
            </div>
        </x-slot:title>
    </x-admin.page-banner>

    {{-- Contact info --}}
    <div class="cm-contact">
        <div class="cm-contact-item">
            <span>✉️</span>
            <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
        </div>
        <div class="cm-contact-item">
            <span>📱</span>
            {{ $message->phone ?? '—' }}
        </div>
    </div>

    {{-- Message --}}
    <x-admin.card>
        <div style="padding: 0.875rem 1.25rem; background: #fdf8f2; border-bottom: 1px solid #f3ebe0; display: flex; align-items: center; justify-content: space-between;">
            <span style="font-weight: 700; color: #3d2314; font-size: 1rem;">{{ $message->subject }}</span>
        </div>
        <div style="padding: 1.25rem; font-size: 0.9rem; color: #4a3225; line-height: 1.6; white-space: pre-wrap;">{{ $message->message }}</div>
    </x-admin.card>

    {{-- Order history --}}
    <x-admin.card>
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1.25rem; background: linear-gradient(135deg, #3d2314, #6b4c3b);">
            <span style="font-size: 0.8rem; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 0.05em;">Order History</span>
            <span style="font-size: 0.7rem; font-weight: 700; color: #3d2314; background: #fef3c7; padding: 0.15rem 0.5rem; border-radius: 9999px;">{{ $orders->count() }}</span>
        </div>
        @if($orders->isEmpty())
            <div style="padding: 1.5rem; text-align: center; color: #a08060; font-size: 0.85rem; font-style: italic;">No previous orders from this email</div>
        @else
            <div style="padding: 0.75rem 1.25rem; background: #fdf8f2; border-bottom: 1px solid #f3ebe0; font-size: 0.8rem; color: #a08060;">{{ $orders->count() }} {{ Str::plural('order', $orders->count()) }} · ${{ number_format($orders->sum('total'), 2) }} total</div>
            @foreach($orders as $order)
                <div class="cm-order-row">
                    <div class="cm-order-meta">
                        <span class="cm-order-num">{{ $order->order_number }}</span>
                        <x-admin.badge :type="$order->status" />
                        <span class="cm-order-date">{{ $order->created_at->format('M j, Y') }}</span>
                    </div>
                    <span class="cm-order-total">${{ number_format($order->total, 2) }}</span>
                </div>
            @endforeach
        @endif
    </x-admin.card>
</div>
