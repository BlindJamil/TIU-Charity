<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Donation Update - TIU Charity</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; color: #222; }
        .header { background: #e53e3e; color: #fff; padding: 20px; text-align: center; }
        .content { background: #fff; padding: 30px; border-radius: 8px; margin: 30px auto; max-width: 600px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .footer { text-align: center; color: #888; font-size: 13px; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Update on Your Donation</h1>
        <p>We appreciate your support</p>
    </div>
    <div class="content">
        <p>Dear {{ $donation->name }},</p>
        <p>Thank you for your willingness to support <strong>{{ $cause->title }}</strong> through your donation of <strong>${{ number_format($donation->amount, 2) }}</strong>.</p>
        <p>Unfortunately, we were unable to process your donation at this time and your contribution has been cancelled. We sincerely apologize for any inconvenience this may have caused.</p>
        <p>If you have any questions or would like to try donating again, please feel free to contact us. Your support means a lot to us and to those we serve.</p>
        <p>Thank you for your understanding and for being part of our community.</p>
        <p>With appreciation,<br>The TIU Charity Team</p>
    </div>
    <div class="footer">
        <p>TIU Charity<br>Tishk International University Campus<br>Phone: +964 123 456 7890</p>
        <p>© {{ date('Y') }} TIU Charity. All rights reserved.</p>
    </div>
</body>
</html> 