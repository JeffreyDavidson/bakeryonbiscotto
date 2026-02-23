<style>
    .qo-page { font-family: inherit; }
    .qo-header {
        display: flex; align-items: center; gap: 1rem;
        margin-top: 1rem; margin-bottom: 1.5rem; padding: 1.25rem 1.5rem;
        background: linear-gradient(135deg, #3d2314, #6b4c3b);
        border-radius: 0.75rem;
    }
    .qo-header h1 { font-size: 1.375rem; font-weight: 800; color: #fff !important; margin: 0; }
    .qo-header .subtitle { font-size: 0.8rem; color: rgba(255,255,255,0.6); }
    .qo-card {
        background: #fff; border: 1px solid #e8d0b0;
        border-radius: 0.75rem; padding: 1.5rem; margin-bottom: 1.5rem;
    }
    .qo-card h2 { font-size: 1rem; font-weight: 700; color: #3d2314; margin: 0 0 1rem 0; }
    .qo-grid { display: grid; gap: 1rem; }
    .qo-grid-3 { grid-template-columns: repeat(3, 1fr); }
    .qo-grid-2 { grid-template-columns: 1fr 1fr; }
    .qo-label { display: block; font-size: 0.8rem; font-weight: 600; color: #3d2314; margin-bottom: 0.25rem; }
    .qo-label .req { color: #dc2626; }
    .qo-input {
        width: 100%; padding: 0.5rem 0.75rem; border: 1px solid rgba(212,165,116,0.3);
        border-radius: 0.5rem; font-size: 0.875rem; outline: none; box-sizing: border-box;
    }
    .qo-input:focus { border-color: #d4a574; box-shadow: 0 0 0 3px rgba(212,165,116,0.15); }
    .qo-item-row {
        display: grid; grid-template-columns: 1fr 120px 100px 100px 40px;
        gap: 0.75rem; align-items: end; padding: 0.75rem 0;
        border-bottom: 1px solid rgba(212,165,116,0.1);
    }
    .qo-item-row:last-of-type { border-bottom: none; }
    .qo-remove-btn {
        background: none; border: none; color: #dc2626; cursor: pointer;
        font-size: 1.1rem; padding: 0.5rem; border-radius: 0.25rem;
    }
    .qo-remove-btn:hover { background: #fef2f2; }
    .qo-add-btn {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.5rem 1rem; margin-top: 0.75rem;
        background: #fdf8f2; border: 1px dashed #d4a574;
        border-radius: 0.5rem; color: #8b5e3c; font-weight: 600; font-size: 0.85rem;
        cursor: pointer;
    }
    .qo-add-btn:hover { background: #f5e6d0; }
    .qo-totals {
        background: #fdf8f2; border: 1px solid #e8d0b0;
        border-radius: 0.75rem; padding: 1.25rem 1.5rem; margin-bottom: 1.5rem;
    }
    .qo-total-row { display: flex; justify-content: space-between; padding: 0.375rem 0; font-size: 0.875rem; color: #6b4c3b; }
    .qo-total-row.grand {
        border-top: 2px solid #e8d0b0; margin-top: 0.5rem;
        padding-top: 0.75rem; font-size: 1.125rem; font-weight: 800; color: #3d2314;
    }
    .qo-submit {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.75rem 2rem; background: linear-gradient(135deg, #3d2314, #6b4c3b);
        color: white; border: none; border-radius: 0.5rem;
        font-size: 1rem; font-weight: 700; cursor: pointer; transition: opacity 0.15s;
    }
    .qo-submit:hover { opacity: 0.9; }
    .qo-error { color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem; }
    @media (max-width: 768px) {
        .qo-grid-3 { grid-template-columns: 1fr; }
        .qo-grid-2 { grid-template-columns: 1fr; }
        .qo-item-row { grid-template-columns: 1fr; }
    }
</style>

<x-filament-panels::page>
    <div class="qo-page" x-data="{
        prices: @js($this->productPrices),
        getPrice(id) { return parseFloat(this.prices[id] || 0); }
    }">
        <div class="qo-header">
            <div>
                <h1>🧁 Create Quick Order</h1>
                <div class="subtitle">Create an order on behalf of a customer</div>
            </div>
        </div>

        {{-- Customer Info --}}
        <div class="qo-card">
            <h2>👤 Customer Information</h2>
            <div class="qo-grid qo-grid-3">
                <div>
                    <label class="qo-label">Name <span class="req">*</span></label>
                    <input type="text" wire:model="customer_name" class="qo-input" placeholder="Customer name">
                    @error('customer_name') <div class="qo-error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="qo-label">Email <span class="req">*</span></label>
                    <input type="email" wire:model="customer_email" class="qo-input" placeholder="email@example.com">
                    @error('customer_email') <div class="qo-error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="qo-label">Phone</label>
                    <input type="tel" wire:model="customer_phone" class="qo-input" placeholder="(555) 123-4567">
                </div>
            </div>
        </div>

        {{-- Order Items --}}
        <div class="qo-card">
            <h2>🛒 Order Items</h2>
            <div>
                <div class="qo-item-row" style="font-size: 0.75rem; font-weight: 700; color: #8b5e3c; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #d4a574;">
                    <span>Product</span>
                    <span>Qty</span>
                    <span>Unit Price</span>
                    <span>Line Total</span>
                    <span></span>
                </div>
                @foreach($items as $index => $item)
                    <div class="qo-item-row" wire:key="item-{{ $index }}">
                        <div>
                            <select wire:model.live="items.{{ $index }}.product_id" class="qo-input">
                                <option value="">Select a product...</option>
                                @foreach($this->productOptions as $id => $label)
                                    <option value="{{ $id }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error("items.{$index}.product_id") <div class="qo-error">{{ $message }}</div> @enderror
                        </div>
                        <div>
                            <input type="number" wire:model.live="items.{{ $index }}.quantity" class="qo-input" min="1" value="1">
                        </div>
                        <div x-text="'$' + getPrice($wire.items[{{ $index }}]?.product_id).toFixed(2)" style="padding: 0.5rem 0; color: #6b4c3b;"></div>
                        <div x-text="'$' + (getPrice($wire.items[{{ $index }}]?.product_id) * parseInt($wire.items[{{ $index }}]?.quantity || 0)).toFixed(2)" style="padding: 0.5rem 0; font-weight: 700; color: #3d2314;"></div>
                        <div>
                            @if(count($items) > 1)
                                <button type="button" wire:click="removeItem({{ $index }})" class="qo-remove-btn" title="Remove">🗑</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" wire:click="addItem" class="qo-add-btn">+ Add Product</button>
            @error('items') <div class="qo-error">{{ $message }}</div> @enderror
        </div>

        {{-- Fulfillment --}}
        <div class="qo-card">
            <h2>🚚 Fulfillment</h2>
            <div class="qo-grid qo-grid-3">
                <div>
                    <label class="qo-label">Type <span class="req">*</span></label>
                    <select wire:model.live="fulfillment_type" class="qo-input">
                        <option value="pickup">Pickup</option>
                        <option value="delivery">Delivery</option>
                    </select>
                </div>
                <div>
                    <label class="qo-label">Date <span class="req">*</span></label>
                    <input type="date" wire:model="requested_date" class="qo-input" min="{{ now()->format('Y-m-d') }}">
                    @error('requested_date') <div class="qo-error">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="qo-label">Time Slot</label>
                    <select wire:model="requested_time" class="qo-input">
                        <option value="">Select time...</option>
                        <option value="09:00">9:00 AM</option>
                        <option value="10:00">10:00 AM</option>
                        <option value="11:00">11:00 AM</option>
                        <option value="12:00">12:00 PM</option>
                        <option value="13:00">1:00 PM</option>
                        <option value="14:00">2:00 PM</option>
                        <option value="15:00">3:00 PM</option>
                        <option value="16:00">4:00 PM</option>
                        <option value="17:00">5:00 PM</option>
                    </select>
                </div>
            </div>
            @if($fulfillment_type === 'delivery')
                <div class="qo-grid qo-grid-2" style="margin-top: 1rem;">
                    <div>
                        <label class="qo-label">Delivery Address</label>
                        <input type="text" wire:model="delivery_address" class="qo-input" placeholder="123 Main St, City, FL">
                    </div>
                    <div>
                        <label class="qo-label">Zip Code</label>
                        <input type="text" wire:model="delivery_zip" class="qo-input" placeholder="33837">
                    </div>
                </div>
            @endif
        </div>

        {{-- Notes --}}
        <div class="qo-card">
            <h2>📝 Notes</h2>
            <textarea wire:model="notes" class="qo-input" rows="3" placeholder="Special instructions, allergies, etc."></textarea>
        </div>

        {{-- Totals --}}
        <div class="qo-totals" x-data="{
            get subtotal() {
                let t = 0;
                for (const item of Object.values($wire.items || {})) {
                    const price = parseFloat(this.prices[item?.product_id] || 0);
                    const qty = parseInt(item?.quantity || 0);
                    t += price * qty;
                }
                return t;
            },
            prices: @js($this->productPrices),
            get deliveryFee() { return $wire.fulfillment_type === 'delivery' ? 5.00 : 0; }
        }">
            <div class="qo-total-row">
                <span>Subtotal</span>
                <span x-text="'$' + subtotal.toFixed(2)"></span>
            </div>
            <template x-if="deliveryFee > 0">
                <div class="qo-total-row">
                    <span>Delivery Fee</span>
                    <span x-text="'$' + deliveryFee.toFixed(2)"></span>
                </div>
            </template>
            <div class="qo-total-row grand">
                <span>Total</span>
                <span x-text="'$' + (subtotal + deliveryFee).toFixed(2)"></span>
            </div>
        </div>

        <button type="button" wire:click="submit" class="qo-submit">
            🧾 Create Order
        </button>
    </div>
</x-filament-panels::page>
