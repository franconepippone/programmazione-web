<div class="mb-3">
            <label for="profile_picture" class="form-label">Foto profilo</label>
            <div class="mb-3">
                {if $user.profilePicture}
                    <img src="{$user.profilePicture}" alt="Foto profilo" class="rounded" style="width: 200px; height: 200px; object-fit: cover;">
                {else}
                    <img src="https://static.vecteezy.com/system/resources/previews/036/594/092/large_2x/man-empty-avatar-photo-placeholder-for-social-networks-resumes-forums-and-dating-sites-male-and-female-no-photo-images-for-unfilled-user-profile-free-vector.jpg" alt="Foto profilo" class="rounded" style="width: 200px; height: 200px; object-fit: cover; background: #e5e7eb;">
                {/if}
            </div>
            <input class="form-control" type="file" id="profile_picture" name="profilePicture" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="first_name" class="form-label">Nome</label>
            <input type="text" id="first_name" name="name" value="{$user.name|escape}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Cognome</label>
            <input type="text" id="last_name" name="surname" value="{$user.surname|escape}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="birthday" class="form-label">Data di nascita</label>
            <input type="date" id="birthday" name="birthday" value="{$user.birthDate|escape}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Genere</label>
            <select id="gender" name="gender" class="form-select">
                <option value="male" {if $user.sex == 'male'}selected{/if}>Maschio</option>
                <option value="female" {if $user.sex == 'female'}selected{/if}>Femmina</option>
                <option value="other" {if $user.sex == 'other'}selected{/if}>Altro</option>
            </select>
        </div>