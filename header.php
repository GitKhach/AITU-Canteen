<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : "AITU Canteen"; ?></title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-user {
            position: relative;
        }

        .profile-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border: 1px solid #e2e7df;
            border-radius: 12px;
            background: #fff;
            color: #273e2b;
            font-family: inherit;
            font-size: inherit;
            font-weight: 400 !important;
            cursor: pointer;
            transition: background 0.2s;
        }

        .profile-toggle:hover,
        .profile-toggle[aria-expanded="true"] {
            background: #f0f4ed;
        }

        .profile-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 9px;
            background: #eaf0e5;
        }

        .profile-chevron {
            font-size: 10px;
            font-weight: 400;
            transition: transform 0.2s;
        }

        .profile-toggle[aria-expanded="true"] .profile-chevron {
            transform: rotate(180deg);
        }

        .profile-dropdown {
            position: absolute;
            z-index: 1000;
            top: calc(100% + 10px);
            right: 0;
            width: 210px;
            padding: 7px;
            border: 1px solid #e6e9e2;
            border-radius: 14px;
            background: #fff;
            box-shadow: 0 12px 35px rgba(30, 40, 25, 0.12);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-5px);
            transition: opacity 0.18s, transform 0.18s, visibility 0.18s;
        }

        .profile-dropdown.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-dropdown a,
        .profile-dropdown button {
            display: flex;
            align-items: center;
            gap: 11px;
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border: none;
            border-radius: 9px;
            background: transparent;
            color: #42483f;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            text-align: left;
            text-decoration: none;
            cursor: pointer;
        }

        .profile-dropdown a:hover,
        .profile-dropdown button:hover {
            background: #f2f5ef;
        }

        .profile-dropdown .signout-item {
            color: #b6443d;
        }

        .profile-dropdown .signout-item:hover {
            background: #fff1ef;
        }

        .profile-dropdown-divider {
            height: 1px;
            margin: 5px 4px;
            background: #eceee9;
        }

        .signout-form {
            margin: 0;
        }

        @media (max-width: 600px) {
            .navbar {
                gap: 10px;
            }

            .profile-toggle {
                padding: 7px 9px;
            }

            .profile-toggle .profile-name {
                display: none;
            }

            .profile-dropdown {
                right: 0;
            }
        }
    </style>
</head>
<body>

<header class="site-header">
    <nav class="navbar">
        <a href="index.php" class="brand">
            <span class="brand-mark">AC</span>
            <span class="brand-text">
                <span class="brand-title">AITU Canteen</span>
                <span class="brand-subtitle">Astana IT University</span>
            </span>
        </a>

        <div class="nav-links">
            <?php if (!empty($_SESSION['username'])): ?>
                <div class="nav-user">
                    <button
                        type="button"
                        class="profile-toggle"
                        id="profileToggle"
                        aria-expanded="false"
                        aria-controls="profileDropdown"
                    >
                        <span class="profile-avatar">👤</span>
                        <span class="profile-name">Profile</span>
                        <span class="profile-chevron">▼</span>
                    </button>

                    <div class="profile-dropdown" id="profileDropdown">
                        <a href="profile.php">
                            <span>👤</span>
                            My Profile
                        </a>

                        <div class="profile-dropdown-divider"></div>

                        <form action="index.php" method="GET" class="signout-form">
                            <input type="hidden" name="action" value="signout">
                            <button type="submit" class="signout-item">
                                <span>↪</span>
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </nav>
</header>

<main>

<script>
    const profileToggle = document.getElementById('profileToggle');
    const profileDropdown = document.getElementById('profileDropdown');

    if (profileToggle && profileDropdown) {
        profileToggle.addEventListener('click', function (event) {
            event.stopPropagation();

            const isOpen = profileDropdown.classList.toggle('open');
            profileToggle.setAttribute('aria-expanded', String(isOpen));
        });

        document.addEventListener('click', function (event) {
            if (!profileDropdown.contains(event.target)) {
                profileDropdown.classList.remove('open');
                profileToggle.setAttribute('aria-expanded', 'false');
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                profileDropdown.classList.remove('open');
                profileToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }
</script>
