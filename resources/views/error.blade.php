<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$msg}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .error-container {
            text-align: center;
        }
        .error-message {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .home-link {
            font-size: 18px;
            text-decoration: none;
            color: #2196f3;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-message">{{$msg}}</div>
        <a href="/" class="home-link">Go Back to Homepage</a>
    </div>
</body>
</html>