<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{$page_title|default:"My Website"}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f9fafb;
            color: #1f2937;
        }

        .topbar {
            background-color: #111827;
            color: #ffffff;
            display: flex;
            justify-content: flex-end;
            padding: 0.5rem 2rem;
            font-size: 0.9rem;
        }

        .topbar a {
            color: #93c5fd;
            margin-left: 1.5rem;
            text-decoration: none;
        }

        .navbar {
            background-color: #1f2937;
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar nav a {
            color: #d1d5db;
            text-decoration: none;
            margin-left: 2rem;
            font-weight: 500;
        }

        .navbar nav a:hover {
            color: #ffffff;
        }

        main {
            padding: 0;
            min-height: 60vh;
        }

        footer {
            background-color: #1f2937;
            color: #9ca3af;
            text-align: center;
            padding: 1.5rem 2rem;
            font-size: 0.875rem;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }
        html, body {
            height: 100%;
            margin: 0;
        }

        .page-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-area {
            flex: 1;
        }

        .profile-dropdown {
        position: relative;
        display: inline-block;
        margin-left: 2rem;
        }
        .profile-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.2rem;
            border-radius: 50%;
            transition: background 0.15s;
        }
        .profile-btn:hover {
            background: #374151;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #fff;
            min-width: 140px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            border-radius: 0.5rem;
            z-index: 10;
            margin-top: 0.5rem;
        }
        .profile-dropdown:hover .dropdown-content,
        .profile-dropdown:focus-within .dropdown-content {
            display: block;
        }
        .dropdown-content a {
            color: #1f2937;
            padding: 0.7rem 1rem;
            text-decoration: none;
            display: block;
            border-radius: 0.5rem;
            transition: background 0.15s;
        }
        .dropdown-content a:hover {
            background: #f3f4f6;
        }
        .navbar {
            background-color: #1f2937;
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }
        .navbar-right {
            display: flex;
            align-items: center;
            margin-left: auto;
        }
        .navbar nav {
            display: flex;
            align-items: center;
        }
        .navbar nav a {
            color: #d1d5db;
            text-decoration: none;
            margin-left: 2rem;
            font-weight: 500;
        }
        .navbar nav a:first-child {
            margin-left: 0;
        }

    </style>
    {block name="styles"}{/block}
</head>
<body>
    <div class="page-wrapper">
        <!-- Main navbar -->
        <div class="navbar">
            <div class="logo">
                MyWebsite
            </div>
            <div class="navbar-right">
                <nav>
                    <a href="/user/home">Home</a>
                    <a href="/user/settings">Dashboard</a>
                    <a href="/field/searchForm">Prenota un campo</a>
                    <a href="index.php">Iscriviti a un corso</a>
                    <a href="about.php">About Us</a>
                    <a href="contact.php">Contact</a>
                </nav>
                <div class="profile-dropdown">
                    <button class="profile-btn" title="Account">
                        <svg width="28" height="28" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a8.38 8.38 0 0113 0"/></svg>
                    </button>
                    <div class="dropdown-content">
                        <a href="/user/profile">Profile</a>
                        <a href="/user/logout?{$loginQueryString}">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page content -->
        <main class="container content-area">
            {block name="content"}{/block}
        </main>

        <!-- Footer -->
        {include file='layouts/footer.tpl'}

    </div>
</body>

</html>
