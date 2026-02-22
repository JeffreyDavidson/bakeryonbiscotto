{{-- Flour Burst Transition - saved for future placement --}}
<section class="flour-burst-section" id="flourBurst">
    <div class="burst-container" id="burstContainer"></div>
    <div class="burst-text">
        <h3>Every Loaf, a Little Different</h3>
        <p>That's the beauty of sourdough. Same love, same care, same starter — but each one is uniquely yours.</p>
    </div>
</section>

<style>
    .flour-burst-section {
        padding: 120px 20px;
        background: var(--dark);
        text-align: center;
        position: relative;
        overflow: hidden;
        min-height: 50vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .flour-burst-section::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse at 50% 50%, rgba(212,165,116,0.04), transparent 60%);
    }
    .burst-container {
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }
    .burst-particle {
        position: absolute;
        border-radius: 50%;
        background: var(--cream);
        opacity: 0;
    }
    .burst-active .burst-particle {
        animation: burst-fly 1.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes burst-fly {
        0% { transform: translate(0, 0) scale(1); opacity: 0.8; }
        100% { transform: translate(var(--bx), var(--by)) scale(0); opacity: 0; }
    }
    .burst-text {
        position: relative; z-index: 2;
    }
    .burst-text h3 {
        font-family: 'Dancing Script', cursive;
        font-size: clamp(2.5rem, 6vw, 4rem);
        font-weight: 700;
        color: var(--cream);
        margin-bottom: 16px;
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.3s;
    }
    .burst-active .burst-text h3 {
        opacity: 1;
        transform: scale(1);
    }
    .burst-text p {
        font-family: 'Cormorant Garamond', serif;
        font-style: italic;
        font-size: 18px;
        color: rgba(245,230,208,0.5);
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.7;
        opacity: 0;
        transition: opacity 0.8s 0.6s;
    }
    .burst-active .burst-text p {
        opacity: 1;
    }
</style>

<script>
    // Flour burst on scroll
    (function() {
        const burstSection = document.getElementById('flourBurst');
        const burstContainer = document.getElementById('burstContainer');
        let burstFired = false;

        for (let i = 0; i < 60; i++) {
            const p = document.createElement('div');
            p.className = 'burst-particle';
            const angle = (Math.random() * 360) * (Math.PI / 180);
            const distance = 200 + Math.random() * 400;
            const size = 3 + Math.random() * 8;
            p.style.width = size + 'px';
            p.style.height = size + 'px';
            p.style.setProperty('--bx', Math.cos(angle) * distance + 'px');
            p.style.setProperty('--by', Math.sin(angle) * distance + 'px');
            p.style.animationDelay = (Math.random() * 0.3) + 's';
            burstContainer.appendChild(p);
        }

        const burstObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !burstFired) {
                    burstFired = true;
                    burstSection.classList.add('burst-active');
                }
            });
        }, { threshold: 0.5 });

        burstObserver.observe(burstSection);
    })();
</script>
