@props(['url'])
<tr>
<td class="header" style="padding: 0;" align="center">
<table width="570" cellpadding="0" cellspacing="0" role="presentation" style="margin: 0 auto;">
<tr>
<td style="padding: 0;">
<a href="{{ $url }}" style="display: block;">
<img src="{{ asset('images/hero-banner.jpg') }}" alt="{{ \App\Models\Setting::get('business_name', 'Bakery on Biscotto') }}" style="width: 100%; max-width: 570px; height: auto; display: block; border-radius: 8px 8px 0 0;">
</a>
</td>
</tr>
</table>
</td>
</tr>
