@extends("main.head")
@section("root")
    <div style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; background-color: #f3f4f6;">
        <div style="background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1); max-width: 600px; width: 100%; margin: 0 auto;">
            <div style="padding: 16px; background-color: #f3f4f6;">
                <div style="display: flex; justify-content: center;">
                    <a href="/" style="display: flex; align-items: center; text-decoration: none;">
                        <img src="{{ asset('/ltolz.png') }}" alt="iTolz Logo" style="width: 50px;"/>
                        <span style="font-size: 24px; font-weight: 600; color: #1f2937; font-family: monospace;">{{ config('app.name') }}</span>
                    </a>
                </div>
                <div style="text-align: center; padding: 16px;">
                    <h3 style="font-size: 24px; font-weight: 700;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; text-align: center; margin-top: 10px;">Password Reset</h3>
                </div>
            </div>
            <div style="padding: 24px; text-align: center;">
                <p style="font-size: 18px; font-weight: 600;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">Hello, <span style="font-weight: 700;">{{ $notifiable->name }}</span>!</p>
                <p style="font-size: 16px; margin-top: 10px;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-weight: 500;">To complete your registration, please verify your email address by clicking the button below:</p>
                <a href="{{ route('password.reset', $token) }}" style="display: inline-block; background-color: #3F00E7; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; margin-top: 20px; font-family: sans-serif; font-weight: 600;">Verify Email</a>
                <p style="font-size: 16px; margin-top: 20px;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-weight: 500;">Thank you for choosing {{ config('app.name') }}</p>
                <hr style="margin: 20px;">
                <p style="font-size: 16px;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-weight: 400;">Regards,</p>
                <p style="font-size: 16px;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; font-weight: 400;">The {{ config('app.name') }} Team</p>
            </div>
            <div style="padding: 16px; background-color: #f3f4f6;">
                <p style="text-align: center; font-size: 14px;  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </div>



    <style>
        body,
        body *:not(html):not(style):not(br):not(tr):not(code) {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif,
            'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        }
    </style>

@endsection
