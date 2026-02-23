<div style="background: #fdf8f2; margin: -1.5rem; padding: 1.5rem; min-height: 100%;">
    {{-- Customer card --}}
    <x-admin.card>
        <div data-admin-gradient-header style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem 1.5rem;">
            <x-admin.avatar :name="$customer->customer_name" />
            <div style="flex:1;">
                <div data-header-title style="font-weight: 700; font-size: 1rem; color: white;">{{ $customer->customer_name }}</div>
                <div style="font-size: 0.7rem; color: rgba(255,255,255,0.5); margin-top: 0.125rem;">Customer since {{ \Carbon\Carbon::parse($stats->first_order_date)->format('M j, Y') }} · Last order {{ $orders->first()?->created_at->diffForHumans() ?? 'N/A' }}</div>
            </div>
            <x-admin.btn variant="primary" href="mailto:{{ $customer->customer_email }}" icon="✉️" style="padding: 0.4rem 0.875rem; font-size: 0.75rem;">Email</x-admin.btn>
        </div>
        <div style="padding: 1rem 1.25rem;">
            <x-admin.info-row label="Email" :value="$customer->customer_email" :href="'mailto:' . $customer->customer_email" />
            @if($customer->customer_phone)
                <x-admin.info-row label="Phone" :value="$customer->customer_phone" :href="'tel:' . $customer->customer_phone" />
            @endif
        </div>
    </x-admin.card>

    {{-- Stats --}}
    <x-admin.stat-grid :cols="3" data-stat-grid>
        <x-admin.stat-card :label="Str::plural('Order', $customer->orders_count)" :value="$customer->orders_count" />
        <x-admin.stat-card label="Total Spent" :value="'$' . number_format($customer->total_spent, 2)" />
        <x-admin.stat-card label="Avg Order" :value="'$' . number_format($stats->avg_order_value, 2)" />
    </x-admin.stat-grid>

    {{-- Customer Notes --}}
    <x-admin.card title="Customer Notes" :subtitle="(string) $customerNotes->count()">
        <div style="padding: 1rem 1.25rem;">
            {{-- Important notes first --}}
            @foreach($customerNotes->where('is_important', true) as $cn)
                <div style="padding:0.75rem 1rem;margin-bottom:0.5rem;background:#fffbeb;border:1px solid #f59e0b;border-radius:0.5rem;">
                    <div style="display:flex;align-items:start;gap:0.5rem;">
                        <span style="color:#d97706;font-size:1rem;line-height:1;">&#9888;</span>
                        <div style="flex:1;">
                            <div style="font-size:0.85rem;color:#92400e;font-weight:600;line-height:1.4;">{{ $cn->note }}</div>
                            <div style="font-size:0.7rem;color:#b45309;margin-top:0.25rem;">{{ $cn->created_by ?? 'Unknown' }} · {{ $cn->created_at->format('M j, Y g:i A') }}</div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- Regular notes --}}
            @foreach($customerNotes->where('is_important', false) as $cn)
                <div style="padding:0.75rem 1rem;margin-bottom:0.5rem;background:#fdf8f2;border:1px solid #e8d0b0;border-radius:0.5rem;">
                    <div style="font-size:0.85rem;color:#3d2314;line-height:1.4;">{{ $cn->note }}</div>
                    <div style="font-size:0.7rem;color:#a08060;margin-top:0.25rem;">{{ $cn->created_by ?? 'Unknown' }} · {{ $cn->created_at->format('M j, Y g:i A') }}</div>
                </div>
            @endforeach

            @if($customerNotes->isEmpty())
                <div style="font-size:0.85rem;color:#c4a882;font-style:italic;">No notes yet.</div>
            @endif

            {{-- Add Note Form --}}
            <div x-data="{ note: '', isImportant: false, saving: false }" style="margin-top:0.75rem;padding-top:0.75rem;border-top:1px solid #e8d0b0;">
                <textarea x-model="note" placeholder="Add a note about this customer..." rows="2" style="width:100%;border:1px solid #e8d0b0;border-radius:0.5rem;padding:0.5rem 0.75rem;font-size:0.85rem;resize:vertical;background:#fff;color:#3d2314;font-family:inherit;"></textarea>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-top:0.5rem;">
                    <label style="display:flex;align-items:center;gap:0.375rem;font-size:0.8rem;color:#92400e;cursor:pointer;">
                        <input type="checkbox" x-model="isImportant" style="accent-color:#d97706;">
                        Important (allergies, critical info)
                    </label>
                    <button
                        x-on:click="if(note.trim()){saving=true;$wire.addCustomerNote('{{ $customer->customer_email }}','{{ addslashes($customer->customer_name) }}',note,isImportant).then(()=>{note='';isImportant=false;saving=false;})}"
                        x-bind:disabled="!note.trim() || saving"
                        style="padding:0.375rem 1rem;background:#8b5e3c;color:white;border:none;border-radius:0.375rem;font-size:0.8rem;font-weight:600;cursor:pointer;opacity:1;transition:opacity 0.15s;"
                        x-bind:style="(!note.trim()||saving) ? 'opacity:0.5;cursor:not-allowed;' : ''"
                    >
                        <span x-show="!saving">Save Note</span>
                        <span x-show="saving">Saving...</span>
                    </button>
                </div>
            </div>
        </div>
    </x-admin.card>

    {{-- Orders --}}
    <x-admin.card title="Order History" :subtitle="(string) $orders->count()">
        <x-admin.data-table data-admin-table>
            <x-slot:head>
                <th>Order</th>
                <th>Status</th>
                <th>Type</th>
                <th>Date</th>
                <th style="text-align:right;">Total</th>
                <th style="width:3.5rem;"></th>
            </x-slot:head>
            @foreach($orders as $order)
                <tr>
                    <td style="font-family:monospace;font-weight:700;color:#3d2314;">{{ $order->order_number }}</td>
                    <td><x-admin.badge :type="$order->status" /></td>
                    <td><x-admin.badge :type="$order->fulfillment_type" /></td>
                    <td style="color:#a08060;font-size:0.8rem;">{{ $order->created_at->format('M j, Y') }}</td>
                    <td style="text-align:right;font-weight:700;color:#3d2314;">${{ number_format($order->total, 2) }}</td>
                    <td style="text-align:right;"><x-admin.btn variant="ghost" href="/admin/orders/{{ $order->id }}" style="padding:0.3rem 0.625rem;font-size:0.7rem;">View</x-admin.btn></td>
                </tr>
            @endforeach
        </x-admin.data-table>
    </x-admin.card>
</div>
