<div
    x-data="{
        query: $wire.entangle('{{ $getStatePath() }}'),
        suggestions: [],
        async search() {
            const q = (this.query || '').trim();
            if (q.length < 5) { this.suggestions = []; return; }
            try {
                const resp = await fetch('https://photon.komoot.io/api/?q=' + encodeURIComponent(q) + '&limit=5&lat=28.317&lon=-81.652&lang=en');
                const data = await resp.json();
                this.suggestions = data.features
                    .filter(f => f.properties.country === 'United States' && f.properties.state === 'Florida')
                    .map(f => {
                        const p = f.properties;
                        const parts = [p.housenumber, p.street, p.city, p.state, p.postcode].filter(Boolean);
                        return { display: parts.join(', '), zip: p.postcode || '' };
                    });
            } catch (e) { this.suggestions = []; }
        },
        select(s) {
            this.query = s.display;
            this.suggestions = [];
            $wire.set('{{ str_replace('delivery_address', 'delivery_zip', $getStatePath()) }}', s.zip);
        }
    }"
    class="relative"
    @click.outside="suggestions = []"
>
    <input
        type="text"
        x-model="query"
        @input.debounce.400ms="search()"
        placeholder="Start typing an address..."
        autocomplete="off"
        data-1p-ignore
        data-lpignore="true"
        class="fi-input block w-full border-none bg-transparent px-3 py-1.5 text-base text-gray-950 outline-none transition duration-75 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
    />
    <div
        x-show="suggestions.length > 0"
        x-cloak
        style="position: absolute; z-index: 50; top: 100%; left: 0; right: 0; background: white; border: 1px solid #e8d0b0; border-radius: 0.5rem; box-shadow: 0 10px 25px rgba(61,35,20,0.12); max-height: 200px; overflow-y: auto;"
    >
        <template x-for="(s, i) in suggestions" :key="i">
            <button
                type="button"
                @click="select(s)"
                x-text="s.display"
                style="display: block; width: 100%; text-align: left; padding: 0.625rem 0.75rem; font-size: 0.85rem; color: #3d2314; border: none; background: none; cursor: pointer; border-bottom: 1px solid rgba(212,165,116,0.1);"
                onmouseover="this.style.background='#fdf8f2'"
                onmouseout="this.style.background='none'"
            ></button>
        </template>
    </div>
</div>
