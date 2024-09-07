<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background: linear-gradient(45deg, #ff9a9e 0%, #fad0c4 100%);
      color: #fff;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    h2 {
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
      margin-top: 50px;
    }
    .container {
      background-color: rgba(255, 255, 255, 0.2);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }
  </style>
</head>
<body>

<div class="container mt-5 text-center">
  <h2>Welcome, <?=session()->get('username')?>!</h2>
</div>

</body>
</html>
