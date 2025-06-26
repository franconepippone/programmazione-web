{* footer.tpl *}
<style>
  footer {
    background-color: #1f2937;
    color: #9ca3af;
    padding: 1.5rem 2rem;
    font-size: 0.875rem;
    font-family: 'Inter', sans-serif;
  }
  footer .footer-container {
    max-width: 1200px;
    min-height: 50;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
  }
  footer .footer-left {
    flex: 1 1 200px;
  }
  footer .footer-nav {
    display: flex;
    gap: 1.5rem;
    flex: 2 1 400px;
    justify-content: center;
  }
  footer .footer-nav a {
    color: #93c5fd;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
  }
  footer .footer-nav a:hover,
  footer .footer-nav a:focus {
    color: #60a5fa;
    text-decoration: underline;
  }
  footer .footer-social {
    display: flex;
    gap: 1rem;
    flex: 1 1 150px;
    justify-content: flex-end;
  }
  footer .footer-social a {
    color: #93c5fd;
    font-size: 1.25rem;
    transition: color 0.3s ease;
  }
  footer .footer-social a:hover,
  footer .footer-social a:focus {
    color: #60a5fa;
  }
  footer svg {
    display: block;
  }
  @media (max-width: 600px) {
    footer .footer-container {
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    footer .footer-nav {
      justify-content: center;
      flex-wrap: wrap;
      gap: 1rem;
    }
    footer .footer-social {
      justify-content: center;
    }
  }
</style>

<footer>
  <div class="footer-container">
    <div class="footer-left">
      &copy; 2025 MyWebsite. All rights reserved.
    </div>
    <nav class="footer-nav" aria-label="Footer navigation">
      <a href="about.php">About Us</a>
      <a href="contact.php">Contact</a>
      <a href="privacy.php">Privacy Policy</a>
      <a href="terms.php">Terms of Service</a>
    </nav>
    <div class="footer-social" aria-label="Social media links">
      <a href="https://twitter.com" target="_blank" rel="noopener" aria-label="Twitter">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M23.954 4.569c-0.885 0.392-1.83 0.656-2.825 0.775 1.014-0.609 1.794-1.574 2.163-2.724-0.949 0.564-2.004 0.974-3.127 1.195-0.897-0.957-2.178-1.555-3.594-1.555-2.722 0-4.928 2.206-4.928 4.927 0 0.39 0.045 0.765 0.127 1.124-4.094-0.205-7.725-2.165-10.158-5.144-0.424 0.724-0.666 1.562-0.666 2.457 0 1.694 0.863 3.188 2.175 4.065-0.801-0.025-1.555-0.245-2.214-0.612v0.061c0 2.367 1.683 4.34 3.918 4.785-0.41 0.112-0.843 0.172-1.289 0.172-0.316 0-0.623-0.03-0.923-0.086 0.624 1.947 2.432 3.366 4.577 3.406-1.676 1.314-3.789 2.098-6.086 2.098-0.395 0-0.785-0.023-1.17-0.068 2.171 1.392 4.75 2.205 7.524 2.205 9.024 0 13.962-7.476 13.962-13.964 0-0.213-0.004-0.426-0.014-0.637 0.961-0.694 1.797-1.562 2.457-2.549z"/></svg>
      </a>
      <a href="https://facebook.com" target="_blank" rel="noopener" aria-label="Facebook">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22.675 0h-21.35c-0.733 0-1.325 0.592-1.325 1.325v21.351c0 0.733 0.592 1.324 1.325 1.324h11.49v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.466 0.099 2.797 0.143v3.243h-1.918c-1.504 0-1.794 0.715-1.794 1.763v2.313h3.587l-0.467 3.622h-3.12v9.294h6.116c0.732 0 1.324-0.591 1.324-1.324v-21.352c0-0.733-0.592-1.324-1.325-1.324z"/></svg>
      </a>
      <a href="https://linkedin.com" target="_blank" rel="noopener" aria-label="LinkedIn">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.327-0.025-3.037-1.85-3.037-1.85 0-2.134 1.445-2.134 2.939v5.667h-3.554v-11.452h3.413v1.563h0.049c0.476-0.9 1.637-1.85 3.37-1.85 3.603 0 4.27 2.371 4.27 5.455v6.284zM5.337 8.433c-1.144 0-2.071-0.927-2.071-2.07 0-1.143 0.927-2.07 2.071-2.07s2.07 0.927 2.07 2.07c0 1.143-0.926 2.07-2.07 2.07zm1.777 12.019h-3.554v-11.452h3.554v11.452zM22.225 0h-20.451c-0.979 0-1.774 0.795-1.774 1.774v20.451c0 0.979 0.795 1.775 1.774 1.775h20.451c0.978 0 1.774-0.796 1.774-1.775v-20.451c0-0.979-0.796-1.774-1.774-1.774z"/></svg>
      </a>
    </div>
  </div>
</footer>
