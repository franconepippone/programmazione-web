{extends file="../dashboard_bar.tpl"}
{assign var="active_tab" value="profile"}
{assign var="page_title" value="Dashboard - My Profile"}

{block name="dashboard_tabs_styles"}
   
{/block}

{block name="dashboard_content"}
<div class="container my-4" style="max-width: 600px;">
    <h2 class="mb-3">My Profile (Employee)</h2>
    <p>Update your personal information below.</p>

    <form action="/user/modifyUserRequest" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="mb-4">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <div class="mb-3">
                {if $user.profilePicture}
                    <img src="{$user.profilePicture}" alt="Profile Picture" class="img-thumbnail rounded" style="width: 200px; height: 200px; object-fit: cover;">
                {else}
                    <img src="https://static.vecteezy.com/system/resources/previews/036/594/092/large_2x/man-empty-avatar-photo-placeholder-for-social-networks-resumes-forums-and-dating-sites-male-and-female-no-photo-images-for-unfilled-user-profile-free-vector.jpg" alt="Profile Picture" class="img-thumbnail rounded" style="width: 200px; height: 200px; object-fit: cover; background: #e5e7eb;">
                {/if}
            </div>
            <input class="form-control" type="file" id="profile_picture" name="profilePicture" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="name" value="{$user.name|escape}" required>
            <div class="invalid-feedback">Please enter your first name.</div>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="surname" value="{$user.surname|escape}" required>
            <div class="invalid-feedback">Please enter your last name.</div>
        </div>

        <div class="mb-3">
            <label for="birthday" class="form-label">Birthday</label>
            <input type="date" class="form-control" id="birthday" name="birthday" value="{$user.birthDate|escape}" required>
            <div class="invalid-feedback">Please select your birthday.</div>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender">
                <option value="male" {if $user.sex == 'male'}selected{/if}>Male</option>
                <option value="female" {if $user.sex == 'female'}selected{/if}>Female</option>
                <option value="other" {if $user.sex == 'other'}selected{/if}>Other</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cvv" class="form-label">CVV</label>
            <textarea class="form-control" id="cvv" name="cvv" rows="3" placeholder="Enter your CVV or additional info here">{$user.cvv|default:''|escape}</textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
    </form>
</div>

<script>
// Example Bootstrap validation script
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})();
</script>
{/block}
