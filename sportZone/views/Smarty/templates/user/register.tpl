<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 2rem;
      background-color: #f5f5f5;
    }

    .login-container {
      max-width: 300px;
      margin: auto;
      background: white;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .login-container label {
      display: block;
      margin-bottom: 0.5rem;
    }

    .login-container input[type="text"],
    .login-container input[type="password"],
    .login-container input[type="email"],
    .login-container input[type="date"],
    .login-container select {
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1rem;
    }

    .login-container button {
      width: 100%;
      padding: 0.5rem;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
    }

    .login-container button:hover {
      background-color: #0056b3;
    }

    .register-link {
      display: block;
      text-align: center;
      margin-top: 1rem;
      font-size: 0.9rem;
    }

    .register-link a {
      color: #007bff;
      text-decoration: none;
    }

    .register-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Register</h2>
    <form action="/user/attemptRegister" method="POST">

      <label for="name">First name:</label>
      <input type="text" id="name" name="name" required>

      <label for="surname">Last name:</label>
      <input type="text" id="surname" name="surname" required>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
<!--
      <label for="birth">Birth Date:</label>
      <input type="date" id="birth" name="birth" required>

      <label for="sex">Sex:</label>
      <select id="sex" name="sex" required>
        <option value="">-- Select --</option>
        <option value="male">MALE</option>
        <option value="female">FEMALE</option>
        <option value="other">OTHER</option>
      </select>
 -->
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Register Now</button>
    </form>
  </div>
</body>
</html>
