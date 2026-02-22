<style>
    .cm-wrap { background: #fdf8f2; margin: -1.5rem; padding: 1.5rem; min-height: 100%; }
    .cm-header { display: flex; align-items: center; gap: 1rem; padding: 1rem 1.25rem; background: linear-gradient(135deg, #3d2314, #6b4c3b); border-radius: 0.75rem; margin-bottom: 1rem; }
    .cm-avatar { width: 3rem; height: 3rem; border-radius: 9999px; background: rgba(255,255,255,0.15); border: 2px solid rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.125rem; flex-shrink: 0; }
    .cm-header-info { flex: 1; }
    .cm-header-name { font-weight: 700; font-size: 1.1rem; color: white; }
    .cm-header-meta { font-size: 0.75rem; color: rgba(255,255,255,0.5); margin-top: 0.125rem; }
    .cm-badge { display: inline-flex; padding: 0.2rem 0.625rem; border-radius: 9999px; font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.025em; }
    .cm-badge-new { background: #fef3c7; color: #92400e; }
    .cm-badge-read { background: #e8d0b0; color: #3d2314; }
    .cm-badge-replied { background: #d1fae5; color: #065f46; }

    .cm-contact { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-bottom: 1rem; }
    .cm-contact-item { display: flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1rem; background: white; border: 1px solid #e8d0b0; border-radius: 0.5rem; font-size: 0.85rem; color: #3d2314; }
    .cm-contact-icon { font-size: 1rem; }
    .cm-contact-item a { color: #8b5e3c; text-decoration: none; font-weight: 500; }
    .cm-contact-item a:hover { text-decoration: underline; }

    .cm-message-card { border: 1px solid #e8d0b0; border-radius: 0.75rem; overflow: hidden; margin-bottom: 1rem; background: white; }
    .cm-message-header { padding: 0.875rem 1.25rem; background: #fdf8f2; border-bottom: 1px solid #f3ebe0; display: flex; align-items: center; justify-content: space-between; }
    .cm-message-subject { font-weight: 700; color: #3d2314; font-size: 1rem; }
    .cm-message-date { font-size: 0.75rem; color: #a08060; }
    .cm-message-body { padding: 1.25rem; font-size: 0.9rem; color: #4a3225; line-height: 1.6; white-space: pre-wrap; }

    .cm-orders-card { border: 1px solid #e8d0b0; border-radius: 0.75rem; overflow: hidden; background: white; }
    .cm-orders-banner { display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1.25rem; background: linear-gradient(135deg, #3d2314, #6b4c3b); }
    .cm-orders-title { font-size: 0.8rem; font-weight: 700; color: white; text-transform: uppercase; letter-spacing: 0.05em; }
    .cm-orders-count { font-size: 0.7rem; font-weight: 700; color: #3d2314; background: #fef3c7; padding: 0.15rem 0.5rem; border-radius: 9999px; }
    .cm-orders-summary { padding: 0.75rem 1.25rem; background: #fdf8f2; border-bottom: 1px solid #f3ebe0; font-size: 0.8rem; color: #a08060; }
    .cm-orders-empty { padding: 1.5rem; text-align: center; color: #a08060; font-size: 0.85rem; font-style: italic; }

    .cm-order-row { display: flex; align-items: center; justify-content: space-between; padding: 0.625rem 1.25rem; border-bottom: 1px solid #f3ebe0; font-size: 0.85rem; }
    .cm-order-row:last-child { border-bottom: none; }
    .cm-order-row:hover { background: #fdf8f2; }
    .cm-order-num { font-family: monospace; font-weight: 700; color: #3d2314; }
    .cm-order-meta { display: flex; align-items: center; gap: 0.5rem; }
    .cm-order-date { color: #a08060; font-size: 0.8rem; }
    .cm-order-total { font-weight: 700; color: #3d2314; }
    .cm-order-status { display: inline-flex; padding: 0.15rem 0.4rem; border-radius: 9999px; font-size: 0.6rem; font-weight: 600; text-transform: uppercase; }
    .cm-status-pending { background: #fef3c7; color: #92400e; }
    .cm-status-confirmed { background: #e8d0b0; color: #3d2314; }
    .cm-status-baking { background: #fde68a; color: #78350f; }
    .cm-status-ready { background: #d1fae5; color: #065f46; }
    .cm-status-delivered { background: #f3ebe0; color: #6b4c3b; }
    .cm-status-cancelled { background: #fee2e2; color: #991b1b; }
</style>

<div class="cm-wrap">
    {{-- Header banner --}}
    <div class="cm-header">
        <div class="cm-avatar">{{ strtoupper(substr($message->name, 0, 1)) }}</div>
        <div class="cm-header-info">
            <div class="cm-header-name">{{ $message->name }}</div>
            <div class="cm-header-meta">{{ $message->created_at->diffForHumans() }} · {{ $message->created_at->format('M j, Y g:i A') }}</div>
        </div>
        <span class="cm-badge cm-badge-{{ $message->status }}">{{ ucfirst($message->status) }}</span>
    </div>

    {{-- Contact info --}}
    <div class="cm-contact">
        <div class="cm-contact-item">
            <span class="cm-contact-icon">✉️</span>
            <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
        </div>
        <div class="cm-contact-item">
            <span class="cm-contact-icon">📱</span>
            {{ $message->phone ?? '—' }}
        </div>
    </div>

    {{-- Message --}}
    <div class="cm-message-card">
        <div class="cm-message-header">
            <span class="cm-message-subject">{{ $message->subject }}</span>
        </div>
        <div class="cm-message-body">{{ $message->message }}</div>
    </div>

    {{-- Order history --}}
    <div class="cm-orders-card">
        <div class="cm-orders-banner">
            <span class="cm-orders-title">Order History</span>
            <span class="cm-orders-count">{{ $orders->count() }}</span>
        </div>
        @if($orders->isEmpty())
            <div class="cm-orders-empty">No previous orders from this email</div>
        @else
            <div class="cm-orders-summary">{{ $orders->count() }} {{ Str::plural('order', $orders->count()) }} · ${{ number_format($orders->sum('total'), 2) }} total</div>
            @foreach($orders as $order)
                <div class="cm-order-row">
                    <div class="cm-order-meta">
                        <span class="cm-order-num">{{ $order->order_number }}</span>
                        <span class="cm-order-status cm-status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                        <span class="cm-order-date">{{ $order->created_at->format('M j, Y') }}</span>
                    </div>
                    <span class="cm-order-total">${{ number_format($order->total, 2) }}</span>
                </div>
            @endforeach
        @endif
    </div>
</div>
