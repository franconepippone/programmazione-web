{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="profile"}
{assign var="page_title" value="Dashboard - My Profile"}

{block name="dashboard_tabs_styles"}
    <style>
        .profile-form img {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 16px;
            background: #e5e7eb;
        }
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
        .hidden-file {
            display: none;
        }

        .btn-upload {
            display: inline-block;        /* FIX: Prevent full-width */
            background-color: #3b82f6;
            color: #ffffff !important;    /* FIX: Force white text */
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out;
            width: auto;                  /* FIX: Just to be sure */
        }

        .btn-upload:hover {
            background-color: #2563eb;
        }

        .profile-form textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: .9rem;
            background-color: #f9fafb;
            color: #1f2937;
            resize: none;           /* Prevent resizing */
            min-height: 5rem;       /* Make it a bit bigger */
            height: 5rem;
            line-height: 1.5;
        }
    </style>
{/block}

{block name="dashboard_content"}
    
    {literal}
    <h2>My Profile (Instructor)</h2>
    {/literal}
    <p>Update your personal information below.</p>

    <form action="/user/modifyUserRequest" method="post" class="profile-form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <div style="margin-top: 1rem;">
                {if $user.profilePicture}
                    <img src="{$user.profilePicture}" alt="Profile Picture" style="width: 200px; height: 200px; object-fit: cover; border-radius: 16px;">
                {else}
                    <img src="https://static.vecteezy.com/system/resources/previews/036/594/092/large_2x/man-empty-avatar-photo-placeholder-for-social-networks-resumes-forums-and-dating-sites-male-and-female-no-photo-images-for-unfilled-user-profile-free-vector.jpg" alt="Profile Picture" style="width: 200px; height: 200px; object-fit: cover; border-radius: 16px; background: #e5e7eb;">
                {/if}
            </div>
                <input type="file" id="profile_picture" name="profilePicture" accept="image/*">

        </div>
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
            <label for="cvv">CVV</label>
                <textarea id="cvv" name="cvv" rows="3" style="width:100%;" placeholder="Enter your CVV or additional info here">{$user.cvv|default:''|escape}</textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-save">Save Changes</button>
        </div>

        
    </form>


{/block}
