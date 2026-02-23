<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div
        x-data="{
            query: $wire.get('{{ $getStatePath() }}') || '',
            suggestions: [],
            async search() {
                const q = (this.query || '').trim();
                if (q.length < 5) { this.suggestions = []; return; }
                try {
                    const resp = await fetch('https://nominatim.openstreetmap.org/search?q=' + encodeURIComponent(q) + '&format=json&addressdetails=1&countrycodes=us&viewbox=-82.2,28.7,-81.2,27.9&bounded=1&limit=5', {
                        headers: { 'Accept': 'application/json' }
                    });
                    const data = await resp.json();
                    this.suggestions = data
                        .filter(r => r.address && r.address.state === 'Florida')
                        .map(r => {
                            const a = r.address;
                            const street = [a.house_number, a.road].filter(Boolean).join(' ');
                            const city = a.city || a.town || a.village || a.hamlet || '';
                            const parts = [street, city, a.state, a.postcode].filter(Boolean);
                            return { display: parts.join(', '), zip: a.postcode || '' };
                        })
                        .filter(s => s.display.includes(','));
                } catch (e) { this.suggestions = []; }
            },
            select(s) {
                this.query = s.display;
                this.suggestions = [];
                $wire.set('{{ $getStatePath() }}', s.display);
                $wire.set('{{ str_replace('delivery_address', 'delivery_zip', $getStatePath()) }}', s.zip);
            }
        }"
        @click.outside="suggestions = []"
        style="position: relative;"
    >
        <input
            type="text"
            x-model="query"
            @input.debounce.400ms="search()"
            placeholder="Start typing an address..."
            autocomplete="off"
            data-1p-ignore
            data-lpignore="true"
            style="width:100%;padding:0.5rem 0.75rem;border:1px solid rgba(212,165,116,0.3);border-radius:0.5rem;font-size:0.875rem;outline:none;background:white;"
            onfocus="this.style.borderColor='#d4a574';this.style.boxShadow='0 0 0 3px rgba(212,165,116,0.15)'"
            onblur="this.style.borderColor='rgba(212,165,116,0.3)';this.style.boxShadow='none'"
        />
        <div
            x-show="suggestions.length > 0"
            x-cloak
            style="position:absolute;z-index:50;top:100%;left:0;right:0;background:white;border:1px solid #e8d0b0;border-radius:0.5rem;box-shadow:0 10px 25px rgba(61,35,20,0.12);max-height:200px;overflow-y:auto;margin-top:4px;"
        >
            <template x-for="(s, i) in suggestions" :key="i">
                <button
                    type="button"
                    @click="select(s)"
                    x-text="s.display"
                    style="display:block;width:100%;text-align:left;padding:0.625rem 0.75rem;font-size:0.85rem;color:#3d2314;border:none;background:none;cursor:pointer;border-bottom:1px solid rgba(212,165,116,0.1);"
                    onmouseover="this.style.background='#fdf8f2'"
                    onmouseout="this.style.background='none'"
                ></button>
            </template>
        </div>
    </div>
</x-dynamic-component>
