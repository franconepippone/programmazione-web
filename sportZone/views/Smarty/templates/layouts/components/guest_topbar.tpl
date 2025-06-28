<style>
  .fade-in {
    opacity: {if $currentPage == "/user/home"} 0 {else} 1 {/if};
    animation: fadeInAnim 1s ease forwards;
  }

  @keyframes fadeInAnim {
    to {
      opacity: 1;
    }
  }
</style>

{if !$isLogged}
<div style="background-color: #2563eb;" class="text-white d-flex justify-content-end py-1 px-4 small fade-in">
  <a href="/user/login?{$loginQueryString}" class="text-white text-decoration-none ms-3">Login</a>
  <a href="/user/register" class="text-white text-decoration-none ms-3">Register</a>
</div>
{/if}
