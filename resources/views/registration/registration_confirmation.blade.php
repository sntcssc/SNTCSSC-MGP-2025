<!DOCTYPE html>
<html>
<head>
    <title>Registration Confirmation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #004aad; color: white; padding: 10px; text-align: center; }
        .content { background: #f9f9f9; padding: 20px; }
        .footer { text-align: center; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>SNTCSSC Institute</h2>
        </div>
        <div class="content">
            <h3>Welcome, {{ $registration->first_name }} {{ $registration->last_name }}!</h3>
            <p>Thank you for registering for the <strong>{{ $registration->programme_enrolled }}</strong> (Batch: {{ $registration->batch }}).</p>
            <p>Your registration has been successfully submitted. Please find the attached PDF containing your application details.</p>
            <p>If you have any questions, feel free to contact us at info@sntcssc.com.</p>
            <p>Best regards,<br>SNTCSSC Team</p>
        </div>
        <div class="footer">
            <p>© 2025 SNTCSSC Institute. All rights reserved.</p>
        </div>
    </div>
</body>
</html>