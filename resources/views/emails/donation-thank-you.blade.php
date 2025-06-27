<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You for Your Donation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        h1 {
            color: #444;
            margin-bottom: 20px;
        }
        .content {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #2a6d3c;
            margin: 15px 0;
            text-align: center;
        }
        .impact {
            background-color: #e8f4f8;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            font-size: 12px;
            text-align: center;
            color: #777;
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .button {
            display: inline-block;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Thank You for Your Donation!</h1>
        <p>Your generosity is making a real difference</p>
    </div>

    <div class="content">
        <p>Dear {{ $donation->name }},</p>
        
        <p>On behalf of everyone at TIU Charity, we want to express our sincere gratitude for your generous donation to {{ $cause->title }}.</p>
        
        <div class="amount">${{ number_format($donation->amount, 2) }}</div>
        
        <div class="impact">
            <h3>Your Impact</h3>
            <p>Your contribution helps us continue our mission and makes a direct impact on the lives of those we serve. Every donation, no matter the size, brings us one step closer to our goals.</p>
        </div>
        
        <p>We are committed to using your donation effectively and responsibly. If you'd like to learn more about our work and how your donation is helping, please visit our website or follow us on social media for regular updates.</p>
        
        <p>Thank you again for your support and for being part of our community. Together, we are making the world a better place.</p>
        
        <p>With gratitude,<br>
        The TIU Charity Team</p>
    </div>

    <div class="footer">
        <p>TIU Charity<br>
        Tishk International University Campus<br>
        Phone: +964 123 456 7890</p>
        <p>© {{ date('Y') }} TIU Charity. All rights reserved.</p>
    </div>
</body>
</html> 