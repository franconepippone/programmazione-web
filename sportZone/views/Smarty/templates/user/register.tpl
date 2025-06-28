{extends file=$layout}
{assign var="page_title" value="Register"}

{block name="styles"}
{/block}

{block name="content"}
  <div class="container mt-5 d-flex justify-content-center">
    <div class="card p-4 shadow" style="max-width: 350px; width: 100%;">
      <h2 class="text-center mb-4">Register</h2>
      <form action="/user/finalizeRegister" method="POST" novalidate>
        <div class="mb-3">
          <label for="name" class="form-label">First name:</label>
          <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="surname" class="form-label">Last name:</label>
          <input type="text" id="surname" name="surname" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="birthday" class="form-label">Birthday:</label>
          <input type="date" id="birthday" name="birthday" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">Username:</label>
          <input type="text" id="username" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <!--
        <div class="mb-3">
          <label for="sex" class="form-label">Sex:</label>
          <select id="sex" name="sex" class="form-select" required>
            <option value="">-- Select --</option>
            <option value="male">MALE</option>
            <option value="female">FEMALE</option>
            <option value="other">OTHER</option>
          </select>
        </div>
        -->

        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="password" id="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register Now</button>
      </form>
    </div>
  </div>
{/block}
