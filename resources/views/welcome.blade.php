<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mathporia | Learning Platform</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/ScrollTrigger.min.js"></script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1, #8b5cf6, #3b82f6);
            --hover-gradient: linear-gradient(135deg, #4f46e5, #7c3aed, #2563eb);
            --text-primary: #4338ca;
            --text-secondary: #6b7280;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            overflow-x: hidden;
            background-color: #f9fafb;
            scroll-behavior: smooth;
        }

        h1,
        h2,
        h3 {
            font-family: 'Merriweather', serif;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Navbar Styles */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 2rem;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            padding: 0.5rem 2rem;
            background-color: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(99, 102, 241, 0.15);
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo img {
            height: 3.5rem;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-link {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 600;
            position: relative;
            padding: 0.5rem 0;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-gradient);
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: #4f46e5;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .login-button {
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 0.5rem;
            padding: 0.625rem 1.25rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.3);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(99, 102, 241, 0.4);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--hover-gradient);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .login-button:hover::before {
            opacity: 1;
        }

        .menu-button {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-primary);
            cursor: pointer;
        }

        /* Dropdown Styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 0.75rem);
            right: 0;
            background-color: white;
            border-radius: 0.75rem;
            width: 20rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(10px) scale(0.95);
            pointer-events: none;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 100;
            overflow: hidden;
            border: 1px solid rgba(229, 231, 235, 0.8);

        }

        .dropdown-menu.active {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -6px;
            right: 20px;
            width: 12px;
            height: 12px;
            background-color: white;
            transform: rotate(45deg);
            border-top: 1px solid rgba(229, 231, 235, 0.8);
            border-left: 1px solid rgba(229, 231, 235, 0.8);
        }

        .dropdown-item {
            display: flex;
            padding: 1rem;
            text-decoration: none;
            color: var(--text-secondary);
            transition: background-color 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(79, 70, 229, 0.05);
        }

        .dropdown-item-icon {
            background-color: rgba(79, 70, 229, 0.1);
            border-radius: 50%;
            padding: 0.5rem;
            margin-right: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease;
        }

        .dropdown-item:hover .dropdown-item-icon {
            background-color: rgba(79, 70, 229, 0.2);
        }

        .dropdown-item-icon svg {
            width: 1.25rem;
            height: 1.25rem;
            color: #4f46e5;
        }

        .dropdown-item-content {
            flex: 1;
        }

        .dropdown-item-title {
            color: #111827;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .dropdown-item-desc {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .dropdown-divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 0 1rem;
        }

        :root {
            --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            --hover-gradient: linear-gradient(135deg, #4338ca 0%, #4f46e5 100%);
            --text-primary: #111827;
            --text-secondary: #6b7280;
        }

        /* Hero Section Styles */
        .hero {
            position: relative;
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding-top: 5rem;
            background-color: #151823;
            /* Dark fallback color */
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            opacity: 0.85;
            transition: transform 8s ease, opacity 0.5s ease;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom,
                    rgba(15, 23, 42, 0.85),
                    rgba(30, 41, 59, 0.75));
            backdrop-filter: blur(2px);
            z-index: 1;
            transition: opacity 0.5s ease;
        }

        /* Add subtle animation to background on hover */
        .hero:hover .hero-bg {
            transform: scale(1.05);
            opacity: 0.9;
        }

        .hero:hover .hero-overlay {
            background-color: rgba(0, 0, 0, 0.4);
        }

        .hero-content {
            text-align: center;
            color: white;
            max-width: 800px;
            padding: 0 1.5rem;
            z-index: 1;
            animation: slowDrift 6s ease-in-out infinite;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            animation: pulse 2.5s infinite;
        }

        @keyframes pulse {
            0% {
                text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            }

            50% {
                text-shadow: 0 2px 20px rgba(99, 102, 241, 0.6);
            }

            100% {
                text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            }
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            font-weight: 300;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        .hero-button {
            background: var(--primary-gradient);
            color: white;
            text-decoration: none;
            font-size: 1.25rem;
            font-weight: 600;
            padding: 0.875rem 2rem;
            border-radius: 9999px;
            display: inline-block;
            transition: all 0.5s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .hero-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--hover-gradient);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .hero-button:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .hero-button:hover::before {
            opacity: 1;
        }

        /* Floating shapes for hero section */
        .shape {
            position: absolute;
            z-index: 1;
            opacity: 0.6;
            filter: blur(3px);
            backdrop-filter: blur(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            animation: float 15s ease-in-out infinite;
        }

        .shape-1 {
            top: 20%;
            left: 10%;
            width: 120px;
            height: 120px;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            background: linear-gradient(45deg, rgba(99, 102, 241, 0.4), rgba(99, 102, 241, 0.1));
            animation-delay: 0s;
        }

        .shape-2 {
            top: 60%;
            right: 10%;
            width: 180px;
            height: 180px;
            border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
            background: linear-gradient(45deg, rgba(139, 92, 246, 0.4), rgba(139, 92, 246, 0.1));
            animation-delay: -5s;
        }

        .shape-3 {
            bottom: 20%;
            left: 25%;
            width: 100px;
            height: 100px;
            border-radius: 41% 59% 20% 80% / 47% 37% 63% 53%;
            background: linear-gradient(45deg, rgba(59, 130, 246, 0.4), rgba(59, 130, 246, 0.1));
            animation-delay: -10s;
        }

        .shape-4 {
            top: 30%;
            right: 25%;
            width: 80px;
            height: 80px;
            border-radius: 63% 37% 83% 17% / 58% 71% 29% 42%;
            background: linear-gradient(45deg, rgba(79, 70, 229, 0.3), rgba(79, 70, 229, 0.1));
            animation-delay: -7s;
            animation-duration: 18s;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
                opacity: 0.5;
            }

            25% {
                opacity: 0.7;
            }

            50% {
                transform: translate(15px, 15px) rotate(10deg);
                opacity: 0.6;
            }

            75% {
                opacity: 0.7;
            }

            100% {
                transform: translate(0, 0) rotate(0deg);
                opacity: 0.5;
            }
        }

        @keyframes slowDrift {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        /* About Section Styles */
        .section {
            padding: 6rem 0;
        }

        .section-title {
            text-align: center;
            color: var(--text-primary);
            font-size: 2.5rem;
            margin-bottom: 3rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--primary-gradient);
        }

        .about {
            background-color: white;
        }

        .about-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .about-text h3 {
            color: var(--text-primary);
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .about-text p {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .feature-list {
            list-style: none;
            margin-top: 1.5rem;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .feature-icon {
            color: #4f46e5;
            margin-right: 0.5rem;
            margin-top: 0.25rem;
            flex-shrink: 0;
        }

        .about-image {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
            transform: perspective(1000px) rotateY(5deg);
        }

        .about-image:hover {
            transform: perspective(1000px) rotateY(0deg);
            box-shadow: 0 25px 50px rgba(99, 102, 241, 0.2);
        }

        .about-image img {
            width: 100%;
            height: auto;
            transition: all 0.7s ease;
            display: block;
        }

        .about-image:hover img {
            transform: scale(1.05);
        }

        /* Services Section Styles */
        .services {
            background: linear-gradient(135deg, #f9fafb, #f3f4f6);
        }

        .services-subtitle {
            text-align: center;
            color: var(--text-secondary);
            font-size: 1.25rem;
            margin-top: -2rem;
            margin-bottom: 3rem;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .service-card {
            background-color: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--primary-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.15);
        }

        .service-card:hover::before {
            opacity: 0.03;
        }

        .service-icon {
            width: 4rem;
            height: 4rem;
            background-color: rgba(79, 70, 229, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .service-card:hover .service-icon {
            background-color: rgba(79, 70, 229, 0.2);
            transform: scale(1.1);
        }

        .service-icon svg {
            width: 2rem;
            height: 2rem;
            color: #4f46e5;
        }

        .service-title {
            color: var(--text-primary);
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            text-align: center;
        }

        .service-desc {
            color: var(--text-secondary);
            text-align: center;
            line-height: 1.6;
        }

        /* Contact Section Styles */
        .contact {
            background-color: white;
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
        }

        .contact-info h3,
        .contact-form h3 {
            color: var(--text-primary);
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .contact-icon {
            color: #4f46e5;
            margin-right: 0.75rem;
            margin-top: 0.25rem;
            flex-shrink: 0;
        }

        .contact-form form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            font-family: 'Quicksand', sans-serif;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-button {
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            align-self: flex-start;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .form-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--hover-gradient);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .form-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        .form-button:hover::before {
            opacity: 1;
        }

        /* Footer Styles */
        .footer {
            background: var(--primary-gradient);
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        .footer-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .footer-copyright {
            font-size: 0.875rem;
            opacity: 0.8;
            margin-top: 0.5rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 0.75rem;
        }

        .footer-link {
            color: white;
            text-decoration: none;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .footer-link:hover {
            opacity: 1;
        }

        .footer-divider {
            opacity: 0.5;
        }

        /* Scroll To Top Button */
        .scroll-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--primary-gradient);
            color: white;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            z-index: 100;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .scroll-top.show {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        /* Animation classes */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .hero-title {
                font-size: 3rem;
            }

            .hero-subtitle {
                font-size: 1.25rem;
            }

            .service-card {
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.75rem 1rem;
            }

            .nav-links {
                display: none;
            }

            .menu-button {
                display: block;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .about-container,
            .contact-container {
                grid-template-columns: 1fr;
            }

            .about-image {
                grid-row: 1;
                margin-bottom: 2rem;
            }

            .section {
                padding: 4rem 0;
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-button {
                font-size: 1rem;
                padding: 0.75rem 1.5rem;
            }

            .service-card {
                padding: 1.25rem;
            }

            .dropdown-menu {
                width: 100%;
                left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container navbar-container">
            <div class="logo">
                <img src="{{ asset('storage/images/LogoT.png') }}" alt="Logo Mathporia">
            </div>

            <div class="nav-links">
                <a href="/" class="nav-link">HOME</a>
                <a href="#about" class="nav-link">ABOUT</a>
                <a href="#services" class="nav-link">SERVICE</a>
                <a href="#contact" class="nav-link">CONTACT</a>
            </div>


            <div class="dropdown">
                <button id="loginButton" class="login-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <span>Login / Register</span>
                </button>

                <div id="dropdownMenu" class="dropdown-menu">
                    <div class="dropdown-menu::before"></div>
                    <a href="http://web-student.test/login" class="dropdown-item">
                        <div class="dropdown-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c0 1.104-.896 2-2 2s-2-.896-2-2 2-4 2-4 2 2.896 2 2zm0 0c0 1.104.896 2 2 2s2-.896 2-2-2-4-2-4-2 2.896-2 2zm0 2v8m-7 0h14" />
                            </svg>
                        </div>
                        <div class="dropdown-item-content">
                            <div class="dropdown-item-title">Login sebagai Siswa atau Guru</div>
                            <div class="dropdown-item-desc">Akses materi pembelajaran atau kelola kelas dan materi</div>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="http://web-student.test/register" class="dropdown-item">
                        <div class="dropdown-item-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <div class="dropdown-item-content">
                            <div class="dropdown-item-title">Daftar Akun Baru</div>
                            <div class="dropdown-item-desc">Bergabung dengan Mathporia</div>
                        </div>
                    </a>
                </div>
            </div>

            <button class="menu-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <!-- Background image with proper loading -->
        <img src="/api/placeholder/1920/1080" alt="Math learning background" class="hero-bg" loading="eager">

        <div class="hero-overlay"></div>

        <!-- Animated shapes -->
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>

        <div class="hero-content">
            <h1 class="hero-title">Selamat Datang di Mathporia</h1>
            <p class="hero-subtitle">Belajar Matematika dengan Cara Menyenangkan!</p>
            <a href="http://web-student.test/login" class="hero-button">
                Mulai Belajar →
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section about">
        <div class="container">
            <h2 class="section-title fade-in">Tentang Mathporia</h2>

            <div class="about-container">
                <div class="about-text fade-in">
                    <h3>Misi Kami</h3>
                    <p>
                        Mathporia hadir untuk membantu siswa dan guru dalam menjadikan pembelajaran matematika lebih
                        menyenangkan, interaktif, dan mudah dipahami. Kami percaya bahwa dengan pendekatan yang tepat,
                        matematika bisa menjadi mata pelajaran yang menarik dan menumbuhkan rasa ingin tahu. Bagi siswa,
                        Mathporia menjadi teman belajar yang seru; bagi guru, Mathporia menjadi alat bantu yang
                        mendukung proses mengajar agar lebih efektif dan menyenangkan.
                    </p>

                    <h3>Apa yang Kami Tawarkan</h3>
                    <ul class="feature-list">
                        <li class="feature-item">
                            <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="20"
                                height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Pembelajaran interaktif dengan visualisasi menarik</span>
                        </li>
                        <li class="feature-item">
                            <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="20"
                                height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Materi yang disusun oleh guru-guru yang memahami kebutuhan siswa</span>
                        </li>
                        <li class="feature-item">
                            <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="20"
                                height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Sistem pembelajaran yang adaptif</span>
                        </li>
                    </ul>
                </div>

                <div class="about-image fade-in">
                    <img src="{{ asset('storage/images/LogoT.png') }}" alt="Logo Mathporia">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section services">
        <div class="container">
            <h2 class="section-title fade-in">Layanan Kami</h2>
            <p class="services-subtitle fade-in">Berbagai cara menyenangkan untuk belajar matematika</p>

            <div class="services-grid">
                <!-- Service Card 1 -->
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="service-title">Pembelajaran Interaktif</h3>
                    <p class="service-desc">
                        Materi pembelajaran disajikan dengan animasi dan visualisasi menarik untuk memudahkan pemahaman
                        konsep matematika.
                    </p>
                </div>

                <!-- Service Card 2 -->
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="service-title">Modul Lengkap</h3>
                    <p class="service-desc">
                        Kumpulan modul dari tingkat dasar hingga lanjut dengan contoh soal dan pembahasan yang jelas.
                    </p>
                </div>

                <!-- Service Card 3 -->
                <div class="service-card fade-in">
                    <div class="service-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <h3 class="service-title">Forum Diskusi</h3>
                    <p class="service-desc">
                        Tempat berdiskusi dengan siswa lain dan guru untuk bertanya dan berbagi pengetahuan matematika.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section contact">
        <div class="container">
            <h2 class="section-title fade-in">Hubungi Kami</h2>

            <div class="contact-container">
                <div class="contact-info fade-in">
                    <h3>Informasi Kontak</h3>
                    <div class="contact-details">
                        <div class="contact-item">
                            <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>info@mathporia.com</span>
                        </div>
                        <div class="contact-item">
                            <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>+62 123 4567 890</span>
                        </div>
                        <div class="contact-item">
                            <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Jl. Telkom No. 123, Bandung, Indonesia</span>
                        </div>
                    </div>
                </div>

                <div class="contact-form fade-in">
                    <h3>Kirim Pesan</h3>
                    <form>
                        <input type="text" placeholder="Nama Anda" class="form-input" required>
                        <input type="email" placeholder="Email Anda" class="form-input" required>
                        <textarea placeholder="Pesan Anda" class="form-textarea" required></textarea>
                        <button type="submit" class="form-button">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p class="footer-title">Mathporia - Belajar Matematika dengan Cara Menyenangkan!</p>
            <p class="footer-copyright">© 2025 Mathporia. All Rights Reserved.</p>
            <div class="footer-links">
                <a href="#" class="footer-link">Privacy Policy</a>
                <span class="footer-divider">|</span>
                <a href="#" class="footer-link">Terms of Service</a>
                <span class="footer-divider">|</span>
                <a href="#" class="footer-link">Contact Us</a>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <div class="scroll-top" id="scrollTop">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginButton = document.getElementById('loginButton');
            const dropdownMenu = document.getElementById('dropdownMenu');

            // Toggle dropdown saat tombol login diklik
            loginButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                dropdownMenu.classList.toggle('active');
            });

            // Tutup dropdown saat mengklik di luar
            document.addEventListener('click', function(e) {
                if (!dropdownMenu.contains(e.target) && e.target !== loginButton) {
                    dropdownMenu.classList.remove('active');
                }
            });

            // Mencegah dropdown tertutup saat mengklik di dalamnya kecuali jika kita klik link
            dropdownMenu.addEventListener('click', function(e) {
                if (!e.target.closest('a')) {
                    e.stopPropagation();
                }
            });
        });

        // Fade In Animation on Scroll
        document.addEventListener('DOMContentLoaded', function() {
            // Show elements that are in viewport on load
            const fadeElements = document.querySelectorAll('.fade-in');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            fadeElements.forEach(element => {
                observer.observe(element);
            });

            // Navbar scroll effect
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Scroll to top button
            const scrollTopBtn = document.getElementById('scrollTop');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 500) {
                    scrollTopBtn.classList.add('show');
                } else {
                    scrollTopBtn.classList.remove('show');
                }
            });

            scrollTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Mobile menu toggle
            const menuButton = document.querySelector('.menu-button');
            const navLinks = document.querySelector('.nav-links');

            menuButton.addEventListener('click', function() {
                // Create a mobile menu for small screens
                if (!document.querySelector('.mobile-menu')) {
                    const mobileMenu = document.createElement('div');
                    mobileMenu.className = 'mobile-menu';
                    mobileMenu.style.cssText = `
                            position: fixed;
                            top: 70px;
                            left: 0;
                            width: 100%;
                            background: white;
                            padding: 1rem;
                            display: flex;
                            flex-direction: column;
                            gap: 1rem;
                            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
                            z-index: 999;
                            transform: translateY(-100%);
                            transition: transform 0.3s ease;
                        `;

                    // Clone nav links
                    const links = navLinks.querySelectorAll('.nav-link');
                    links.forEach(link => {
                        const newLink = link.cloneNode(true);
                        newLink.style.cssText = `
                                padding: 0.75rem 1rem;
                                border-radius: 0.5rem;
                                transition: background-color 0.2s ease;
                            `;
                        newLink.addEventListener('mouseenter', () => {
                            newLink.style.backgroundColor = 'rgba(79, 70, 229, 0.1)';
                        });
                        newLink.addEventListener('mouseleave', () => {
                            newLink.style.backgroundColor = 'transparent';
                        });
                        mobileMenu.appendChild(newLink);
                    });

                    document.body.appendChild(mobileMenu);

                    // Show menu with animation
                    setTimeout(() => {
                        mobileMenu.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    // Toggle existing menu
                    const mobileMenu = document.querySelector('.mobile-menu');
                    if (mobileMenu.style.transform === 'translateY(0px)') {
                        mobileMenu.style.transform = 'translateY(-100%)';
                    } else {
                        mobileMenu.style.transform = 'translateY(0)';
                    }
                }
            });

            // Typing effect for hero title
            const heroTitle = document.querySelector('.hero-title');
            const originalText = heroTitle.textContent;
            heroTitle.textContent = '';

            let i = 0;
            const typeWriter = () => {
                if (i < originalText.length) {
                    heroTitle.textContent += originalText.charAt(i);
                    i++;
                    setTimeout(typeWriter, 50);
                }
            };

            // Start typing effect when hero section is in view
            const heroObserver = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    setTimeout(typeWriter, 500);
                    heroObserver.unobserve(entries[0].target);
                }
            });

            heroObserver.observe(document.querySelector('.hero'));

            // Parallax effect for hero section
            const hero = document.querySelector('.hero');
            window.addEventListener('scroll', function() {
                const scrollPosition = window.scrollY;
                if (scrollPosition < window.innerHeight) {
                    const parallaxValue = scrollPosition * 0.4;
                    hero.style.backgroundPositionY = `-${parallaxValue}px`;
                }
            });

            // Add interactive hover effect to service cards
            const serviceCards = document.querySelectorAll('.service-card');
            serviceCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    // Add a slight rotation
                    this.style.transform = 'translateY(-10px) rotate(1deg)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) rotate(0)';
                });
            });

            // Animation for form submission
            const contactForm = document.querySelector('.contact-form form');
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate form
                const inputs = this.querySelectorAll('input, textarea');
                let isValid = true;

                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.style.borderColor = '#ef4444';

                        // Reset border after animation
                        setTimeout(() => {
                            input.style.borderColor = '#e5e7eb';
                        }, 3000);
                    }
                });

                if (isValid) {
                    // Create success message
                    const successMsg = document.createElement('div');
                    successMsg.className = 'success-message';
                    successMsg.style.cssText = `
                            background-color: #10b981;
                            color: white;
                            padding: 1rem;
                            border-radius: 0.5rem;
                            margin-top: 1rem;
                            display: flex;
                            align-items: center;
                            gap: 0.5rem;
                            font-weight: 600;
                            opacity: 0;
                            transform: translateY(10px);
                            transition: all 0.3s ease;
                        `;

                    const checkIcon = document.createElement('span');
                    checkIcon.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        `;

                    successMsg.appendChild(checkIcon);
                    successMsg.appendChild(document.createTextNode(
                        'Pesan terkirim! Terima kasih telah menghubungi kami.'));

                    contactForm.appendChild(successMsg);

                    // Show message with animation
                    setTimeout(() => {
                        successMsg.style.opacity = '1';
                        successMsg.style.transform = 'translateY(0)';
                    }, 50);

                    // Clear form
                    contactForm.reset();

                    // Remove message after delay
                    setTimeout(() => {
                        successMsg.style.opacity = '0';
                        successMsg.style.transform = 'translateY(10px)';

                        setTimeout(() => {
                            contactForm.removeChild(successMsg);
                        }, 300);
                    }, 5000);
                }
            });
        });

        // Enhanced parallax effect for hero background
        document.addEventListener('DOMContentLoaded', function() {
            const heroBg = document.querySelector('.hero-bg');
            const heroShapes = document.querySelectorAll('.shape');

            // Parallax effect on scroll
            window.addEventListener('scroll', function() {
                const scrollPosition = window.scrollY;
                if (scrollPosition < window.innerHeight) {
                    // Move background slightly slower than scroll
                    const parallaxValue = scrollPosition * 0.4;
                    heroBg.style.transform = `translateY(${parallaxValue * 0.5}px) scale(1.05)`;

                    // Move shapes at different speeds
                    heroShapes.forEach((shape, index) => {
                        const factor = 0.1 * (index + 1);
                        shape.style.transform =
                            `translate(${parallaxValue * factor}px, ${-parallaxValue * factor}px)`;
                    });
                }
            });

            // Motion effect on mouse move for an immersive experience
            const hero = document.querySelector('.hero');
            hero.addEventListener('mousemove', function(e) {
                const mouseX = e.clientX / window.innerWidth;
                const mouseY = e.clientY / window.innerHeight;

                heroBg.style.transform = `translate(${mouseX * -15}px, ${mouseY * -15}px) scale(1.05)`;

                // Move each shape differently based on mouse position
                heroShapes.forEach((shape, index) => {
                    const factor = (index + 1) * 5;
                    shape.style.transform = `translate(${mouseX * factor}px, ${mouseY * factor}px)`;
                });
            });

            // Reset transforms when mouse leaves the hero section
            hero.addEventListener('mouseleave', function() {
                heroBg.style.transform = '';
                heroShapes.forEach(shape => {
                    shape.style.transform = '';
                });
            });
        });
    </script>
</body>

</html>
