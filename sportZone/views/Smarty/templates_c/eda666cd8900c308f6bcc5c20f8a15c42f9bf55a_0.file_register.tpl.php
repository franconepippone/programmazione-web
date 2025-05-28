<?php
/* Smarty version 5.5.1, created on 2025-05-28 23:05:53
  from 'file:user/register.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68377ab1aad099_61470953',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eda666cd8900c308f6bcc5c20f8a15c42f9bf55a' => 
    array (
      0 => 'user/register.tpl',
      1 => 1748466351,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68377ab1aad099_61470953 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\user';
?><!DOCTYPE html>
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

      <label for="username">First name:</label>
      <input type="text" id="username" name="username" required>

      <label for="username">Last name:</label>
      <input type="text" id="username" name="username" required>

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
<?php }
}
