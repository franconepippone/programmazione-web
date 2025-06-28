{extends file=$layout}
{assign var="page_title" value="Login"}

{block name="styles"}{/block}

{block name="content"}
  <div class="container mt-5 d-flex justify-content-center">
    <div class="card p-4 shadow" style="max-width: 320px; width: 100%;">
      <h2 class="card-title text-center mb-4">{$login_title|default:"Login"}</h2>
      <form action="/user/checkLogin" method="POST">
        <input type="hidden" name="redirectUrl" id="redirectUrl" value={$redirectUrl}>

        <div class="mb-3">
          <label for="username" class="form-label">Username:</label>
          <input type="text" id="username" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Log In</button>
      </form>

      <div class="mt-3 text-center small">
        Don't have an account? <a href="/user/register" class="link-primary">Register here</a>
      </div>
    </div>
  </div>
{/block}
