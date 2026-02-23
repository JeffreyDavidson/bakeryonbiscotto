<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Generator Form --}}
        <x-filament::section>
            <x-slot name="heading">Caption Generator</x-slot>
            <x-slot name="description">Select a product and customize your caption style.</x-slot>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Product --}}
                <div class="md:col-span-2">
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3 mb-1">
                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Product</span>
                    </label>
                    <select wire:model="product_id"
                        class="fi-select-input block w-full rounded-lg border-none bg-white py-1.5 pe-8 ps-3 text-base text-gray-950 shadow-sm ring-1 ring-gray-950/10 transition duration-75 focus:ring-2 focus:ring-primary-600 dark:bg-white/5 dark:text-white dark:ring-white/20 sm:text-sm sm:leading-6">
                        <option value="">-- Select a product --</option>
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
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3 mb-1">
                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Caption Style</span>
                    </label>
                    <select wire:model="caption_style"
                        class="fi-select-input block w-full rounded-lg border-none bg-white py-1.5 pe-8 ps-3 text-base text-gray-950 shadow-sm ring-1 ring-gray-950/10 transition duration-75 focus:ring-2 focus:ring-primary-600 dark:bg-white/5 dark:text-white dark:ring-white/20 sm:text-sm sm:leading-6">
                        <option value="casual">Casual</option>
                        <option value="promotional">Promotional</option>
                        <option value="storytelling">Storytelling</option>
                        <option value="seasonal">Seasonal</option>
                    </select>
                </div>

                {{-- Tone --}}
                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3 mb-1">
                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Tone</span>
                    </label>
                    <select wire:model="tone"
                        class="fi-select-input block w-full rounded-lg border-none bg-white py-1.5 pe-8 ps-3 text-base text-gray-950 shadow-sm ring-1 ring-gray-950/10 transition duration-75 focus:ring-2 focus:ring-primary-600 dark:bg-white/5 dark:text-white dark:ring-white/20 sm:text-sm sm:leading-6">
                        <option value="fun">Fun</option>
                        <option value="professional">Professional</option>
                        <option value="warm">Warm</option>
                        <option value="exciting">Exciting</option>
                    </select>
                </div>

                {{-- Call to Action --}}
                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3 mb-1">
                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Call to Action</span>
                    </label>
                    <select wire:model="call_to_action"
                        class="fi-select-input block w-full rounded-lg border-none bg-white py-1.5 pe-8 ps-3 text-base text-gray-950 shadow-sm ring-1 ring-gray-950/10 transition duration-75 focus:ring-2 focus:ring-primary-600 dark:bg-white/5 dark:text-white dark:ring-white/20 sm:text-sm sm:leading-6">
                        <option value="order_now">Order Now</option>
                        <option value="link_in_bio">Link in Bio</option>
                        <option value="dm_us">DM Us</option>
                        <option value="none">None</option>
                    </select>
                </div>

                {{-- Hashtags Toggle --}}
                <div class="flex items-end pb-1">
                    <label class="inline-flex items-center gap-x-3 cursor-pointer">
                        <input type="checkbox" wire:model="include_hashtags"
                            class="fi-checkbox-input rounded border-gray-300 text-primary-600 shadow-sm focus:ring-primary-600 dark:border-white/20 dark:bg-white/5">
                        <span class="text-sm font-medium text-gray-950 dark:text-white">Include Hashtags</span>
                    </label>
                </div>

                {{-- Custom Note --}}
                <div class="md:col-span-2">
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-3 mb-1">
                        <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">Custom Note</span>
                        <span class="text-xs text-gray-500">(optional)</span>
                    </label>
                    <textarea wire:model="custom_note" rows="2"
                        placeholder="e.g. just came out of the oven, new recipe, perfect for Valentine's Day..."
                        class="fi-textarea-input block w-full rounded-lg border-none bg-white py-1.5 px-3 text-base text-gray-950 shadow-sm ring-1 ring-gray-950/10 transition duration-75 focus:ring-2 focus:ring-primary-600 dark:bg-white/5 dark:text-white dark:ring-white/20 sm:text-sm sm:leading-6"></textarea>
                </div>
            </div>

            <div class="mt-4 flex gap-3">
                <x-filament::button wire:click="generate" icon="heroicon-m-sparkles">
                    Generate Captions
                </x-filament::button>

                @if ($generated)
                    <x-filament::button wire:click="regenerate" color="gray" icon="heroicon-m-arrow-path">
                        Regenerate
                    </x-filament::button>
                @endif
            </div>
        </x-filament::section>

        {{-- Results --}}
        @if ($generated && count($captions))
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                @foreach ($captions as $index => $caption)
                    <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-sm font-semibold text-gray-950 dark:text-white">
                                Option {{ $index + 1 }}
                            </h3>
                            <button
                                x-data
                                x-on:click="
                                    navigator.clipboard.writeText($refs['caption{{ $index }}'].innerText);
                                    $tooltip('Copied!', { timeout: 1500 });
                                "
                                class="inline-flex items-center gap-1 rounded-lg px-2 py-1 text-xs font-medium text-primary-600 hover:bg-primary-50 dark:text-primary-400 dark:hover:bg-primary-950 transition"
                            >
                                <x-heroicon-m-clipboard class="h-4 w-4" />
                                Copy
                            </button>
                        </div>
                        <div x-ref="caption{{ $index }}"
                            class="text-sm leading-relaxed text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $caption }}</div>
                    </div>
                @endforeach
            </div>
        @elseif (!$generated)
            <div class="rounded-xl bg-gray-50 dark:bg-gray-900 p-8 text-center">
                <x-heroicon-o-camera class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" />
                <h3 class="mt-2 text-sm font-semibold text-gray-950 dark:text-white">No captions yet</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Select a product and hit generate to get started.</p>
            </div>
        @endif
    </div>
</x-filament-panels::page>
