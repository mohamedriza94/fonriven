<!DOCTYPE html>
<html>
<head>
    <title>FONRIVEN</title>
</head>
<body>
    
    <h1 style="color:rgb(10, 182, 62)">FONRIVEN</h1>
    <hr><br>
    <h3>REPLY TO: {{ $messageSubject }}</h3>
<p>This mail is in response to your message about: {{ $messageSubject }}.</p><br>

<p><b>Reply:</b></p><hr>
<p>Date: {{ $messageDate }}</p><hr>
<p>{{ $reply }}</p>
</body>
</html> 