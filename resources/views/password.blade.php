<!DOCTYPE html>
<html>
<head>
  

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Password GHA 23</title>
  <meta name="keywords" content="">
  
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
  <link rel="icon" type="image/png" href="{{asset('icons/favicon-32x32.png')}}">


  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      max-width: 400px;
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 30px;
      text-align: center;
    }

    h1 {
      color: #333333;
    }

    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #cccccc;
    }

    .btn-enter {
      display: inline-block;
      background-color: #4caf50;
      color: #ffffff;
      padding: 10px 20px;
      font-size: 16px;
      text-align: center;
      text-decoration: none;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-enter:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Enter the Password</h1>
    <form action="{{url('password')}}" method="post">
      @csrf
      <input type="password" name="password" placeholder="Enter password" required>
      <br>
      <button class="btn-enter" type="submit">Enter</button>
    </form>
  </div>
</body>
</html>