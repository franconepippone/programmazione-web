{extends file=$layout}  
{assign var="page_title" value="Register new"}



{block name="content"}
    <div class="container py-4">
        <h2 class="mb-4 text-center">Modulo di iscrizione</h2>
        <p class="text-center mb-4">
            Corso: <strong>{$title|escape}</strong>
        </p>
        <form method="post" action="/course/submitEnrollment" class="mx-auto" style="max-width: 500px;">
            <input type="hidden" name="id" value="{$course.id}">

            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" id="name" name="name" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="surname" class="form-label">Cognome:</label>
                <input type="text" id="surname" name="surname" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="birthDate" class="form-label">Data di nascita:</label>
                <input type="date" id="birthDate" name="birthDate" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="sex" class="form-label">Sesso:</label>
                <select id="sex" name="sex" required class="form-select">
                    <option value="">Seleziona</option>
                    <option value="MALE">Maschio</option>
                    <option value="FEMALE">Femmina</option>
                    <option value="OTHER">Altro</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>

            <a href="/enrollment/enrollmentConfirmation/{$course.id}" class="btn btn-primary w-100 text-center">Iscriviti</a>

        </form>
    </div>
</body>
{/block}