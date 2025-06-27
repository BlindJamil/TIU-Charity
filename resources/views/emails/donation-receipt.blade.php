<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Donation Receipt</title>
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
        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }
        h1 {
            color: #444;
            margin-bottom: 20px;
        }
        .receipt {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .receipt-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #2a6d3c;
            margin: 15px 0;
        }
        .details {
            margin-bottom: 20px;
        }
        .instruction {
            background-color: #fff9e6;
            border: 1px solid #f5e7bd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
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
        <p>Your generous support helps us make a difference.</p>
    </div>

    <div class="receipt">
        <div class="receipt-header">
            <div>
                <strong>Receipt Number:</strong><br>
                {{ $donation->transaction_id ?? 'N/A' }}
            </div>
            <div>
                <strong>Date:</strong><br>
                {{ isset($donation->created_at) ? date('F j, Y', strtotime($donation->created_at)) : date('F j, Y') }}
            </div>
        </div>

        <div class="amount">${{ number_format($donation->amount ?? 0, 2) }}</div>

        <div class="details">
            <p><strong>Donation For:</strong> {{ $donation->cause_title ?? $cause->title ?? 'General Donation' }}</p>
            <p><strong>Donor Name:</strong> {{ $donation->name ?? 'Anonymous' }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($donation->payment_method ?? 'Cash') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($donation->status ?? 'Pending Payment') }}</p>
        </div>

        <div class="instruction">
            <h3 style="margin-top: 0;">Payment Instructions</h3>
            <p>Please follow these steps to complete your donation:</p>
            <ol>
                <li>Print or save this receipt</li>
                <li>Visit our office at <strong>Tishk International University Campus</strong></li>
                <li>Present this receipt number to our donation desk</li>
                <li>Make your cash payment</li>
                <li>Receive your stamped receipt as confirmation</li>
            </ol>
            <p><strong>Important:</strong> This receipt expires on {{ isset($donation->receipt_expires_at) ? date('F j, Y', strtotime($donation->receipt_expires_at)) : date('F j, Y', strtotime('+7 days')) }}. Please make your payment before this date.</p>
        </div>
    </div>

    <p>If you have any questions about your donation, please don't hesitate to contact us.</p>

    <div class="footer">
        <p>TIU Charity<br>
        Tishk International University Campus<br>
        Phone: +964 123 456 7890</p>
        <p>© {{ date('Y') }} TIU Charity. All rights reserved.</p>
    </div>
</body>
</html>