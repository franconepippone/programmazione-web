<nav class="navbar navbar-expand-lg bg-dark navbar-dark px-4">
  <a class="navbar-brand fw-bold" href="/user/home">{include file="layouts/logo.html"}</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarContent">
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link" href="/user/home">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="/field/searchForm">Prenota un campo</a></li>
      <li class="nav-item"><a class="nav-link" href="/course/showCourses">Iscriviti a un corso</a></li>
      {if $isLogged}
        <li class="nav-item"><a class="nav-link" href="/dashboard/profile">Dashboard personale</a></li>
      
        <!-- Profile dropdown -->
        {include file="layouts/components/profile_dropdown.tpl"}
      {/if}
    </ul>
  </div>
</nav>