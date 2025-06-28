{extends file=$layout}
{assign var="active_tab" value="Modify User"}


{*assign var="modifiedUserClass" value="EInstructor"*}

{assign var="userClassMap" value=[
    'EClient' => 'Client',
    'EEmployee' => 'Employee',
    'EAdmin' => 'Admin',
    'EInstructor' => 'Instructor'
]}
{assign var="modifiedUserClassName" value=$userClassMap[$modifiedUserClass]|default:$modifiedUserClass}


{block name="styles"}
{/block}

{block name="content"}
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h4 class="mb-0">Modifica Profilo Utente</h4>
        </div>

        <div class="card-body">
          <!-- User Role (Read-only) -->
          <div class="mb-4">
            <label class="form-label">User Role</label>
            <div>
              <span class="badge bg-secondary text-uppercase px-3 py-2 fs-6">
                {$modifiedUserClassName|default:'UNSPECIFIED'}
              </span>
            </div>
          </div>

          <form action="/user/modifyUserRequest" method="post" class="profile-form" enctype="multipart/form-data">
            {if $modifiedUserClass == 'EClient'}
                {include file="user/modify_forms/profile/prfl_client.tpl"}
                {include file="user/modify_forms/settings/stgs_client.tpl"}

            {elseif $modifiedUserClass == 'EEmployee'}
                {include file="user/modify_forms/profile/prfl_employee.tpl"}
                {include file="user/modify_forms/settings/stgs_client.tpl"} {*this is so the email field is unlocked*}

            {elseif $modifiedUserClass == 'EAdmin'}
                {*THIS SHOULD NEVER HAPPEN*}
                {include file="user/modify_forms/profile/prfl_admin.tpl"}
                {include file="user/modify_forms/settings/stgs_admin.tpl"}

            {elseif $modifiedUserClass == 'EInstructor'}
                {include file="user/modify_forms/profile/prfl_instructor.tpl"}
                {include file="user/modify_forms/settings/stgs_instructor.tpl"}
            {else}
                Invalid user class: {$modifiedUserClass}
            {/if}

            <div class="d-flex justify-content-end gap-2 mt-4">
              <button type="submit" class="btn btn-primary">Modify</button>
              <a href="/user/delete" class="btn btn-danger">Delete</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



{/block}
