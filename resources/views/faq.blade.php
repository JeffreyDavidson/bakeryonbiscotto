@extends('layouts.storefront', ['title' => 'FAQ | Bakery on Biscotto', 'active' => 'faq'])

@section('styles')
    <style>
        /* Hero */
        .faq-hero {
            padding: 140px 20px 60px;
            text-align: center;
            background: linear-gradient(180deg, var(--dark) 0%, var(--brand-800) 100%);
        }
        .faq-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 12px;
        }
        .faq-hero h1 em {
            font-family: 'Dancing Script', cursive;
            color: var(--golden);
        }
        .faq-hero p {
            font-family: 'Cormorant Garamond', serif;
            font-style: italic;
            font-size: 18px;
            color: rgba(245,230,208,0.5);
        }

        /* FAQ */
        .faq {
            padding: 80px 20px;
            background: var(--light);
        }
        .faq-list {
            max-width: 800px; margin: 0 auto;
            display: flex; flex-direction: column; gap: 0;
        }
        .faq-item {
            border-bottom: 1px solid rgba(61,35,20,0.1);
        }
        .faq-item:first-child {
            border-top: 1px solid rgba(61,35,20,0.1);
        }
        .faq-question {
            width: 100%;
            background: none; border: none;
            padding: 24px 40px 24px 0;
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem; font-weight: 600;
            color: var(--dark);
            text-align: left;
            cursor: pointer;
            position: relative;
            transition: color 0.3s;
        }
        .faq-question:hover { color: var(--accent); }
        .faq-question::after {
            content: '+';
            position: absolute; right: 0; top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem; font-weight: 300;
            color: var(--golden);
            transition: transform 0.3s;
        }
        .faq-item.open .faq-question::after {
            transform: translateY(-50%) rotate(45deg);
        }
        .faq-answer {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows 0.4s ease;
        }
        .faq-item.open .faq-answer {
            grid-template-rows: 1fr;
        }
        .faq-answer-inner {
            overflow: hidden;
        }
        .faq-answer-inner p {
            padding: 0 0 24px 0;
            color: var(--warm);
            line-height: 1.7;
        }
        .faq-answer-inner a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }
        .faq-answer-inner a:hover {
            text-decoration: underline;
        }

        /* Still have questions CTA */
        .faq-cta {
            text-align: center;
            padding: 40px 20px 0;
            max-width: 800px;
            margin: 0 auto;
        }
        .faq-cta p {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.2rem;
            color: var(--warm);
        }
        .faq-cta a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
        }
        .faq-cta a:hover { text-decoration: underline; }

        /* Responsive */
        @media (max-width: 600px) {
.faq-question { font-size: 1rem; }
        }
    </style>
@endsection

@section('content')
    <main id="main-content">

    <section class="faq-hero">
        <h1>Frequently Asked <em>Questions</em></h1>
        <p>Everything you need to know before you order.</p>
    </section>

    <section class="faq" x-data="{ open: null }">
        <div class="faq-list">
            <div class="faq-item" :class="{ 'open': open === 1 }">
                <button class="faq-question" :aria-expanded="open === 1 ? 'true' : 'false'" aria-controls="faq-answer-1" @click="open = open === 1 ? null : 1" @keydown.enter.prevent="open = open === 1 ? null : 1" @keydown.space.prevent="open = open === 1 ? null : 1">How do I order?</button>
                <div class="faq-answer" id="faq-answer-1" role="region"><div class="faq-answer-inner">
                    <p>Use our <a href="/order">online order page</a>! Pick what you'd like, choose pickup or delivery, and check out.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 2 }">
                <button class="faq-question" :aria-expanded="open === 2 ? 'true' : 'false'" aria-controls="faq-answer-2" @click="open = open === 2 ? null : 2" @keydown.enter.prevent="open = open === 2 ? null : 2" @keydown.space.prevent="open = open === 2 ? null : 2">How far in advance should I order?</button>
                <div class="faq-answer" id="faq-answer-2" role="region"><div class="faq-answer-inner">
                    <p>At least 2 days. Sourdough is a slow process. A basic loaf takes a minimum of 24 hours from feeding the starter to pulling it out of the oven. Every order is baked fresh, never in advance.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 3 }">
                <button class="faq-question" :aria-expanded="open === 3 ? 'true' : 'false'" aria-controls="faq-answer-3" @click="open = open === 3 ? null : 3" @keydown.enter.prevent="open = open === 3 ? null : 3" @keydown.space.prevent="open = open === 3 ? null : 3">Do you deliver?</button>
                <div class="faq-answer" id="faq-answer-3" role="region"><div class="faq-answer-inner">
                    <p>Yes! Pickup is in Davenport, FL and we deliver throughout the Four Corners and greater Orlando area for a fee based on mileage.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 4 }">
                <button class="faq-question" :aria-expanded="open === 4 ? 'true' : 'false'" aria-controls="faq-answer-4" @click="open = open === 4 ? null : 4" @keydown.enter.prevent="open = open === 4 ? null : 4" @keydown.space.prevent="open = open === 4 ? null : 4">What if I need to cancel?</button>
                <div class="faq-answer" id="faq-answer-4" role="region"><div class="faq-answer-inner">
                    <p>Cancellations made at least 48 hours in advance will receive a full refund. Between 24 and 48 hours notice will receive a 50% refund. Anything under 24 hours is non-refundable.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 5 }">
                <button class="faq-question" :aria-expanded="open === 5 ? 'true' : 'false'" aria-controls="faq-answer-5" @click="open = open === 5 ? null : 5" @keydown.enter.prevent="open = open === 5 ? null : 5" @keydown.space.prevent="open = open === 5 ? null : 5">What if I can't pick up at my scheduled time?</button>
                <div class="faq-answer" id="faq-answer-5" role="region"><div class="faq-answer-inner">
                    <p>Please contact us as soon as possible to discuss rescheduling. Orders will not be held longer than 24 hours. If your order is not picked up or rescheduled during that time, it will be considered cancelled with no refund.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 6 }">
                <button class="faq-question" :aria-expanded="open === 6 ? 'true' : 'false'" aria-controls="faq-answer-6" @click="open = open === 6 ? null : 6" @keydown.enter.prevent="open = open === 6 ? null : 6" @keydown.space.prevent="open = open === 6 ? null : 6">Can I customize my order?</button>
                <div class="faq-answer" id="faq-answer-6" role="region"><div class="faq-answer-inner">
                    <p>We don't take fully custom orders, but we can make small adjustments. Don't like walnuts in your banana bread? We can swap in pecans. We can't accommodate items outside our menu, but we always love hearing suggestions for future offerings.</p>
                </div></div>
            </div>
            <div class="faq-item" :class="{ 'open': open === 7 }">
                <button class="faq-question" :aria-expanded="open === 7 ? 'true' : 'false'" aria-controls="faq-answer-7" @click="open = open === 7 ? null : 7" @keydown.enter.prevent="open = open === 7 ? null : 7" @keydown.space.prevent="open = open === 7 ? null : 7">Why sourdough?</button>
                <div class="faq-answer" id="faq-answer-7" role="region"><div class="faq-answer-inner">
                    <p>It started with wanting bread without processed ingredients and preservatives. Sourdough uses a natural fermentation process, which means simpler ingredients and better flavor. No shortcuts, no additives.</p>
                </div></div>
            </div>
        </div>

        <div class="faq-cta">
            <p>Still have questions? <a href="/contact">Get in touch</a> and we'll be happy to help.</p>
        </div>
    </section>

    </main>
@endsection
