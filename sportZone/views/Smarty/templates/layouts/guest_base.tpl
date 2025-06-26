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

    </style>
    {block name="styles"}{/block}
</head>
<body>
    <div class="page-wrapper">

        <!-- Topbar for login/register -->
        {if true}
            <!-- Topbar for guests -->
            <div class="topbar">
                <a href="/user/login?{$loginQueryString}">Login</a>
                <a href="/user/register">Register</a>
            </div>
        {/if}


        <!-- Main navbar -->
        <div class="navbar">
            <div class="logo">
                MyWebsite
            </div>
            <nav>
                <a href="/user/home">Home</a>
                <a href="/field/searchForm">Prenota un campo</a>
                <a href="index.php">Iscriviti a un corso</a>
                <a href="about.php">About Us</a>
                <a href="contact.php">Contact</a>
            </nav>
        </div>

        <!-- Page content -->
        <main class="container content-area">
            {block name="content"}{/block}
        </main>

        <!-- Footer -->
        <footer>
            &copy; 2025 MyWebsite. All rights reserved. |
            <a href="privacy.php" style="color: #93c5fd;">Privacy Policy</a>
        </footer>

    </div>
</body>

</html>
