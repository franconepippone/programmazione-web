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
    {*
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
        .navbar-custom .nav-link,
        .navbar-custom .dropdown-menu a {
        color: #d1d5db;
        }
        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active,
        .navbar-custom .dropdown-menu a:hover {
        color: #ffffff;
        background-color: transparent;
        }
        footer {
        background-color: #1f2937;
        color: #9ca3af;
        font-size: 0.875rem;
        font-family: 'Inter', sans-serif;
        padding: 1.5rem 2rem;
        text-align: center;
        }
      </style>
    *}

    {block name="styles"}{/block}
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom px-4">
    <a class="navbar-brand fw-bold" href="#">MyWebsite</a>
    <div class="collapse navbar-collapse justify-content-end align-items-center">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item"><a class="nav-link" href="/user/home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/field/searchForm">Prenota un campo</a></li>
        <li class="nav-item"><a class="nav-link" href="/course/showCourses">Iscriviti a un corso</a></li>
        <li class="nav-item"><a class="nav-link" href="/dashboard/profile">Dashboard personale</a></li>

        <!-- Profile dropdown -->
        <li class="nav-item dropdown ms-3">
          <button
            class="btn btn-link nav-link dropdown-toggle p-0"
            id="profileDropdown"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            title="Account"
            style="color: #fff;"
          >
            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" aria-hidden="true">
              <circle cx="12" cy="7" r="4"/>
              <path d="M5.5 21a8.38 8.38 0 0113 0"/>
            </svg>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="/dashboard/profile">Profile</a></li>
            <li><a class="dropdown-item" href="/user/logout?{$loginQueryString}">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Page content -->
  <main class="flex-grow-1 pb-5 d-flex flex-column" style="background: #fff;">
    {block name="content"}{/block}
  </main>

  <!-- Footer -->
  {include file='layouts/footer.tpl'}

  <!-- Bootstrap JS Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  {block name="scripts"}{/block}
</body>
</html>
