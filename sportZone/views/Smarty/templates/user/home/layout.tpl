<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f8fafc;
            color: #1f2937;
        }
        .navbar {
            background-color: #1f2937;
            color: white;
            padding: 1rem 2rem;
            font-size: 1.2rem;
        }
        .tabs {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            gap: 2rem;
            padding: 1rem 2rem;
        }
        .tabs a {
            text-decoration: none;
            color: #4b5563;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
        }
        .tabs a.active {
            background-color: #3b82f6;
            color: white;
        }
        .content {
            padding: 2rem;
        }
        .navbar {
            background-color: #1f2937;
            color: white;
            padding: 1rem 2rem;
            font-size: 1.2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }
        .icon-link {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem;
            border-radius: 50%;
            transition: background 0.15s;
        }
        .icon-link:hover {
            background: #3b82f6;
        }
        .user-dropdown {
            position: relative;
            display: inline-block;
        }
        .user-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.2rem;
            border-radius: 50%;
        }
        .user-btn:hover {
            background: #3b82f6;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #fff;
            min-width: 140px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.10);
            border-radius: 0.5rem;
            z-index: 1;
            margin-top: 0.5rem;
        }
        .user-dropdown:hover .dropdown-content {
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
    </style>
</head>
<body>
       <div class="navbar">
        Welcome, {$username|escape}
        <div class="navbar-actions">
            <a href="/user/notifications" title="Notifications" class="icon-link">
                <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M18 8a6 6 0 10-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
            </a>
            <a href="/user/settings" title="Settings" class="icon-link">
                <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09a1.65 1.65 0 00-1-1.51 1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09a1.65 1.65 0 001.51-1 1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06a1.65 1.65 0 001.82.33h.09A1.65 1.65 0 0011 3.09V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51h.09a1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82v.09a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></svg>
            </a>
            <div class="user-dropdown">
                <button class="user-btn" title="Account">
                    <svg width="22" height="22" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a8.38 8.38 0 0113 0"/></svg>
                </button>
                <div class="dropdown-content">
                    <a href="/user/change">Change User</a>
                    <a href="/user/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <div class="tabs">
        <a href="/user/profile" class="{if $active_tab == 'profile'}active{/if}">Profile</a>
        <a href="/user/myCourses" class="{if $active_tab == 'courses'}active{/if}">My Courses</a>
        <a href="/user/myReservations" class="{if $active_tab == 'reservations'}active{/if}">My Reservations</a>
        <a href="/user/settings" class="{if $active_tab == 'settings'}active{/if}">Settings</a>
    </div>
    <div class="content">
        {block name="content"}{/block}
    </div>
</body>
</html>
