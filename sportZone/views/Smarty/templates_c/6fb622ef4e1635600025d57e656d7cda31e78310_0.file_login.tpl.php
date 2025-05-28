<?php
/* Smarty version 5.5.1, created on 2025-05-28 20:53:39
  from 'file:user/login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68375bb3c80145_77982022',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6fb622ef4e1635600025d57e656d7cda31e78310' => 
    array (
      0 => 'user/login.tpl',
      1 => 1748458330,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68375bb3c80145_77982022 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\user';
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
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
    .login-container input[type="password"] {
      width: 100%;
      padding: 0.5rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 4px;
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
    <h2><?php echo (($tmp = $_smarty_tpl->getValue('login_title') ?? null)===null||$tmp==='' ? "Login" ?? null : $tmp);?>
</h2>
    <form action="/user/checkLogin" method="POST">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Log In</button>
    </form>

    <div class="register-link">
      Don't have an account? <a href="/user/register">Register here</a>
    </div>
  </div>
</body>
</html>
<?php }
}
