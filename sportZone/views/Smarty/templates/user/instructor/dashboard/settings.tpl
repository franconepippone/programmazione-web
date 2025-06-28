{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="settings"}
{assign var="page_title" value="Dashboard - Settings"}



{block name="dashboard_content"}

    <h2 class="mb-4">Settings</h2>
    <p class="text-muted">Change your password, update email preferences, and more.</p>

    <form action="/user/modifyUserRequest" method="post" class="profile-form">
        <div class="mb-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" value="{$user.username|escape}" required class="form-control">
        </div>
        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" value="{$user.email|escape}" required class="form-control">
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">New Password</label>
            <input type="password" id="password" name="password" class="form-control">
            <small class="text-muted">Leave blank to keep current password</small>
        </div>

        <div class="mb-4">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
{/block}
