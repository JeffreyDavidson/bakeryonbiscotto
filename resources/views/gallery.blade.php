@extends('layouts.storefront', ['title' => 'Gallery | Bakery on Biscotto', 'active' => 'gallery'])

@section('extra_fonts')
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&display=swap" rel="stylesheet">
@endsection

@section('styles')
    <style>
        /* ═══ HERO ═══ */
        .gallery-hero {
            position: relative;
            padding: 160px 20px 80px;
            background: #1c1410;
            text-align: center;
            overflow: hidden;
        }
        .gallery-hero::before {
            content: '';
            position: absolute; inset: 0;
            background:
                repeating-linear-gradient(85deg, transparent, rgba(80,55,35,0.06) 1px, transparent 3px),
                repeating-linear-gradient(88deg, transparent, rgba(60,40,25,0.04) 2px, transparent 5px),
                radial-gradient(ellipse at 50% 50%, rgba(244,200,122,0.04), transparent 50%);
            pointer-events: none;
        }
        .gallery-hero h1 {
            position: relative;
            font-family: 'Dancing Script', cursive;
            font-size: clamp(2.8rem, 6vw, 4.5rem);
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 16px;
        }
        .gallery-hero .hero-sub {
            position: relative;
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 18px;
            color: rgba(245,230,208,0.35);
        }

        /* ═══ CATEGORY FILTERS ═══ */
        .gallery-filters {
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
            padding: 40px 20px 0;
            background: #1c1410;
        }
        .filter-btn {
            font-family: 'Cormorant Garamond', serif;
            font-size: 15px;
            padding: 8px 24px;
            border-radius: 24px;
            border: 1px solid rgba(212,165,116,0.25);
            background: transparent;
            color: rgba(245,230,208,0.5);
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: capitalize;
        }
        .filter-btn:hover {
            border-color: rgba(212,165,116,0.5);
            color: var(--cream);
        }
        .filter-btn.active {
            background: rgba(212,165,116,0.15);
            border-color: var(--golden);
            color: var(--golden);
        }

        /* ═══ SECTION HEAD ═══ */
        .section-head {
            text-align: center; margin-bottom: 60px;
        }
        .section-head h2 {
            font-family: 'Dancing Script', cursive;
            color: var(--cream);
            font-size: clamp(2.8rem, 6vw, 4rem);
            font-weight: 700;
        }
        .section-head .accent-line {
            background: linear-gradient(90deg, transparent, var(--golden), transparent);
            width: 120px;
            height: 3px; margin: 16px auto 0;
            border-radius: 2px;
        }

        /* ═══ FRESH FROM THE OVEN ═══ */
        .fresh-oven {
            padding: 40px 20px 100px;
            position: relative; overflow: hidden;
            background: #1c1410;
        }
        .fresh-oven::before {
            content: '';
            position: absolute; inset: 0;
            background:
                repeating-linear-gradient(85deg, transparent, rgba(80,55,35,0.06) 1px, transparent 3px),
                repeating-linear-gradient(88deg, transparent, rgba(60,40,25,0.04) 2px, transparent 5px),
                radial-gradient(ellipse at 50% 50%, rgba(244,200,122,0.04), transparent 50%);
            pointer-events: none;
        }

        .ft-container {
            max-width: 900px; margin: 0 auto;
            position: relative;
        }

        /* Flour dust patches */
        .flour-patch {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
        }
        .flour-patch::before {
            content: '';
            position: absolute; inset: 0;
            border-radius: 50%;
            background: radial-gradient(circle,
                rgba(245,235,220,0.35) 0%,
                rgba(245,235,220,0.18) 30%,
                rgba(245,235,220,0.06) 55%,
                transparent 75%
            );
        }
        .flour-patch::after {
            content: '';
            position: absolute;
            width: 250%; height: 250%;
            top: -75%; left: -75%;
            background-image:
                radial-gradient(circle at 18% 28%, rgba(245,235,220,0.6) 1.5px, transparent 1.5px),
                radial-gradient(circle at 55% 12%, rgba(245,235,220,0.5) 2px, transparent 2px),
                radial-gradient(circle at 82% 55%, rgba(245,235,220,0.55) 1.5px, transparent 1.5px),
                radial-gradient(circle at 38% 68%, rgba(245,235,220,0.45) 2.5px, transparent 2.5px),
                radial-gradient(circle at 12% 78%, rgba(245,235,220,0.5) 1.5px, transparent 1.5px),
                radial-gradient(circle at 72% 38%, rgba(245,235,220,0.55) 2px, transparent 2px),
                radial-gradient(circle at 28% 48%, rgba(245,235,220,0.4) 3px, transparent 3px),
                radial-gradient(circle at 88% 22%, rgba(245,235,220,0.45) 2px, transparent 2px),
                radial-gradient(circle at 48% 88%, rgba(245,235,220,0.5) 2px, transparent 2px),
                radial-gradient(circle at 65% 75%, rgba(245,235,220,0.35) 2.5px, transparent 2.5px),
                radial-gradient(circle at 8% 45%, rgba(245,235,220,0.55) 1.5px, transparent 1.5px),
                radial-gradient(circle at 42% 15%, rgba(245,235,220,0.4) 2px, transparent 2px);
            pointer-events: none;
        }

        .flour-patch.fp1 { width: 320px; height: 300px; top: -40px; left: -30px; }
        .flour-patch.fp2 { width: 280px; height: 250px; bottom: -30px; right: -10px; }
        .flour-patch.fp3 { width: 200px; height: 180px; top: 35%; left: 50%; }
        .flour-patch.fp4 { width: 150px; height: 140px; top: 15%; right: 10%; }
        .flour-patch.fp5 { width: 160px; height: 150px; bottom: 30%; left: 20%; }

        .flour-handprint {
            position: absolute;
            bottom: 30px; left: 50px;
            width: 70px; height: 80px;
            z-index: 1; pointer-events: none;
            transform: rotate(-15deg);
        }
        .flour-handprint::before {
            content: '';
            position: absolute;
            bottom: 0; left: 10px;
            width: 50px; height: 45px;
            border-radius: 50% 50% 45% 45%;
            background: radial-gradient(circle, rgba(245,235,220,0.22), rgba(245,235,220,0.08) 60%, transparent 80%);
        }
        .flour-handprint::after {
            content: '';
            position: absolute;
            top: 0; left: 5px;
            width: 60px; height: 40px;
            background:
                radial-gradient(ellipse at 15% 60%, rgba(245,235,220,0.18) 4px, transparent 4px),
                radial-gradient(ellipse at 35% 40%, rgba(245,235,220,0.2) 4px, transparent 4px),
                radial-gradient(ellipse at 55% 30%, rgba(245,235,220,0.18) 4px, transparent 4px),
                radial-gradient(ellipse at 75% 45%, rgba(245,235,220,0.16) 4px, transparent 4px),
                radial-gradient(ellipse at 90% 65%, rgba(245,235,220,0.14) 3px, transparent 3px);
        }

        .flour-trail {
            position: absolute;
            top: 45%; right: -20px;
            width: 220px; height: 60px;
            transform: rotate(-5deg);
            z-index: 1; pointer-events: none;
        }
        .flour-trail::before {
            content: '';
            position: absolute;
            top: 10px; left: 0; right: 0;
            height: 30px;
            background: linear-gradient(90deg,
                rgba(245,235,220,0.3),
                rgba(245,235,220,0.2) 30%,
                rgba(245,235,220,0.12) 60%,
                rgba(245,235,220,0.04) 85%,
                transparent
            );
            border-radius: 20px;
        }
        .flour-trail::after {
            content: '';
            position: absolute; inset: 0;
            background-image:
                radial-gradient(circle at 5% 20%, rgba(245,235,220,0.4) 2px, transparent 2px),
                radial-gradient(circle at 15% 80%, rgba(245,235,220,0.3) 2.5px, transparent 2.5px),
                radial-gradient(circle at 25% 10%, rgba(245,235,220,0.35) 1.5px, transparent 1.5px),
                radial-gradient(circle at 35% 70%, rgba(245,235,220,0.25) 2px, transparent 2px),
                radial-gradient(circle at 45% 30%, rgba(245,235,220,0.3) 2px, transparent 2px),
                radial-gradient(circle at 55% 60%, rgba(245,235,220,0.2) 1.5px, transparent 1.5px),
                radial-gradient(circle at 65% 15%, rgba(245,235,220,0.15) 2px, transparent 2px);
        }

        .flour-specks {
            position: absolute; inset: 0;
            pointer-events: none; z-index: 1;
        }
        .flour-specks span {
            position: absolute;
            background: rgba(245,235,220,0.5);
            border-radius: 50%;
        }
        .flour-specks span:nth-child(1) { width: 3px; height: 3px; top: 12%; left: 8%; }
        .flour-specks span:nth-child(2) { width: 2px; height: 2px; top: 25%; left: 32%; }
        .flour-specks span:nth-child(3) { width: 4px; height: 4px; top: 8%; left: 65%; opacity: 0.4; }
        .flour-specks span:nth-child(4) { width: 2px; height: 2px; top: 55%; left: 12%; }
        .flour-specks span:nth-child(5) { width: 3px; height: 3px; top: 70%; left: 45%; opacity: 0.35; }
        .flour-specks span:nth-child(6) { width: 2px; height: 2px; top: 40%; left: 88%; }
        .flour-specks span:nth-child(7) { width: 4px; height: 3px; top: 85%; left: 25%; opacity: 0.3; }
        .flour-specks span:nth-child(8) { width: 2px; height: 2px; top: 18%; left: 78%; }
        .flour-specks span:nth-child(9) { width: 3px; height: 3px; top: 62%; left: 72%; opacity: 0.4; }
        .flour-specks span:nth-child(10) { width: 2px; height: 2px; top: 35%; left: 55%; }
        .flour-specks span:nth-child(11) { width: 3px; height: 2px; top: 78%; left: 82%; opacity: 0.35; }
        .flour-specks span:nth-child(12) { width: 2px; height: 3px; top: 48%; left: 5%; }
        .flour-specks span:nth-child(13) { width: 4px; height: 4px; top: 22%; left: 42%; opacity: 0.25; }
        .flour-specks span:nth-child(14) { width: 2px; height: 2px; top: 90%; left: 58%; }
        .flour-specks span:nth-child(15) { width: 3px; height: 3px; top: 5%; left: 92%; opacity: 0.3; }

        .flour-swipe {
            position: absolute;
            top: 75%; left: 15%;
            width: 180px; height: 12px;
            z-index: 1; pointer-events: none;
            transform: rotate(3deg);
        }
        .flour-swipe::before {
            content: '';
            position: absolute; inset: 0;
            background: linear-gradient(90deg,
                transparent,
                rgba(28,20,16,0.6) 10%,
                rgba(28,20,16,0.8) 30%,
                rgba(28,20,16,0.8) 70%,
                rgba(28,20,16,0.6) 90%,
                transparent
            );
            border-radius: 6px;
        }
        .flour-swipe::after {
            content: '';
            position: absolute;
            top: -4px; left: 0; right: 0; bottom: -4px;
            background:
                linear-gradient(90deg,
                    transparent 5%,
                    rgba(245,235,220,0.25) 10%,
                    transparent 15%,
                    transparent 85%,
                    rgba(245,235,220,0.2) 90%,
                    transparent 95%
                ),
                linear-gradient(180deg,
                    rgba(245,235,220,0.2),
                    transparent 30%,
                    transparent 70%,
                    rgba(245,235,220,0.2)
                );
            border-radius: 6px;
        }

        .ft-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            grid-template-rows: auto auto auto;
            gap: 16px;
            position: relative; z-index: 2;
        }

        .ft-item {
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            cursor: pointer;
        }
        .ft-item:hover {
            transform: scale(1.03); z-index: 5;
            box-shadow: 0 12px 40px rgba(0,0,0,0.3);
        }
        .ft-item img {
            width: 100%; height: 100%; object-fit: cover; display: block;
        }
        .ft-item .ft-ph {
            width: 100%; height: 100%; min-height: 180px;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 6px;
            background: radial-gradient(circle, rgba(212,165,116,0.04), transparent 60%), #1a1208;
        }
        .ft-item .ft-overlay {
            position: absolute; bottom: 0; left: 0; right: 0;
            padding: 32px 14px 12px;
            background: linear-gradient(transparent, rgba(26,15,8,0.7));
        }
        .ft-item .ft-caption {
            font-family: 'Caveat', cursive; font-size: 18px; color: var(--cream);
        }
        .ft-item.ft-hero { grid-row: span 2; }

        /* ═══ LIGHTBOX ═══ */
        .lightbox-overlay {
            position: fixed; inset: 0;
            background: rgba(10, 6, 3, 0.92);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            cursor: pointer;
        }
        .lightbox-overlay img {
            max-width: 90vw;
            max-height: 85vh;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            cursor: default;
        }
        .lightbox-close {
            position: absolute;
            top: 20px; right: 24px;
            font-size: 32px;
            color: rgba(245,230,208,0.6);
            cursor: pointer;
            background: none; border: none;
            font-family: 'Cormorant Garamond', serif;
            transition: color 0.2s;
        }
        .lightbox-close:hover { color: var(--cream); }
        .lightbox-caption {
            position: absolute;
            bottom: 24px; left: 0; right: 0;
            text-align: center;
            font-family: 'Caveat', cursive;
            font-size: 22px;
            color: rgba(245,230,208,0.6);
        }

        /* ═══ EMPTY STATE ═══ */
        .gallery-empty {
            text-align: center;
            padding: 80px 20px;
            color: rgba(245,230,208,0.3);
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 18px;
        }

        /* ═══ SCROLL REVEAL ═══ */
        .reveal {
            opacity: 0; transform: translateY(28px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                        transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ═══ MOBILE ═══ */
        @media (max-width: 768px) {
            .ft-grid { grid-template-columns: 1fr 1fr; }
            .ft-item.ft-hero { grid-row: span 1; }
            .ft-item.ft-hero img { height: 220px; }
            .ft-item img, .ft-item .ft-ph { min-height: 160px; }
            .flour-patch.fp3, .flour-patch.fp4, .flour-patch.fp5 { display: none; }
            .flour-swipe { display: none; }
        }
    </style>
@endsection

@section('content')
    {{-- ═══ HERO ═══ --}}
    <section class="gallery-hero">
        <h1>Fresh from the Oven</h1>
        <p class="hero-sub">A peek into our kitchen and what's baking today.</p>
    </section>

    {{-- ═══ CATEGORY FILTERS ═══ --}}
    @if($categories->count() > 1)
        <div class="gallery-filters" x-data>
            <button class="filter-btn active" @click="$dispatch('filter-gallery', { category: 'all' }); document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active')); $el.classList.add('active')">All</button>
            @foreach($categories as $cat)
                <button class="filter-btn" @click="$dispatch('filter-gallery', { category: '{{ $cat }}' }); document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active')); $el.classList.add('active')">{{ ucfirst($cat) }}</button>
            @endforeach
        </div>
    @endif

    {{-- ═══ GALLERY ═══ --}}
    <section class="fresh-oven" x-data="galleryApp()">
        @if($photos->count())
            <div class="ft-container reveal">
                <div class="flour-patch fp1"></div>
                <div class="flour-patch fp2"></div>
                <div class="flour-patch fp3"></div>
                <div class="flour-patch fp4"></div>
                <div class="flour-patch fp5"></div>

                <div class="flour-specks">
                    <span></span><span></span><span></span><span></span><span></span>
                    <span></span><span></span><span></span><span></span><span></span>
                    <span></span><span></span><span></span><span></span><span></span>
                </div>

                <div class="flour-trail"></div>
                <div class="flour-swipe"></div>
                <div class="flour-handprint"></div>

                <div class="ft-grid">
                    @foreach($photos as $index => $photo)
                        <div
                            class="ft-item {{ $index === 0 ? 'ft-hero' : '' }}"
                            data-category="{{ $photo->category }}"
                            @click="openLightbox('{{ $photo->image_path ? Storage::disk('public')->url($photo->image_path) : '' }}', '{{ addslashes($photo->title ?? '') }}')"
                            x-show="activeCategory === 'all' || activeCategory === '{{ $photo->category }}'"
                            x-transition
                        >
                            @if($photo->image_path)
                                <img src="{{ Storage::disk('public')->url($photo->image_path) }}" alt="{{ $photo->title ?? 'Gallery photo' }}">
                            @else
                                <div class="ft-ph">
                                    <span class="ph-text">Photo coming soon</span>
                                </div>
                            @endif
                            @if($photo->title)
                                <div class="ft-overlay"><span class="ft-caption">{{ $photo->title }}</span></div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="gallery-empty">
                <p>Photos coming soon&hellip;</p>
            </div>
        @endif

        {{-- ═══ LIGHTBOX ═══ --}}
        <template x-if="lightboxOpen">
            <div class="lightbox-overlay" @click.self="lightboxOpen = false" @keydown.escape.window="lightboxOpen = false">
                <button class="lightbox-close" @click="lightboxOpen = false">&times;</button>
                <img :src="lightboxSrc" :alt="lightboxCaption">
                <div class="lightbox-caption" x-text="lightboxCaption" x-show="lightboxCaption"></div>
            </div>
        </template>
    </section>
@endsection

@section('scripts')
    <script>
        function galleryApp() {
            return {
                activeCategory: 'all',
                lightboxOpen: false,
                lightboxSrc: '',
                lightboxCaption: '',
                init() {
                    window.addEventListener('filter-gallery', (e) => {
                        this.activeCategory = e.detail.category;
                    });
                },
                openLightbox(src, caption) {
                    if (!src) return;
                    this.lightboxSrc = src;
                    this.lightboxCaption = caption;
                    this.lightboxOpen = true;
                }
            };
        }

        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
@endsection
