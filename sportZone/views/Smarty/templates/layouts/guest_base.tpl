<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>{$page_title|default:"My Website"}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    {block name="styles"}{/block}
    
</head>
<body class="d-flex flex-column min-vh-100">

    {if true}
    <!-- Topbar for guests -->
    <div class="bg-dark text-white d-flex justify-content-end py-2 px-4 small">
        <a href="/user/login?{$loginQueryString}" class="text-info text-decoration-none ms-3">Login</a>
        <a href="/user/register" class="text-info text-decoration-none ms-3">Register</a>
    </div>
    {/if}

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom px-4">
      <a class="navbar-brand fw-bold" href="#">MyWebsite</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="/user/home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/field/searchForm">Prenota un campo</a></li>
          <li class="nav-item"><a class="nav-link" href="/course/showCourses">Iscriviti a un corso</a></li>
        </ul>
      </div>
    </nav>

    <!-- Page content -->
    <main class="flex-grow-1 container my-4">
        {block name="content"}{/block}
    </main>

    <!-- Footer -->
    {include file='layouts/footer.tpl'}

    <!-- Bootstrap JS Bundle (Popper + Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {block name="scripts"}{/block}
</body>
</html>
