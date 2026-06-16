<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { background: #4f46e5; color: #fff; padding: 20px 24px; }
        .header h2 { margin: 0; font-size: 18px; }
        .body { padding: 24px; }
        .field { margin-bottom: 16px; }
        .field-label { font-weight: bold; color: #374151; font-size: 13px; text-transform: uppercase; margin-bottom: 4px; }
        .field-value { color: #1f2937; font-size: 15px; line-height: 1.6; }
        .message-box { background: #f9fafb; border-left: 4px solid #4f46e5; padding: 16px; border-radius: 4px; }
        .footer { padding: 16px 24px; background: #f9fafb; text-align: center; font-size: 12px; color: #9ca3af; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Message from Portfolio</h2>
        </div>
        <div class="body">
            <div class="field">
                <div class="field-label">From</div>
                <div class="field-value">{{ $senderName }}</div>
            </div>
            <div class="field">
                <div class="field-label">Email</div>
                <div class="field-value"><a href="mailto:{{ $senderEmail }}">{{ $senderEmail }}</a></div>
            </div>
            <div class="field">
                <div class="field-label">Message</div>
                <div class="message-box">{!! nl2br(e($message)) !!}</div>
            </div>
        </div>
        <div class="footer">
            Sent from your Portfolio Contact Form
        </div>
    </div>
</body>
</html>
