      <li class="nav-item dropdown ms-3">
        <button
          class="btn btn-link nav-link dropdown-toggle p-0 d-flex align-items-center"
          id="profileDropdown"
          data-bs-toggle="dropdown"
          aria-expanded="false"
          aria-haspopup="true"
          title="Account"
          style="color: #fff;"
        >
          <svg
            width="28"
            height="28"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            viewBox="0 0 24 24"
            aria-hidden="true"
            focusable="false"
            class="me-1"
          >
            <circle cx="12" cy="7" r="4" />
            <path d="M5.5 21a8.38 8.38 0 0113 0" />
          </svg>
          <span class="visually-hidden">Account menu</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="profileDropdown">
          <li><a class="dropdown-item" href="/dashboard/profile">Profile</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="/user/logout?{$loginQueryString}">Logout</a></li>
        </ul>
      </li>