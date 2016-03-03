<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign Up Confirmation</title>
</head>
<body>
    <h1>Thanks for signing up!</h1>

    <p>Please confirm your email by clicking <a href='{{ url("auth/register/confirm/{$user->token}") }}'>here</a></p>
</body>
</html>