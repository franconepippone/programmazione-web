<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>{$page_title|default:"SportZone"}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="https://img.icons8.com/doodle-line/60/FFFFFF/football2--v1.png">
    
    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    {block name="styles"}{/block}
      
</head>
  <body class="d-flex flex-column min-vh-100" onload="document.documentElement.classList.add('fade-ready')">

  <!-- Orange Topbar -->
  {include file="layouts/components/guest_topbar.tpl"}

  <!-- Dark Navbar -->
  {include file="layouts/components/navbar_top.tpl"}

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
