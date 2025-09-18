<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notification</title>
</head>
<body>
    <p>Hello {{ $notification->contact->name }},</p>
    <p>{{ $notification->body }}</p>
    <p>Thanks,<br>Admin</p>
</body>
</html>
