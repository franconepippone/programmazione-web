<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>{$page_title|default:"My Website"}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    
    <!-- Custom styles -->
    <link rel="stylesheet" href="/programmazione-web/sportZone/views/Smarty/templates/user/styles/dashboard.css" />
    
    {block name="styles"}{/block}
    
    <style>
      body {
        font-family: 'Inter', sans-serif;
        background-color: #f9fafb;
        color: #1f2937;
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
      }
      .navbar-custom {
        background-color: #1f2937;
      }
      .navbar-custom .navbar-brand,
      .navbar-custom .nav-link {
        color: #d1d5db;
      }
      .navbar-custom .nav-link:hover,
      .navbar-custom .nav-link.active {
        color: #ffffff;
      }
      footer {
        background-color: #1f2937;
        color: #9ca3af;
        font-size: 0.875rem;
        font-family: 'Inter', sans-serif;
        padding: 1.5rem 2rem;
      }
    </style>
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
