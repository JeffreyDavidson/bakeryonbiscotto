<x-filament-panels::page>
    <style>
        .ic-form-grid { display: grid; grid-template-columns: 1fr; gap: 1rem; }
        @media (min-width: 768px) { .ic-form-grid { grid-template-columns: 1fr 1fr; } }
        .ic-form-full { grid-column: 1 / -1; }
        .ic-label { display: block; font-size: 0.8rem; font-weight: 700; color: var(--brand-800); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.375rem; }
        .ic-label-hint { font-size: 0.75rem; font-weight: 400; color: var(--brand-500); text-transform: none; letter-spacing: normal; }
        .ic-select, .ic-textarea {
            display: block; width: 100%; border-radius: 0.5rem;
            padding: 0.5rem 0.75rem; font-size: 0.875rem; color: var(--brand-900);
            background: white; box-shadow: 0 0 0 1px var(--brand-200);
            border: none; outline: none; transition: box-shadow 0.15s;
        }
        .ic-select:focus, .ic-textarea:focus {
            box-shadow: 0 0 0 1px var(--brand-300), 0 0 0 4px rgba(212,165,116,0.15);
        }
        .ic-checkbox-wrap { display: flex; align-items: center; gap: 0.5rem; padding-bottom: 0.25rem; cursor: pointer; }
        .ic-checkbox-wrap input[type="checkbox"] {
            width: 1.125rem; height: 1.125rem; accent-color: var(--brand-700); border-radius: 0.25rem; cursor: pointer;
        }
        .ic-checkbox-label { font-size: 0.875rem; font-weight: 500; color: var(--brand-800); }
        .ic-actions { display: flex; gap: 0.75rem; margin-top: 1rem; }
        .ic-results-grid { display: grid; grid-template-columns: 1fr; gap: 1rem; margin-top: 1.5rem; }
        @media (min-width: 1024px) { .ic-results-grid { grid-template-columns: repeat(3, 1fr); } }
        .ic-caption-text { font-size: 0.875rem; line-height: 1.6; color: var(--brand-800); white-space: pre-line; }
        .ic-copy-btn {
            display: inline-flex; align-items: center; gap: 0.375rem;
            padding: 0.25rem 0.625rem; border-radius: 0.375rem;
            font-size: 0.75rem; font-weight: 600; color: var(--brand-700);
            background: transparent; border: none; cursor: pointer;
            transition: background 0.15s;
        }
        .ic-copy-btn:hover { background: var(--brand-150); }
        .ic-copy-btn svg { width: 1rem; height: 1rem; }
        .ic-empty { text-align: center; padding: 3rem 1rem; }
        .ic-empty-icon { width: 3rem; height: 3rem; color: var(--brand-300); margin: 0 auto 0.75rem; }
        .ic-empty-title { font-size: 0.875rem; font-weight: 700; color: var(--brand-900); }
        .ic-empty-sub { font-size: 0.8rem; color: var(--brand-500); margin-top: 0.25rem; }
    </style>

    {{-- Generator Form --}}
    <x-admin.card title="Caption Generator" subtitle="Select a product and customize your style">
        <div style="padding: 1rem 1.25rem;">
            <div class="ic-form-grid">
                {{-- Product --}}
                <div class="ic-form-full">
                    <label class="ic-label">Product</label>
                    <select wire:model="product_id" class="ic-select">
                        <option value="">— Select a product —</option>
                        @foreach ($this->products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }}
                                @if ($product->category) ({{ $product->category->name }}) @endif
                                — ${{ number_format($product->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Caption Style --}}
                <div>
                    <label class="ic-label">Caption Style</label>
                    <select wire:model="caption_style" class="ic-select">
                        <option value="casual">Casual</option>
                        <option value="promotional">Promotional</option>
                        <option value="storytelling">Storytelling</option>
                        <option value="seasonal">Seasonal</option>
                    </select>
                </div>

                {{-- Tone --}}
                <div>
                    <label class="ic-label">Tone</label>
                    <select wire:model="tone" class="ic-select">
                        <option value="fun">Fun</option>
                        <option value="professional">Professional</option>
                        <option value="warm">Warm</option>
                        <option value="exciting">Exciting</option>
                    </select>
                </div>

                {{-- Call to Action --}}
                <div>
                    <label class="ic-label">Call to Action</label>
                    <select wire:model="call_to_action" class="ic-select">
                        <option value="order_now">Order Now</option>
                        <option value="link_in_bio">Link in Bio</option>
                        <option value="dm_us">DM Us</option>
                        <option value="none">None</option>
                    </select>
                </div>

                {{-- Hashtags Toggle --}}
                <div style="display: flex; align-items: flex-end; padding-bottom: 0.25rem;">
                    <label class="ic-checkbox-wrap">
                        <input type="checkbox" wire:model="include_hashtags">
                        <span class="ic-checkbox-label">Include Hashtags</span>
                    </label>
                </div>

                {{-- Custom Note --}}
                <div class="ic-form-full">
                    <label class="ic-label">Custom Note <span class="ic-label-hint">(optional)</span></label>
                    <textarea wire:model="custom_note" rows="2"
                        placeholder="e.g. just came out of the oven, new recipe, perfect for Valentine's Day..."
                        class="ic-textarea"></textarea>
                </div>
            </div>

            <div class="ic-actions">
                <x-admin.btn wire:click="generate" style="background: linear-gradient(135deg, var(--brand-900), var(--brand-700)); color: white; border: none;">
                    ✨ Generate Captions
                </x-admin.btn>

                @if ($generated)
                    <x-admin.btn wire:click="regenerate" style="background: white; color: var(--brand-800); border: 1px solid var(--brand-200);">
                        ↻ Regenerate
                    </x-admin.btn>
                @endif
            </div>
        </div>
    </x-admin.card>

    {{-- Results --}}
    @if ($generated && count($captions))
        <div class="ic-results-grid">
            @foreach ($captions as $index => $caption)
                <x-admin.card title="Option {{ $index + 1 }}">
                    <div style="padding: 1rem 1.25rem;">
                        <div style="display: flex; justify-content: flex-end; margin-bottom: 0.5rem;">
                            <button
                                x-data="{ copied: false }"
                                x-on:click="
                                    navigator.clipboard.writeText($refs['caption{{ $index }}'].innerText);
                                    copied = true;
                                    setTimeout(() => copied = false, 1500);
                                "
                                class="ic-copy-btn"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9.75a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" /></svg>
                                <span x-text="copied ? 'Copied!' : 'Copy'"></span>
                            </button>
                        </div>
                        <div x-ref="caption{{ $index }}" class="ic-caption-text">{{ $caption }}</div>
                    </div>
                </x-admin.card>
            @endforeach
        </div>
    @elseif (!$generated)
        <x-admin.card>
            <div class="ic-empty">
                <svg class="ic-empty-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" /></svg>
                <div class="ic-empty-title">No captions yet</div>
                <div class="ic-empty-sub">Select a product and hit generate to get started.</div>
            </div>
        </x-admin.card>
    @endif
</x-filament-panels::page>
