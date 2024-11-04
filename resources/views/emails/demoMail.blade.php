<!DOCTYPE html>
<html>
<head>
    <title>{{ $mailData['title'] }}</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>
    <p><strong>Name:</strong> {{ $mailData['full_name'] }}</p>
    <p><strong>Phone:</strong> {{ $mailData['phone'] }}</p>
    <p><strong>Email:</strong> {{ $mailData['email'] }}</p>
</body>
</html>
