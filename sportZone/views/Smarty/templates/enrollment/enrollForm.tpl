<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modulo di iscrizione</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/css/formElements.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow mt-5">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-3">Modulo di iscrizione</h2>
                        <p class="text-center mb-4">Corso: <strong>{$title|escape}</strong></p>
                        <form method="post" action="/course/submitEnrollment" id="enroll-form">
                            <input type="hidden" name="id" value="{$id}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="surname" class="form-label">Cognome:</label>
                                <input type="text" id="surname" name="surname" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="birthDate" class="form-label">Data di nascita:</label>
                                <input type="date" id="birthDate" name="birthDate" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="sex" class="form-label">Sesso:</label>
                                <select id="sex" name="sex" class="form-select" required>
                                    <option value="">Seleziona</option>
                                    <option value="MALE">Maschio</option>
                                    <option value="FEMALE">Femmina</option>
                                    <option value="OTHER">Altro</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Iscriviti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>