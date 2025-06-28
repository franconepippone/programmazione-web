{extends file=$layout}
{assign var="page_title" value="Login"}

{block name="styles"}
{/block}

{block name="content"}
<style>
  .fade-in {
    opacity: 0;
    transform: translateY(10px);
    animation: fadeIn 0.6s ease-out 0.3s forwards;
  }

  @keyframes fadeIn {
    to {
      opacity: 1;
      transform: none;
    }
  }
</style>

<div class="container py-5 d-flex flex-column align-items-center justify-content-center fade-in" style="min-height: 60vh;">
    <div class="text-center mb-4">
        <h1 class="fw-bold mb-3">Scegli il metodo di pagamento</h1>
        <p class="text-muted fs-5">Puoi pagare direttamente in struttura oppure online in modo sicuro</p>
    </div>
    <div class="d-flex flex-column flex-md-row gap-4">
        <a href="/payment/payOnsite" class="btn btn-outline-primary d-flex align-items-center px-4 py-2 fs-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="24" height="24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M4 4h16v16H4z" />
                <path d="M4 9h16" />
            </svg>
            Paga in struttura
        </a>
        <a href="/payment/payOnline" class="btn btn-primary d-flex align-items-center px-4 py-2 fs-5">
            <svg xmlns="http://www.w3.org/2000/svg" class="me-2" width="24" height="24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z" />
                <line x1="2" y1="10" x2="22" y2="10" />
            </svg>
            Paga online
        </a>
    </div>
</div>
{/block}
