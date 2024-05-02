<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Successful</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      text-align: center;
      padding: 40px;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: auto;
    }

    h2 {
      color: #dc2626;
    }

    p {
      color: #333;
    }

    img {
      width: 100px;
      height: auto;
      margin-top: 20px;
    }
    a {
      overflow-wrap: break-word;
    }
    footer {
      margin-top: 20px;
      color: #777;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Registration Successful!</h2>
    <p>Thank you for registering. Please click the link below to activate your account.</p>

    <a href="{{ route('register.validateemail', $token) }}">
      {{ route('register.validateemail', $token) }}
    </a>
    <footer>
        <p>&copy; 2024 CityChatter. All rights reserved.</p>
    </footer>
  </div>
</body>
</html>
