<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact Submission</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>New Contact Submission</h2>
    <p>A new contact form submission has been received:</p>
    <ul>
        <li><strong>Name:</strong> {{ $contact->name }}</li>
        <li><strong>Email:</strong> {{ $contact->email }}</li>
        <li><strong>Message:</strong> {{ $contact->message }}</li>
        <li><strong>Submitted At:</strong> {{ $contact->created_at }}</li>
    </ul>
    <p>Please review the submission in the admin panel.</p>
</body>
</html>