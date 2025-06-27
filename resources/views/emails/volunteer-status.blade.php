<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Volunteer Application Status Update</title>
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
        .status {
            font-size: 18px;
            font-weight: bold;
            margin: 15px 0;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
        .approved {
            background-color: #d4edda;
            color: #155724;
        }
        .rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        .pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .project-details {
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
        <h1>Volunteer Application Status</h1>
    </div>

    <div class="content">
        <p>Dear {{ $volunteer->user->name }},</p>
        
        <p>Thank you for your interest in volunteering with TIU Charity. We're writing to inform you about your application for the project "{{ $project->title }}".</p>
        
        <div class="status {{ $status }}">
            @if($status == 'approved')
                Your application has been APPROVED!
            @elseif($status == 'rejected')
                Your application has not been approved at this time.
            @else
                Your application is currently under review.
            @endif
        </div>
        
        <div class="project-details">
            <h3>Project Details:</h3>
            <p><strong>Title:</strong> {{ $project->title }}</p>
            <p><strong>Location:</strong> {{ $project->location }}</p>
            <p><strong>Dates:</strong> {{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}</p>
        </div>
        
        @if($status == 'approved')
            <p>We're excited to have you join our team of volunteers! You'll receive additional information about your role and responsibilities shortly. Please make sure to mark these dates on your calendar.</p>
            <p>If you have any questions or need to make changes to your availability, please contact us as soon as possible.</p>
        @elseif($status == 'rejected')
            <p>Unfortunately, we were unable to place you with this project at this time. This could be due to various reasons including the number of volunteers needed, specific skills required, or scheduling conflicts.</p>
            <p>We encourage you to apply for other volunteer opportunities with us in the future. Your interest in helping our cause is greatly appreciated.</p>
        @else
            <p>Your application is currently being reviewed by our team. We will notify you of any updates regarding your application status.</p>
        @endif
    </div>

    <p>If you have any questions, please don't hesitate to contact us.</p>
    
    <p>Thank you for your support and interest in making a difference with TIU Charity.</p>

    <div class="footer">
        <p>TIU Charity<br>
        Tishk International University Campus<br>
        Phone: +964 123 456 7890</p>
        <p>© {{ date('Y') }} TIU Charity. All rights reserved.</p>
    </div>
</body>
</html> 