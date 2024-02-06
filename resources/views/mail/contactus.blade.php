<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset Successful</title>
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
      display: inline-block;
      background-color: #dc2626;
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 8px;
      margin-top: 20px;
    }
    footer {
      margin-top: 20px;
      color: #777;
    }

    .text-left {
        text-align: left;
    }
  </style>
</head>
<body>
  <div class="container ">
    <h2>Enquiry has been arrived!</h2>
    <div class="text-left">
        <p>Name: {{ $data['name'] }}</p>
        <p>Email: {{ $data['email'] }}</p>
        <p>Message: {{ $data['message'] }}</p>
    </div>
    <footer>
      <p>&copy; 2024 CityChatter. All rights reserved.</p>
    </footer>
  </div>
</body>
</html>
