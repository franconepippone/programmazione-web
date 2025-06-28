<div class="mb-4">
    <label for="username" class="form-label">Nome utente</label>
    <input type="text" id="username" name="username" value="{$user.username|escape}" required class="form-control">
</div>
<div class="mb-4">
    <label for="email" class="form-label">Email</label>
    <input type="email" id="email" name="email" value="{$user.email|escape}" required class="form-control">
</div>
<div class="mb-4">
    <label for="password" class="form-label">Nuova password</label>
    <input type="password" id="password" name="password" class="form-control">
    <small class="text-muted">Lascia vuoto per mantenere la password attuale</small>
</div>