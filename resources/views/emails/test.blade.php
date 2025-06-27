<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .debug-box {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            font-family: monospace;
        }
        .debug-item {
            margin-bottom: 8px;
        }
        h1 {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Test Email from TIU Charity</h1>
    
    <p>This is a test email to verify that the email configuration is working correctly.</p>
    
    <p>If you're seeing this, it means your email configuration is working!</p>
    
    <div class="debug-box">
        <h3>Debug Information:</h3>
        <div class="debug-item"><strong>Timestamp:</strong> {{ $timestamp }}</div>
        <div class="debug-item"><strong>Mail Driver:</strong> {{ $config['driver'] }}</div>
        <div class="debug-item"><strong>Mail Host:</strong> {{ $config['host'] }}</div>
        <div class="debug-item"><strong>Mail Port:</strong> {{ $config['port'] }}</div>
        <div class="debug-item"><strong>From Address:</strong> {{ $config['from_address'] }}</div>
        <div class="debug-item"><strong>From Name:</strong> {{ $config['from_name'] }}</div>
    </div>
    
    <p>Regards,<br>
    TIU Charity System</p>
</body>
</html> 