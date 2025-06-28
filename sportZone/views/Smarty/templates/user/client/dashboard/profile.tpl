{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="profile"}
{assign var="page_title" value="Dashboard - My Profile"}

{block name="dashboard_tabs_styles"}
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/slate/bootstrap.min.css" rel="stylesheet" />
{/block}

{block name="dashboard_content"}
    <h2>My Profile</h2>
    <p>Update your personal information below.</p>

    <form action="/user/modifyUserRequest" method="post" class="profile-form" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <div class="mb-3">
                {if $user.profilePicture}
                    <img src="{$user.profilePicture}" alt="Profile Picture" class="rounded" style="width: 200px; height: 200px; object-fit: cover;">
                {else}
                    <img src="https://static.vecteezy.com/system/resources/previews/036/594/092/large_2x/man-empty-avatar-photo-placeholder-for-social-networks-resumes-forums-and-dating-sites-male-and-female-no-photo-images-for-unfilled-user-profile-free-vector.jpg" alt="Profile Picture" class="rounded" style="width: 200px; height: 200px; object-fit: cover; background: #e5e7eb;">
                {/if}
            </div>
            <input class="form-control" type="file" id="profile_picture" name="profilePicture" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" id="first_name" name="name" value="{$user.name|escape}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" id="last_name" name="surname" value="{$user.surname|escape}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="birthday" class="form-label">Birthday</label>
            <input type="date" id="birthday" name="birthday" value="{$user.birthDate|escape}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select id="gender" name="gender" class="form-select">
                <option value="male" {if $user.sex == 'male'}selected{/if}>Male</option>
                <option value="female" {if $user.sex == 'female'}selected{/if}>Female</option>
                <option value="other" {if $user.sex == 'other'}selected{/if}>Other</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
{/block}
