{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="settings"}
{assign var="page_title" value="Dashboard - Settings"}

{block name="dashboard_tabs_styles"}
        <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet">

    
    {/block}

{block name="dashboard_content"}
    <div class="container py-4">
        <div class="card shadow-sm mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h2 class="card-title">Settings</h2>
                <p class="mb-4">Change your password, update email preferences, and more.</p>

                <form action="/user/modifyUserRequest" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            class="form-control" 
                            value="{$user.username|escape}" 
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-control" 
                            value="{$user.email|escape}" 
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-control">
                        <div class="form-text">Leave blank to keep current password</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{/block}
