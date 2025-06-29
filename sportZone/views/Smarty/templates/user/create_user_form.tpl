{extends file=$layout}
{assign var="page_title" value="Dashboard - Crea Utente"}

{block name="content"}
    <div class="container py-5 d-flex justify-content-center">
        <div class="card shadow-sm w-100" style="max-width: 720px;">
            <div class="card-body">
                <h2 class="card-title mb-4 text-center">Crea un nuovo utente</h2>

                <form method="post" action="/user/finalizeUserCreation" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" name="name" id="name" value="{$name|default:''}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="surname" class="form-label">Cognome</label>
                        <input type="text" name="surname" id="surname" value="{$surname|default:''}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" value="{$username|default:''}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label for="role" class="form-label">Ruolo</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="">Seleziona ruolo...</option>
                            <option value="client" {if $role == 'client'}selected{/if}>Cliente</option>
                            <option value="employee" {if $role == 'employee'}selected{/if}>Dipendente</option>
                            <option value="instructor" {if $role == 'instructor'}selected{/if}>Istruttore</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold">Crea Utente</button>
                    <a href="/user/home" class="btn btn-secondary w-100 fw-semibold mt-2">Torna alla homepage</a>
                </form>
            </div>
        </div>
    </div>
{/block}