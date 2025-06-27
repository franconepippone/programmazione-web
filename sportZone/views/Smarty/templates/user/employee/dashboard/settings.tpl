{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="settings"}
{assign var="page_title" value="Dashboard - Settings"}

{block name="dashboard_tabs_styles"}
    <style>
        .profile-form {
            max-width: 600px;
            background: #ffffff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .profile-form .form-group {
            margin-bottom: 1.5rem;
        }

        .profile-form label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }

        .profile-form input,
        .profile-form select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            background-color: #f9fafb;
            color: #1f2937;
        }

        .profile-form small {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .btn-save {
            background-color: #3b82f6;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-save:hover {
            background-color: #2563eb;
        }
    </style>
{/block}

{block name="dashboard_content"}
    
    <h2>Settings</h2>
    <p>Change your password, update email preferences, and more.</p>

    <form action="/user/modifyUserRequest" method="post" class="profile-form">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="{$user.username|escape}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{$user.email|escape}" readonly style="background-color: #f3f4f6; color: #6b7280; cursor: not-allowed;">
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" id="password" name="password">
            <small>Leave blank to keep current password</small>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-save">Save Changes</button>
        </div>
    </form>
{/block}
