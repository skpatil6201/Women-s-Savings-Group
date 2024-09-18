<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 80%;
      margin: 0 auto;
      text-align: center;
      padding-top: 50px;
    }

    .login-form {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 20px;
      max-width: 400px;
      margin: 0 auto;
      background: #f9f9f9;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
    }

    .form-group button {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
    }

    .form-group button:hover {
      background-color: #45a049;
    }

    .form-group a {
      color: white;
      text-decoration: none;
    }

    .btn {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      cursor: pointer;
      border-radius: 5px;
    }

    .btn:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <?php include 'Header.php'; ?>
  <div class="container">
    <form  method="post" class="login-form">
      <h2>Login to Your Account</h2>
      <div class="form-group">
        <label for="ADMINE">ADMIN</label>
        <button type="submit" style="background-color: #4CAF50; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; cursor: pointer; border-radius: 5px;">
          <a href="AdminLogin.php" style="color: white; text-decoration: none;">Login</a>
        </button>
      </div>
      <div class="form-group">
        <label for="MEMBER">MEMBER</label>
        <button type="submit" style="background-color: #4CAF50; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; cursor: pointer; border-radius: 5px;">
          <a href="MemberLogin.php" style="color: white; text-decoration: none;">Login</a>
        </button>
      </div>
    </form>
  </div>
  <?php include 'Footer.php'; ?>
</body>

</html>
