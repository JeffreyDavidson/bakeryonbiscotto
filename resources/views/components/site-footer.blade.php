    @php use App\Models\Setting; @endphp
    <footer class="footer" id="contact">
        <div class="footer-gradient"></div>
        <h3>{{ Setting::get('business_name', 'Bakery on Biscotto') }}</h3>
        <p class="tagline">With love and flour dust</p>
        <div class="footer-badge">📍 {{ Setting::get('store_city', 'Davenport') }}, {{ Setting::get('store_state', 'FL') }} &nbsp;·&nbsp; Local Pickup &amp; Delivery Available</div>
        <div class="footer-info">
            <a href="mailto:bakeryonbiscotto@gmail.com">bakeryonbiscotto@gmail.com</a><br>
            <a href="https://facebook.com/bakeryonbiscotto" target="_blank">Facebook</a> &nbsp;·&nbsp;
            <a href="https://instagram.com/bakeryonbiscotto" target="_blank">Instagram</a> &nbsp;·&nbsp;
            @bakeryonbiscotto
        </div>
        <div class="footer-allergen">* While certain items may not contain allergens, they are produced in an environment where allergens could be present. Please proceed with caution. {{ Setting::get('business_name', 'Bakery on Biscotto') }} is not responsible for any ill effects.</div>
        <div class="footer-allergen">Made in a cottage food operation that is not subject to {{ Setting::get('store_state_full', 'Florida') }}'s food safety regulations.</div>
        <div class="footer-bottom">&copy; {{ date('Y') }} {{ Setting::get('business_name', 'Bakery on Biscotto') }}. All rights reserved.</div>
    </footer>
