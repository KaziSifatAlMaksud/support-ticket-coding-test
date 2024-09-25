<!DOCTYPE html>
<html>
<head>
    <title>Ticket Stopped Notification</title>
</head>
<body>
    <h1>Ticket Stopped: {{ $ticketTitle }}</h1>
    <p>The following ticket has been stopped by the admin:</p>
    <p><strong>Issue Title:</strong> {{ $ticketTitle }}</p>
    <p><strong>Issue Details:</strong> {{ $issueDetails }}</p>
    <p><strong>Status:</strong> {{ $status }}</p>
</body>
</html>
