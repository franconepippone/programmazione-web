{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="profile"}
{assign var="page_title" value="Dashboard - My Profile"}

{block name="dashboard_tabs_styles"}
    <style>
        .profile-form {
            text-align: left;
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
    
    <h2>My Profile</h2>
    <p>Update your personal information below.</p>

    <form action="/user/modifyUserRequest" method="post" class="profile-form">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="name" value="{$user.name|escape}" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="surname" value="{$user.surname|escape}" required>
        </div>
        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="date" id="birthday" name="birthday" value="{$user.birthDate|escape}" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select id="gender" name="gender">
                <option value="male" {if $user.sex == 'male'}selected{/if}>Male</option>
                <option value="female" {if $user.sex == 'female'}selected{/if}>Female</option>
                <option value="other" {if $user.sex == 'other'}selected{/if}>Other</option>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-save">Save Changes</button>
        </div>
    </form>


{/block}
