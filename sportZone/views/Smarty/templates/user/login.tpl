{extends file="sportZone/views/Smarty/templates/layouts/bare_base.tpl"}
{assign var="page_title" value="Login"}

{block name="styles"}
   <style>

    .login-container {
      max-width: 300px;
      margin: auto;
      margin-top: 20px;
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
{/block}

{block name="content"}
    <div class="login-container">
    <h2>{$login_title|default:"Login"}</h2>
    <form action="/user/checkLogin" method="POST">
      <input type="hidden" name="redirectUrl" id="redirectUrl" value={$redirectUrl}>

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
{/block}