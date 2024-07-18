<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Email Sent!</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .icon {
            font-size: 72px;
            color: #90caf9;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            color: #757575;
            line-height: 1.5;
        }

        .image {
            width: 150px;
            height: 150px;
        }
    </style>
</head>

<body>
    <div class="container">
        <i class="material-icons icon"><img class="image" src="{{ asset('img/logo.png') }}" alt=""></i>
        <h1>Verification Email Sent!</h1>
        <p>We've sent a verification email to the address you provided. Please check your inbox and click the link to
            confirm your account.</p>
    </div>
</body>

</html>
