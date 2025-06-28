<body>
  <div class="page-wrapper d-flex flex-column min-vh-100">

    <!-- Main navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="#">MyWebsite</a>
        <!-- qui puoi aggiungere menu di navigazione se vuoi -->
      </div>
    </nav>

    <!-- Page content -->
    <main class="container flex-grow-1 py-4">
      {block name="content"}{/block}
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light text-center py-3 mt-auto">
      {include file='layouts/footer.tpl'}
    </footer>

  </div>
</body>
