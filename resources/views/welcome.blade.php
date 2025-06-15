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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --hover-gradient: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            --text-primary: #1f2937;
            --text-secondary: #4b5563;
            --accent-1: #f472b6;
            /* Pink */
            --accent-2: #34d399;
            /* Green */
            --accent-3: #fbbf24;
            /* Yellow */
            --accent-4: #60a5fa;
            /* Blue */
            --math-symbols: "∫", "∑", "π", "∞", "√", "±", "×", "÷", "=", "≠", "≈", "≤", "≥";
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
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 50;
            height: 4rem;
            min-height: 64px;
            padding: 0 2rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(229, 231, 235, 0.5);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .navbar.scrolled {
            padding: 0 2rem;
            height: 3.5rem;
            min-height: 56px;
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            height: 100%;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            height: 100%;
        }

        .logo-box {
            width: 2.7rem;
            height: 2.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Merriweather', serif;
            font-weight: 700;
            font-size: 1.7rem;
            color: #fff;
            background: linear-gradient(135deg, #4f8cff 0%, #ff914d 100%);
            border-radius: 1rem;
            box-shadow: 0 2px 10px rgba(79, 140, 255, 0.12), 0 1px 4px rgba(255, 145, 77, 0.10);
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .logo-box:hover {
            box-shadow: 0 6px 24px rgba(79, 140, 255, 0.18), 0 2px 8px rgba(255, 145, 77, 0.15);
            transform: scale(1.07) rotate(-2deg);
        }

        .nav-links {
            display: flex;
            gap: 1.75rem;
            align-items: center;
            height: 100%;
        }

        @media (max-width: 1024px) {
            .navbar {
                padding: 0 1.25rem;
            }

            .navbar.scrolled {
                padding: 0 1.25rem;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0 1rem;
                height: 3.5rem;
                min-height: 56px;
            }

            .navbar.scrolled {
                padding: 0 1rem;
                height: 3.25rem;
                min-height: 52px;
            }

            .nav-links {
                gap: 1.25rem;
            }

            .logo-box {
                width: 2.1rem;
                height: 2.1rem;
                font-size: 1.2rem;
                border-radius: 0.7rem;
            }
        }

        .logo img {
            height: 3rem;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
        }

        .nav-link {
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            position: relative;
            padding: 0.5rem 0;
            transition: all 0.3s ease;
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
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.2);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.3);
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
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(99, 102, 241, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(244, 114, 182, 0.15) 0%, transparent 50%);
            animation: gradientShift 15s ease infinite;
        }

        .math-symbols {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            opacity: 0.1;
        }

        .math-symbol {
            position: absolute;
            font-size: 2rem;
            color: white;
            animation: floatSymbol 20s linear infinite;
            opacity: 0;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 0%;
            }

            50% {
                background-position: 100% 100%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        @keyframes floatSymbol {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 0.5;
            }

            90% {
                opacity: 0.5;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .hero-3d-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: auto;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 800px;
            padding: 0 2rem;
        }

        .hero-title {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: white;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s ease;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2.5rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s ease 0.2s backwards;
        }

        .hero-button {
            position: relative;
            overflow: hidden;
            background: linear-gradient(45deg, #4f46e5, #6366f1, #8b5cf6);
            background-size: 200% 200%;
            animation: gradientMove 3s ease infinite;
            color: white;
            text-decoration: none;
            font-size: 1.25rem;
            font-weight: 600;
            padding: 1rem 2.5rem;
            border-radius: 9999px;
            display: inline-block;
            transition: all 0.5s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 1;
            transform-style: preserve-3d;
            animation: fadeInUp 1s ease 0.4s backwards;
        }

        .hero-button:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 25px rgba(99, 102, 241, 0.4);
        }

        .hero-button:active {
            transform: translateY(-1px) scale(1.02);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .three-instruction {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.95rem;
            z-index: 3;
            background: rgba(30, 32, 60, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease 0.6s backwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .three-instruction svg {
            width: 1.2em;
            height: 1.2em;
            opacity: 0.8;
        }

        /* Floating shapes for hero section */
        .shape {
            position: absolute;
            z-index: 1;
            opacity: 0.6;
            filter: blur(3px);
            backdrop-filter: blur(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            animation: float3D 15s ease-in-out infinite;
            transform-style: preserve-3d;
        }

        .shape-1 {
            top: 20%;
            left: 10%;
            width: 120px;
            height: 120px;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            background: linear-gradient(45deg, rgba(244, 114, 182, 0.4), rgba(244, 114, 182, 0.1));
            animation-delay: 0s;
            transform: translateZ(50px);
        }

        .shape-2 {
            top: 60%;
            right: 10%;
            width: 180px;
            height: 180px;
            border-radius: 63% 37% 54% 46% / 55% 48% 52% 45%;
            background: linear-gradient(45deg, rgba(52, 211, 153, 0.4), rgba(52, 211, 153, 0.1));
            animation-delay: -5s;
            transform: translateZ(30px);
        }

        .shape-3 {
            bottom: 20%;
            left: 25%;
            width: 100px;
            height: 100px;
            border-radius: 41% 59% 20% 80% / 47% 37% 63% 53%;
            background: linear-gradient(45deg, rgba(251, 191, 36, 0.4), rgba(251, 191, 36, 0.1));
            animation-delay: -10s;
            transform: translateZ(20px);
        }

        .shape-4 {
            top: 30%;
            right: 25%;
            width: 80px;
            height: 80px;
            border-radius: 63% 37% 83% 17% / 58% 71% 29% 42%;
            background: linear-gradient(45deg, rgba(96, 165, 250, 0.3), rgba(96, 165, 250, 0.1));
            animation-delay: -7s;
            animation-duration: 18s;
            transform: translateZ(40px);
        }

        @keyframes float3D {

            0%,
            100% {
                transform: translateY(0) rotateX(0) rotateY(0);
            }

            50% {
                transform: translateY(-20px) rotateX(5deg) rotateY(5deg);
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
            padding: 8rem 0;
            transform-style: preserve-3d;
            perspective: 1000px;
            position: relative;
            overflow: hidden;
        }

        .section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(99, 102, 241, 0.5),
                    transparent);
        }

        .section-title {
            text-align: center;
            color: var(--text-primary);
            font-size: 2.75rem;
            margin-bottom: 4rem;
            position: relative;
            padding-bottom: 1.5rem;
            transform: translateZ(30px);
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 2px;
        }

        .about {
            background-color: white;
        }

        .about-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .about-text h3 {
            color: var(--text-primary);
            font-size: 1.75rem;
            margin-bottom: 1.25rem;
            font-weight: 700;
        }

        .about-text p {
            color: var(--text-secondary);
            margin-bottom: 2rem;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        .feature-list {
            list-style: none;
            margin-top: 2rem;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.25rem;
            transition: transform 0.3s ease;
        }

        .feature-item:hover {
            transform: translateX(10px);
        }

        .feature-icon {
            color: #4f46e5;
            margin-right: 1rem;
            margin-top: 0.25rem;
            flex-shrink: 0;
            background: rgba(79, 70, 229, 0.1);
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .feature-item:hover .feature-icon {
            background: rgba(79, 70, 229, 0.2);
            transform: scale(1.1);
        }

        .about-image {
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
            transform: perspective(1000px) rotateY(5deg);
        }

        .about-image:hover {
            transform: perspective(1000px) rotateY(0deg);
            box-shadow: 0 30px 60px rgba(99, 102, 241, 0.2);
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
            font-size: 1.35rem;
            margin-top: -2.5rem;
            margin-bottom: 4rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
        }

        .service-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1.5rem;
            padding: 2.5rem;
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(99, 102, 241, 0.15);
            background: rgba(255, 255, 255, 0.98);
        }

        .service-icon {
            position: relative;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            background: rgba(79, 70, 229, 0.1);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .service-card:hover .service-icon {
            background: rgba(79, 70, 229, 0.2);
            transform: scale(1.1);
        }

        .service-icon svg {
            width: 2.5rem;
            height: 2.5rem;
            color: #4f46e5;
            transition: all 0.3s ease;
        }

        .service-title {
            color: var(--text-primary);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
        }

        .service-desc {
            color: var(--text-secondary);
            text-align: center;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        /* Contact Section Styles */
        .contact {
            background-color: white;
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
        }

        .contact-info h3,
        .contact-form h3 {
            color: var(--text-primary);
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .contact-item:hover {
            transform: translateX(10px);
        }

        .contact-icon {
            color: #4f46e5;
            margin-right: 1rem;
            margin-top: 0.25rem;
            flex-shrink: 0;
            background: rgba(79, 70, 229, 0.1);
            padding: 0.75rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .contact-item:hover .contact-icon {
            background: rgba(79, 70, 229, 0.2);
            transform: scale(1.1);
        }

        .contact-form form {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 1rem 1.25rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            font-family: 'Quicksand', sans-serif;
            font-size: 1rem;
            transform-style: preserve-3d;
            background: white;
        }

        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            transform: translateZ(10px);
        }

        .form-textarea {
            resize: vertical;
            min-height: 150px;
        }

        .form-button {
            background: var(--primary-gradient);
            color: white;
            border: none;
            border-radius: 0.75rem;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            align-self: flex-start;
            position: relative;
            overflow: hidden;
            z-index: 1;
            margin-top: 0.5rem;
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
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.25);
        }

        .form-button:hover::before {
            opacity: 1;
        }

        .form-button:active {
            transform: translateY(-1px);
        }

        /* Footer Styles */
        .footer {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            padding: 4rem 0 2rem;
            text-align: center;
            transform-style: preserve-3d;
            perspective: 1000px;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: gradientShift 15s ease infinite;
        }

        .footer-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            transform: translateZ(20px);
            position: relative;
        }

        .footer-copyright {
            font-size: 1rem;
            opacity: 0.9;
            margin-top: 1rem;
            position: relative;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 1.5rem;
            position: relative;
        }

        .footer-link {
            color: white;
            text-decoration: none;
            opacity: 0.9;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .footer-link:hover {
            opacity: 1;
            transform: translateY(-2px);
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
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            z-index: 100;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .scroll-top.show {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-top:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
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

            .hero-content {
                transform: none !important;
            }

            .service-card:hover {
                transform: translateY(-10px) !important;
            }

            .math-symbol {
                font-size: 1.5rem;
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
                <div class="logo-box">M</div>
            </div>

            <div class="nav-links">
                <a href="/" class="nav-link">HOME</a>
                <a href="#about" class="nav-link">ABOUT</a>
                <a href="#services" class="nav-link">SERVICE</a>
                <a href="#contact" class="nav-link">CONTACT</a>
            </div>

            <!--- Dropdown Navbar --->
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
                    <a href="{{ url('/login') }}" class="dropdown-item">
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

                    {{-- <a href="{{ url('/register') }}" class="dropdown-item">
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
                    </a> --}}
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
        <div class="hero-3d-bg" id="hero3d"></div>
        <div class="hero-content">
            <h1 class="hero-title">Selamat Datang di Mathporia</h1>
            <p class="hero-subtitle">Belajar Matematika dengan Cara Menyenangkan!</p>
            <a href="{{ url('/login') }}" class="hero-button">
                Mulai Belajar →
            </a>
        </div>
        <div class="three-instruction">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 15l4-4 4 4m0 0V3m0 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Klik dan drag untuk memutar • Scroll untuk zoom
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
                            <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Pembelajaran interaktif dengan visualisasi menarik</span>
                        </li>
                        <li class="feature-item">
                            <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                    <img src="{{ asset('images/LogoT.png') }}" alt="Logo Mathporia">
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

        // Enhanced 3D Effects
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('hero3d');
            let width = container.offsetWidth;
            let height = container.offsetHeight;

            // Scene
            const scene = new THREE.Scene();
            scene.background = new THREE.Color(0x1e1b4b);

            // Camera
            const camera = new THREE.PerspectiveCamera(60, width / height, 0.1, 100);
            camera.position.set(0, 0, 8);

            // Renderer
            const renderer = new THREE.WebGLRenderer({
                alpha: true,
                antialias: true
            });
            renderer.setSize(width, height);
            renderer.setClearColor(0x1e1b4b, 1);
            container.appendChild(renderer.domElement);

            // Controls
            const controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableDamping = true;
            controls.dampingFactor = 0.08;
            controls.enablePan = false;
            controls.minDistance = 6;
            controls.maxDistance = 16;

            // Lights
            const ambient = new THREE.AmbientLight(0xffffff, 0.7);
            scene.add(ambient);

            const dirLight = new THREE.DirectionalLight(0xffffff, 0.7);
            dirLight.position.set(5, 10, 7);
            scene.add(dirLight);

            // Add point lights for more dynamic lighting
            const pointLight1 = new THREE.PointLight(0xf472b6, 1, 20);
            pointLight1.position.set(-5, 5, 5);
            scene.add(pointLight1);

            const pointLight2 = new THREE.PointLight(0x34d399, 1, 20);
            pointLight2.position.set(5, -5, 5);
            scene.add(pointLight2);

            // Materials with more vibrant colors
            const materials = [
                new THREE.MeshPhongMaterial({
                    color: 0xf472b6,
                    shininess: 100,
                    flatShading: true
                }), // Pink
                new THREE.MeshPhongMaterial({
                    color: 0x34d399,
                    shininess: 100,
                    flatShading: true
                }), // Green
                new THREE.MeshPhongMaterial({
                    color: 0xfbbf24,
                    shininess: 100,
                    flatShading: true
                }), // Yellow
                new THREE.MeshPhongMaterial({
                    color: 0x60a5fa,
                    shininess: 100,
                    flatShading: true
                }), // Blue
                new THREE.MeshPhongMaterial({
                    color: 0x8b5cf6,
                    shininess: 100,
                    flatShading: true
                }), // Purple
                new THREE.MeshPhongMaterial({
                    color: 0xffffff,
                    shininess: 100,
                    flatShading: false,
                    transparent: true,
                    opacity: 0.7
                })
            ];

            const objects = [];

            // Cube with more complex geometry
            const cube = new THREE.Mesh(
                new THREE.BoxGeometry(1.2, 1.2, 1.2, 2, 2, 2),
                materials[0]
            );
            cube.position.set(-2.2, 1.2, 0);
            scene.add(cube);
            objects.push(cube);

            // Sphere with more segments
            const sphere = new THREE.Mesh(
                new THREE.SphereGeometry(0.9, 32, 32),
                materials[1]
            );
            sphere.position.set(1.7, 1.1, 0.5);
            scene.add(sphere);
            objects.push(sphere);

            // Torus with more complex geometry
            const torus = new THREE.Mesh(
                new THREE.TorusGeometry(1, 0.28, 16, 100),
                materials[4]
            );
            torus.position.set(-1.2, -1.2, 0);
            scene.add(torus);
            objects.push(torus);

            // Octahedron with more complex geometry
            const oct = new THREE.Mesh(
                new THREE.OctahedronGeometry(1, 2),
                materials[3]
            );
            oct.position.set(2.2, -0.7, 0);
            scene.add(oct);
            objects.push(oct);

            // Add a dodecahedron
            const dodecahedron = new THREE.Mesh(
                new THREE.DodecahedronGeometry(0.8),
                materials[2]
            );
            dodecahedron.position.set(0.5, -2.1, 0);
            scene.add(dodecahedron);
            objects.push(dodecahedron);

            // Add a torus knot
            const torusKnot = new THREE.Mesh(
                new THREE.TorusKnotGeometry(0.6, 0.2, 100, 16),
                materials[5]
            );
            torusKnot.position.set(-1.5, -1.5, 0);
            scene.add(torusKnot);
            objects.push(torusKnot);

            // Animate
            function animate() {
                requestAnimationFrame(animate);

                objects.forEach((obj, i) => {
                    obj.rotation.x += 0.008 + i * 0.001;
                    obj.rotation.y += 0.012 + i * 0.001;

                    // Add some floating motion
                    obj.position.y += Math.sin(Date.now() * 0.001 + i) * 0.001;
                });

                // Animate point lights
                pointLight1.position.x = Math.sin(Date.now() * 0.001) * 5;
                pointLight1.position.z = Math.cos(Date.now() * 0.001) * 5;

                pointLight2.position.x = Math.cos(Date.now() * 0.001) * 5;
                pointLight2.position.z = Math.sin(Date.now() * 0.001) * 5;

                controls.update();
                renderer.render(scene, camera);
            }

            animate();

            // Responsive
            window.addEventListener('resize', () => {
                width = container.offsetWidth;
                height = container.offsetHeight;
                camera.aspect = width / height;
                camera.updateProjectionMatrix();
                renderer.setSize(width, height);
            });
        });
    </script>
</body>

</html>
