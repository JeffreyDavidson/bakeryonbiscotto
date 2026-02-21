<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Georgia, serif; background: #FDF8F2; margin: 0; padding: 0; }
        .container { max-width: 560px; margin: 0 auto; padding: 40px 24px; }
        .header { text-align: center; margin-bottom: 32px; }
        .header h1 { color: #3D2314; font-size: 22px; margin: 0; }
        .header p { color: #8B5E3C; font-size: 14px; margin-top: 4px; }
        .card { background: #FFFFFF; border: 1px solid rgba(212,165,116,0.25); border-radius: 12px; padding: 28px; margin-bottom: 24px; }
        .stars { font-size: 24px; color: #D4A574; margin-bottom: 12px; }
        .review-body { font-size: 16px; line-height: 1.6; color: #3D2314; margin-bottom: 16px; font-style: italic; }
        .meta { font-size: 14px; color: #8B5E3C; }
        .meta strong { color: #3D2314; }
        .divider { border: none; border-top: 1px solid rgba(212,165,116,0.2); margin: 16px 0; }
        .cta { text-align: center; margin-top: 24px; }
        .cta a {
            display: inline-block; background: #8B5E3C; color: #FFFFFF; text-decoration: none;
            padding: 12px 28px; border-radius: 8px; font-size: 14px; font-weight: bold;
        }
        .footer { text-align: center; font-size: 12px; color: #A08060; margin-top: 32px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Review Submitted!</h1>
            <p>Someone left a review on Bakery on Biscotto</p>
        </div>

        <div class="card">
            <div class="stars">{!! str_repeat('★', $review->rating) !!}{!! str_repeat('☆', 5 - $review->rating) !!}</div>
            <div class="review-body">"{{ $review->body }}"</div>
            <hr class="divider">
            <div class="meta">
                <strong>{{ $review->name }}</strong>
                @if($review->favorite_bread)
                    <br>Favorite bread: {{ $review->favorite_bread }}
                @endif
                @if($review->email)
                    <br>Email: {{ $review->email }}
                @endif
            </div>
        </div>

        <div class="cta">
            <a href="{{ url('/admin/reviews') }}">Review &amp; Approve</a>
        </div>

        <div class="footer">
            This review is pending your approval before it appears on the website.
        </div>
    </div>
</body>
</html>
