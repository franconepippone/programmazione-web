{extends file=$layout}

{block name="styles"}
{/block}

{block name="content"}
<form action="/user/modifyUserRequest" method="post" class="profile-form" enctype="multipart/form-data">
    {include=$}

    <button type="submit" class="btn btn-primary">Salva modifiche</button>
</form>
{/block}
