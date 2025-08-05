<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Fitur Quiz</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Floating stars background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(1px 1px at 20px 30px, #fbbf24, transparent),
                radial-gradient(1px 1px at 40px 70px, #fbbf24, transparent),
                radial-gradient(1px 1px at 90px 40px, #fbbf24, transparent),
                radial-gradient(1px 1px at 130px 80px, #fbbf24, transparent),
                radial-gradient(1px 1px at 160px 30px, #fbbf24, transparent),
                radial-gradient(1px 1px at 200px 60px, #fbbf24, transparent),
                radial-gradient(1px 1px at 240px 90px, #fbbf24, transparent),
                radial-gradient(1px 1px at 280px 40px, #fbbf24, transparent),
                radial-gradient(1px 1px at 320px 70px, #fbbf24, transparent),
                radial-gradient(1px 1px at 360px 30px, #fbbf24, transparent),
                radial-gradient(1px 1px at 400px 80px, #fbbf24, transparent),
                radial-gradient(1px 1px at 440px 50px, #fbbf24, transparent),
                radial-gradient(1px 1px at 480px 90px, #fbbf24, transparent),
                radial-gradient(1px 1px at 520px 30px, #fbbf24, transparent),
                radial-gradient(1px 1px at 560px 70px, #fbbf24, transparent),
                radial-gradient(1px 1px at 600px 40px, #fbbf24, transparent),
                radial-gradient(1px 1px at 640px 80px, #fbbf24, transparent),
                radial-gradient(1px 1px at 680px 50px, #fbbf24, transparent),
                radial-gradient(1px 1px at 720px 90px, #fbbf24, transparent),
                radial-gradient(1px 1px at 760px 30px, #fbbf24, transparent),
                radial-gradient(1px 1px at 800px 60px, #fbbf24, transparent),
                radial-gradient(1px 1px at 840px 90px, #fbbf24, transparent),
                radial-gradient(1px 1px at 880px 30px, #fbbf24, transparent),
                radial-gradient(1px 1px at 920px 70px, #fbbf24, transparent),
                radial-gradient(1px 1px at 960px 40px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1000px 80px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1040px 50px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1080px 90px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1120px 30px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1160px 70px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1200px 40px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1240px 80px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1280px 50px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1320px 90px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1360px 30px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1400px 70px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1440px 40px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1480px 80px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1520px 50px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1560px 90px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1600px 30px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1640px 70px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1680px 40px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1720px 80px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1760px 50px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1800px 90px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1840px 30px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1880px 70px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1920px 40px, #fbbf24, transparent),
                radial-gradient(1px 1px at 1960px 80px, #fbbf24, transparent),
                radial-gradient(1px 1px at 2000px 50px, #fbbf24, transparent);
            background-repeat: repeat;
            background-size: 2000px 200px;
            animation: starFloat 45s linear infinite, twinkle 10s ease-in-out infinite;
            z-index: -1;
            opacity: 0.5;
        }

        @keyframes starFloat {
            0% { transform: translateY(0px); }
            100% { transform: translateY(-200px); }
        }

        /* Additional star animations */
        @keyframes twinkle {
            0%, 100% { opacity: 0.4; }
            20% { opacity: 0.8; }
            40% { opacity: 0.6; }
            60% { opacity: 0.9; }
            80% { opacity: 0.5; }
        }

        @keyframes gradientShift {
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

        @keyframes sparkle {
            0%, 100% {
                opacity: 0;
                transform: scale(0) rotate(0deg);
            }

            50% {
                opacity: 1;
                transform: scale(1) rotate(180deg);
            }
        }

        @keyframes glow {
            0%, 100% {
                box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            }
            50% {
                box-shadow: 0 10px 30px rgba(255, 215, 0, 0.6);
            }
        }

        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
        }

        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(odd) {
            animation-direction: reverse;
            animation-duration: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.7;
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 1;
            }
        }

        .star-animated {
            position: absolute;
            color: #fbbf24;
            font-size: 0.6rem;
            opacity: 0.5;
            filter: drop-shadow(0 0 3px #fbbf24);
            pointer-events: auto;
            animation: starTwinkle 6s infinite, starSpin 6s infinite;
            will-change: opacity, transform;
            transition: all 0.5s ease;
            cursor: pointer;
        }

        .star-animated:hover {
            transform: scale(1.5) rotate(180deg);
            filter: drop-shadow(0 0 8px #fbbf24);
            animation-play-state: paused;
        }

        @keyframes starTwinkle {
            0%, 100% { opacity: 0.3; }
            15% { opacity: 0.8; }
            30% { opacity: 0.5; }
            45% { opacity: 0.9; }
            60% { opacity: 0.3; }
            75% { opacity: 0.7; }
            90% { opacity: 0.4; }
        }

        @keyframes starSpin {
            0%, 100% { transform: rotate(0deg) scale(1); }
            10% { transform: rotate(0deg) scale(1); }
            15% { transform: rotate(360deg) scale(1.3); }
            20% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(0deg) scale(1); }
            55% { transform: rotate(360deg) scale(1.3); }
            60% { transform: rotate(0deg) scale(1); }
        }

        body::before {
            animation: starFloat 20s linear infinite, twinkle 3s ease-in-out infinite;
        }

        /* Toggle Button */
        .toggle-btn {
            position: fixed;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1001;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 12px;
            padding: 12px;
            cursor: pointer;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: togglePulse 3s ease-in-out infinite;
        }

        @keyframes togglePulse {
            0%, 100% {
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            }
            50% {
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15), 0 0 15px rgba(56, 189, 248, 0.2);
            }
        }

        .toggle-btn:hover {
            transform: translateY(-50%) scale(1.08);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25), 0 0 25px rgba(56, 189, 248, 0.4);
            animation: none;
        }

        .toggle-btn.sidebar-open {
            left: 370px;
            z-index: 1002;
            animation: none;
        }

        .toggle-btn svg {
            width: 24px;
            height: 24px;
            transition: transform 0.3s ease;
        }

        .toggle-btn.sidebar-open svg {
            transform: rotate(180deg);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: -350px;
            top: 50%;
            transform: translateY(-50%);
            width: 350px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            overflow-y: auto;
            pointer-events: none;
            animation: sidebarGlow 4s ease-in-out infinite;
        }

        @keyframes sidebarGlow {
            0%, 100% {
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            }
            50% {
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15), 0 0 20px rgba(56, 189, 248, 0.1);
            }
        }

        .sidebar.open {
            left: 20px;
            pointer-events: auto;
            animation: sidebarGlow 4s ease-in-out infinite;
        }

        .sidebar-header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(0, 0, 0, 0.1);
        }

        .sidebar-title {
            color: #4f46e5;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .sidebar-subtitle {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .stats-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* Badge Display */
        .badge-display {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(245, 158, 11, 0.05));
            padding: 15px;
            border-radius: 16px;
            font-weight: 700;
            color: #f59e0b;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
            font-size: 1rem;
            border: 1px solid rgba(245, 158, 11, 0.2);
            transition: all 0.3s ease;
        }

        .badge-display:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3);
        }

        .badge-icon {
            font-size: 1.8rem;
            filter: drop-shadow(0 2px 4px rgba(245, 158, 11, 0.3));
        }

        .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            font-size: 0.7rem;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        /* Points Display */
        .points-display {
            display: flex;
            align-items: center;
            gap: 12px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
            padding: 15px;
            border-radius: 16px;
            font-weight: 700;
            color: #3b82f6;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
            font-size: 1rem;
            border: 1px solid rgba(59, 130, 246, 0.2);
            transition: all 0.3s ease;
        }

        .points-display:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
        }

        .points-icon {
            font-size: 1.8rem;
            filter: drop-shadow(0 2px 4px rgba(59, 130, 246, 0.3));
        }

        /* Experience Display */
        .experience-display {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05));
            padding: 20px;
            border-radius: 16px;
            font-weight: 700;
            color: #10b981;
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.2);
            font-size: 1rem;
            border: 1px solid rgba(16, 185, 129, 0.2);
            transition: all 0.3s ease;
        }

        .experience-display:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .exp-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .exp-icon {
            font-size: 1.8rem;
            filter: drop-shadow(0 2px 4px rgba(16, 185, 129, 0.3));
        }

        .exp-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .exp-amount {
            font-size: 1.1rem;
            color: #10b981;
            font-weight: 600;
        }

        .next-level {
            font-size: 0.8rem;
            color: #10b981;
            opacity: 0.8;
            background: rgba(16, 185, 129, 0.15);
            padding: 4px 8px;
            border-radius: 8px;
        }

        /* Progress Bar */
        .progress-bar {
            position: relative;
            height: 12px;
            background: rgba(16, 185, 129, 0.15);
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            margin-bottom: 10px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .progress-bar:hover {
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 0 0 2px rgba(16, 185, 129, 0.3);
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #10b981, #34d399);
            border-radius: 8px;
            position: relative;
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.7rem;
            font-weight: 600;
            color: #065f46;
            text-shadow: 0 1px 2px rgba(255, 255, 255, 0.8);
            z-index: 2;
        }

        .progress-details {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #10b981;
            opacity: 0.8;
        }

        /* Animations */
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .sidebar.open .stats-container > * {
            animation: slideIn 0.5s ease forwards;
        }

        .sidebar.open .stats-container > *:nth-child(1) { animation-delay: 0.1s; }
        .sidebar.open .stats-container > *:nth-child(2) { animation-delay: 0.2s; }
        .sidebar.open .stats-container > *:nth-child(3) { animation-delay: 0.3s; }

        .sidebar.open .stats-container > *:hover {
            transform: translateY(-3px);
            transition: transform 0.4s ease;
        }

        .main-content {
            margin-left: 0;
            transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 1;
        }

        .main-content.sidebar-open {
            margin-left: 0;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .overlay.show {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -350px;
            }

            .sidebar.open {
                left: 20px;
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.sidebar-open {
                margin-left: 0;
            }

            .toggle-btn {
                display: flex;
            }
        }



        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(odd) {
            animation-direction: reverse;
            animation-duration: 4s;
        }

        @keyframes gradientShift {
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

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.7;
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 1;
            }
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }

        @keyframes shimmer-subtitle {
            0% {
                transform: translateX(-100%);
            }
            50% {
                transform: translateX(0%);
            }
            100% {
                transform: translateX(100%);
            }
        }

        @keyframes particleFloat {
            0%, 100% {
                transform: translateY(0px) scale(1);
                opacity: 0.8;
            }
            50% {
                transform: translateY(-3px) scale(1.1);
                opacity: 1;
            }
        }

        .progress-particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            animation: particleFloat 3s infinite ease-in-out;
        }

        .level-up-indicator {
            position: absolute;
            right: -2px;
            top: 50%;
            transform: translateY(-50%);
            width: 6px;
            height: 6px;
            background: #fbbf24;
            border-radius: 50%;
            animation: levelUpPulse 1.5s infinite;
            box-shadow: 0 0 8px rgba(251, 191, 36, 0.6);
        }

        @keyframes levelUpPulse {
            0%, 100% { transform: translateY(-50%) scale(1); opacity: 1; }
            50% { transform: translateY(-50%) scale(1.5); opacity: 0.7; }
        }

        .progress-bar-container {
            position: relative;
            width: 100%;
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .progress-bar-container:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .progress-pattern {
            position: absolute;
            inset: 0;
            background-image: repeating-linear-gradient(45deg, transparent, transparent 2px, rgba(16, 185, 129, 0.05) 2px, rgba(16, 185, 129, 0.05) 4px);
            pointer-events: none;
        }

        .shimmer-effect {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            animation: shimmer 2s infinite;
            pointer-events: none;
        }

        .glowing-edge {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.8), transparent);
            pointer-events: none;
        }

        .remaining-progress {
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            background: white;
            border-radius: 0 4px 4px 0;
            transition: width 0.3s ease;
        }

        .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 0.75rem;
            font-weight: bold;
            color: white;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            z-index: 10;
        }

        @media (max-width: 768px) {
            .feature-title {
                font-size: 2rem;
            }

            .feature-subtitle {
                font-size: 1rem;
                padding: 1rem 1.5rem;
            }

            .icon-container {
                width: 3.2rem;
                height: 3.2rem;
            }

            .bolt-icon {
                font-size: 1.4rem;
            }

            .title-container {
                gap: 0.8rem;
            }

            .header-section {
                padding-top: 1rem;
            }

            /* Bintang di kiri dan kanan judul untuk mobile */
            .header-section > div:nth-child(2) {
                left: 20% !important;
                font-size: 0.7rem !important;
            }
            .header-section > div:nth-child(3) {
                right: 20% !important;
                font-size: 0.7rem !important;
            }
        }

        @media (max-width: 480px) {
            .feature-title {
                font-size: 1.8rem;
            }

            .feature-subtitle {
                font-size: 0.9rem;
                padding: 0.8rem 1.2rem;
            }

            .icon-container {
                width: 3rem;
                height: 3rem;
            }

            .bolt-icon {
                font-size: 1.3rem;
            }

            .title-container {
                gap: 0.6rem;
            }

            /* Bintang di kiri dan kanan judul untuk mobile kecil */
            .header-section > div:nth-child(2) {
                left: 15% !important;
                font-size: 0.6rem !important;
            }
            .header-section > div:nth-child(3) {
                right: 15% !important;
                font-size: 0.6rem !important;
            }
        }

        .fitur-quiz-wrapper {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 2.2rem;
            margin-bottom: 2.2rem;
            position: relative;
            z-index: 1;
        }

        .fitur-quiz-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1.7rem;
            width: 100%;
            max-width: 1400px;
            justify-items: center;
            position: relative;
            z-index: 1;
        }

        .fitur-card {
            width: 100%;
            max-width: 320px;
            min-width: 220px;
            margin: 0 auto;
            border-radius: 2.2rem;
            padding: 2.2rem 1.2rem;
            position: relative;
            z-index: 1;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            animation: cardFadeIn 0.8s ease-out;
        }

        .fitur-card:nth-child(1) { animation-delay: 0.2s; }
        .fitur-card:nth-child(2) { animation-delay: 0.4s; }
        .fitur-card:nth-child(3) { animation-delay: 0.6s; }
        .fitur-card:nth-child(4) { animation-delay: 0.8s; }

        @keyframes cardFadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fitur-card.harian,
        .fitur-card.teka {
            background: rgba(255, 255, 255, 0.82);
            box-shadow: 0 8px 32px 0 rgba(80, 80, 200, 0.10);
            backdrop-filter: blur(2px);
        }

        .fitur-card.harian:hover,
        .fitur-card.teka:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 50px 0 rgba(80, 80, 200, 0.18);
        }

        .fitur-card.boss {
            background: rgba(251, 191, 36, 0.10);
            box-shadow: 0 8px 32px 0 rgba(251, 191, 36, 0.13);
        }

        .fitur-card.boss:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 50px 0 rgba(251, 191, 36, 0.22);
        }

        .fitur-card.teman {
            background: rgba(22, 22, 22, 0.13);
            filter: brightness(0.85) blur(0.5px);
            opacity: 0.7;
        }

        .fitur-card.teman:hover {
            transform: translateY(-6px);
            filter: brightness(0.95) blur(0.2px);
            opacity: 0.85;
        }

        @media (max-width: 1200px) {
            .fitur-quiz-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 700px) {
            .fitur-quiz-grid {
                grid-template-columns: 1fr;
            }

            .fitur-card {
                max-width: 95vw;
            }
        }

        .quiz-title {
            display: block;
            font-weight: 700;
            color: #2563eb;
            font-size: 1.05rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 90%;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 1;
        }

        .header-section {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            z-index: 1;
            padding-top: 2rem;
            animation: fadeInUp 1.2s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .title-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
            position: relative;
        }

        .title-container::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: -1;
            animation: titleGlow 5s ease-in-out infinite;
        }

        @keyframes titleGlow {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 0.7;
                transform: scale(1.15);
            }
        }

        .feature-title {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 700;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #fff, #f0f8ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .feature-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, transparent, #ffd700, transparent);
            border-radius: 2px;
            animation: pulse 2s ease-in-out infinite;
        }

        .feature-subtitle {
            font-size: 1.1rem;
            color: white;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 1.5rem 2rem;
            border-radius: 1.2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
            letter-spacing: 0.3px;
        }

        .feature-subtitle::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            animation: shimmer-subtitle 4s infinite;
        }

        .sparkles {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .sparkle {
            position: absolute;
            color: #ffd700;
            font-size: 1rem;
            animation: sparkle 2s ease-in-out infinite;
        }

        .sparkle:nth-child(1) {
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }

        .sparkle:nth-child(2) {
            top: 20%;
            right: 15%;
            animation-delay: 0.5s;
        }

        .sparkle:nth-child(3) {
            bottom: 30%;
            left: 10%;
            animation-delay: 1s;
        }

        .sparkle:nth-child(4) {
            bottom: 15%;
            right: 20%;
            animation-delay: 1.5s;
        }

        .sparkle:nth-child(5) {
            top: 50%;
            left: 5%;
            animation-delay: 2s;
        }

        .sparkle:nth-child(6) {
            top: 60%;
            right: 8%;
            animation-delay: 2.5s;
        }

        .icon-container {
            background: linear-gradient(135deg, #ffd700, #ffed4a);
            width: 4rem;
            height: 4rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
            position: relative;
            animation: glow 2s ease-in-out infinite, pulse 3s ease-in-out infinite;
            border: 3px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .icon-container::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            background: linear-gradient(45deg, #ffd700, #ff6b6b, #4ecdc4, #45b7d1);
            border-radius: 50%;
            z-index: -1;
            animation: gradientShift 3s ease infinite;
            opacity: 0.7;
        }

        .icon-container::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            right: 2px;
            bottom: 2px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            border-radius: 50%;
            pointer-events: none;
        }

        .icon-container:hover {
            transform: scale(1.1);
            box-shadow: 
                0 15px 50px rgba(236, 72, 153, 0.7),
                0 8px 25px rgba(56, 189, 248, 0.5),
                0 0 40px rgba(236, 72, 153, 0.5),
                inset 0 2px 4px rgba(255, 255, 255, 0.3);
        }

        .icon-container:active {
            transform: scale(0.92);
        }

        /* Animation for icon container on page load */
        .icon-container {
            animation: iconPulse 4s ease-in-out infinite;
        }

        @keyframes iconPulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.03);
            }
        }

        .icon-container:hover {
            animation: none;
        }

        .bolt-icon {
            font-size: 1.5rem;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            animation: sparkle 2s ease-in-out infinite;
        }
















    </style>
</head>

<body>
    <!-- Toggle Button -->
    <button class="toggle-btn" id="toggleBtn">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h2 class="sidebar-title">Status Pengguna</h2>
            <p class="sidebar-subtitle">Lacak progress dan pencapaian Anda</p>
        </div>
        
        <div class="stats-container">
            <!-- Badge Display -->
            <div class="badge-display">
                <span class="badge-icon">🏅</span>
                <div>
                    <div style="font-size: 0.9rem; color: #f59e0b;">{{ Auth::user()->getLevelTitle() }}</div>
                    <div style="font-size: 0.8rem; color: #f59e0b; opacity: 0.8;">Level {{ Auth::user()->getLevel() }}</div>
                </div>
                @if(Auth::user()->getEarnedBadges()->count() > 0)
                <div class="badge-count">{{ Auth::user()->getEarnedBadges()->count() }}</div>
                @endif
            </div>
            
            <!-- Points Display -->
            <div class="points-display">
                <span class="points-icon">⭐</span>
                <div>
                    <div style="font-size: 0.9rem; color: #3b82f6;">{{ number_format(Auth::user()->getTotalPoints()) }}</div>
                    <div style="font-size: 0.8rem; color: #3b82f6; opacity: 0.8;">Poin</div>
                </div>
            </div>
            
            <!-- Experience Display -->
            <div class="experience-display">
                <div class="exp-header">
                    <span class="exp-icon">📈</span>
                    <div style="flex: 1;">
                        <div class="exp-info">
                            <span class="exp-amount">{{ number_format(Auth::user()->userPoint?->experience ?? 0) }} XP</span>
                            <span class="next-level">Level {{ Auth::user()->getLevel() + 1 }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Progress Bar -->
                <div class="progress-bar" onclick="showExpDetails()" title="Klik untuk detail EXP">
                    @php
                        $currentExp = Auth::user()->userPoint?->experience ?? 0;
                        $nextLevelExp = Auth::user()->userPoint?->experience_to_next_level ?? 100;
                        $progressPercentage = $nextLevelExp > 0 ? ($currentExp / $nextLevelExp) * 100 : 0;
                    @endphp
                    <div class="progress-fill" style="width: {{ $progressPercentage }}%"></div>
                    <div class="progress-text">{{ number_format($progressPercentage, 1) }}%</div>
                </div>
                
                <!-- Progress Details -->
                <div class="progress-details">
                    <span>{{ number_format($currentExp) }}/{{ number_format($nextLevelExp) }}</span>
                    <span style="font-weight: 600;">{{ number_format(100 - $progressPercentage, 1) }}% tersisa</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <div
        style="position:sticky;top:0;z-index:10;display:flex;justify-content:space-between;align-items:center;padding:1.2rem 2.5vw 0.5rem 2.5vw;">
        <a href="{{ route('siswa.dashboard') }}"
            style="display:flex;align-items:center;gap:0.7rem;background:rgba(255,255,255,0.8);padding:0.7rem 1.3rem;border-radius:1.2rem;font-weight:700;color:#6366f1;text-decoration:none;box-shadow:0 2px 8px rgba(99,102,241,0.08);font-size:1.1rem;backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.3);transition:all 0.3s ease;"
            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 15px rgba(99,102,241,0.15)'" 
            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(99,102,241,0.08)'">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Home
        </a>
        <div
            style="display:flex;align-items:center;gap:0.7rem;background:rgba(255,255,255,0.8);padding:0.7rem 1.3rem;border-radius:1.2rem;font-weight:700;color:#6366f1;box-shadow:0 2px 8px rgba(99,102,241,0.08);font-size:1.1rem;backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.3);">
            <i class="fa-solid fa-user-circle"></i> {{ Auth::user()->name ?? 'User' }}
        </div>
    </div>



    <div class="animated-bg"></div>

    <div class="particles" id="particles"></div>

    <div class="main-content" id="mainContent" style="position:relative;z-index:1;">
        <div class="container">
            <div class="header-section" style="position:relative;z-index:1;">
                <div class="sparkles">
                    <i class="sparkle fa-solid fa-star"></i>
                    <i class="sparkle fa-solid fa-star"></i>
                    <i class="sparkle fa-solid fa-star"></i>
                    <i class="sparkle fa-solid fa-star"></i>
                    <i class="sparkle fa-solid fa-star"></i>
                    <i class="sparkle fa-solid fa-star"></i>
                </div>

                <div class="title-container" style="position:relative;z-index:2;">
                    <div class="icon-container">
                        <i class="fa-solid fa-bolt bolt-icon"></i>
                    </div>
                    <h1 class="feature-title">
                        Pilih Fitur Quiz
                    </h1>
                </div>

                <div class="feature-subtitle">
                    Asah kemampuanmu lewat kuis yang dibuat langsung oleh gurumu!
                    Setiap soal dirancang sesuai kebutuhan kelas — belajar jadi lebih seru! 🚀
                </div>
            </div>

            <!-- 4 Fitur Quiz -->
            <div class="fitur-quiz-wrapper" style="position:relative;z-index:2;">
                <div class="fitur-quiz-grid" style="position:relative;z-index:2;">
                    <!-- Misi Harian -->
                    <div class="fitur-card harian" style="position:relative;z-index:2;">
                        <div
                            style="background:#38bdf8;width:3.2rem;height:3.2rem;display:flex;align-items:center;justify-content:center;border-radius:1rem;margin-bottom:1.1rem;font-size:2rem;">
                            <span role="img" aria-label="misi">📝</span>
                        </div>
                        <div style="font-weight:900;font-size:1.25rem;color:#2563eb;margin-bottom:0.7rem;">Misi Harian
                        </div>
                        <div
                            style="background:#38bdf8;color:#fff;font-weight:700;padding:0.5rem 1.2rem;border-radius:1rem;margin-bottom:1.1rem;font-size:1rem;">
                            Total: {{ $quizzes->count() }} Quiz</div>
                        @foreach ($quizzes as $quiz)
                            @php
                                $result = $results->get($quiz->id);
                                $gagal = $result && !$result->passed;
                            @endphp
                            @if (!$result || $gagal)
                                <div
                                    style="background:rgba(255,255,255,0.97);border-radius:1rem;padding:1rem;margin-bottom:0.7rem;box-shadow:0 2px 8px rgba(37,99,235,0.08);width:100%;font-size:0.98rem;">
                                    <div class="quiz-title" style="display:flex;align-items:center;gap:0.5rem;">
                                        <span role="img" aria-label="soal">📝</span>
                                        <span style="flex:1;">{{ $quiz->title }}</span>
                                    </div>
                                    @if ($quiz->deadline)
                                        <div style="font-size:0.93rem;color:#64748b;margin-top:0.2rem;">🕒 Deadline:
                                            {{ \Carbon\Carbon::parse($quiz->deadline)->translatedFormat('l, d F Y H:i') }}
                                        </div>
                                    @endif
                                    <div style="font-size:0.93rem;color:#ef4444;margin-top:0.2rem;">🎯 Target Skor:
                                        <b>{{ $quiz->passing_score }}</b>
                                    </div>
                                    
                                    <!-- Reward Info -->
                                    <div style="margin-top:0.4rem;background:linear-gradient(135deg,#fef3c7,#fde68a);border-radius:0.8rem;padding:0.5rem;border:1px solid #f59e0b;">
                                        <div style="display:flex;align-items:center;gap:0.3rem;margin-bottom:0.2rem;">
                                            <span style="font-size:0.9rem;">⭐</span>
                                            <span style="font-size:0.8rem;color:#92400e;font-weight:600;">Reward Poin:</span>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;font-size:0.75rem;color:#92400e;">
                                            <span>Base: 60 poin</span>
                                            <span>Perfect: 120 poin</span>
                                            <span>XP: 80-240</span>
                                        </div>
                                    </div>
                                    
                                    <div style="margin-top:0.4rem;">
                                        <div
                                            style="background:#f1f5f9;color:#64748b;font-weight:700;padding:0.3rem 0.8rem;border-radius:0.8rem;display:inline-block;margin-bottom:0.2rem;">
                                            @if ($gagal)
                                                💪 Coba lagi!
                                            @else
                                                🚀 Siap untuk tantangan?
                                            @endif
                                        </div>
                                        @if (!$result)
                                            <a href="{{ route('quizzes.show', $quiz->id) }}"
                                                style="display:inline-block;margin-top:0.3rem;background:#38bdf8;color:#fff;font-weight:700;padding:0.4rem 1rem;border-radius:0.8rem;text-decoration:none;font-size:0.98rem;"><i
                                                    class="fa-solid fa-rotate-right"></i> KERJAKAN</a>
                                        @elseif($gagal)
                                            <a href="{{ route('quizzes.show', $quiz->id) }}"
                                                style="display:inline-block;margin-top:0.3rem;background:#38bdf8;color:#fff;font-weight:700;padding:0.4rem 1rem;border-radius:0.8rem;text-decoration:none;font-size:0.98rem;"><i
                                                    class="fa-solid fa-rotate-right"></i> COBA LAGI</a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if ($quizzes->filter(fn($quiz) => !$results->has($quiz->id) || ($results->get($quiz->id) && !$results->get($quiz->id)->passed))->count() == 0)
                            <div style="color:#64748b;font-size:0.98rem;margin-top:1.2rem;">Tidak ada quiz harian yang
                                perlu dikerjakan.</div>
                        @endif
                    </div>
                    <!-- Teka-Teki Harian -->
                    <div class="fitur-card teka" style="position:relative;z-index:2;">
                        <div
                            style="background:#a78bfa;width:3.2rem;height:3.2rem;display:flex;align-items:center;justify-content:center;border-radius:1rem;margin-bottom:1.1rem;font-size:2rem;">
                            <span role="img" aria-label="teka-teki">🧩</span>
                        </div>
                        <div style="font-weight:900;font-size:1.25rem;color:#7c3aed;margin-bottom:0.7rem;">Teka-Teki
                            Harian</div>
                        <div
                            style="background:#a78bfa;color:#fff;font-weight:700;padding:0.5rem 1.2rem;border-radius:1rem;margin-bottom:1.1rem;font-size:1rem;">
                            Total: {{ $tekaTekis->count() }} Teka-Teki</div>
                        @foreach ($tekaTekis as $tekaTeki)
                            @php
                                $remedialCount = $tekaTekiRemedialCount[$tekaTeki->id] ?? 0;
                                $result = $tekaTekiResults->get($tekaTeki->id);
                            @endphp
                            @if (
                                !isset($tekaTekiResults[$tekaTeki->id]) ||
                                    ($result && $result->score < ($tekaTeki->passing_score ?? 60) && $remedialCount < 2))
                                <div
                                    style="background:rgba(255,255,255,0.97);border-radius:1rem;padding:1rem;margin-bottom:0.7rem;box-shadow:0 2px 8px rgba(168,85,247,0.08);width:100%;font-size:0.98rem;">
                                    <div class="quiz-title"
                                        style="display:flex;align-items:center;gap:0.5rem;color:#7c3aed;">
                                        <span role="img" aria-label="teka-teki">🧩</span>
                                        <span style="flex:1;">{{ $tekaTeki->title }}</span>
                                    </div>
                                    <div style="font-size:0.93rem;color:#ef4444;margin-top:0.2rem;">🎯 Target Skor:
                                        <b>{{ $tekaTeki->passing_score ?? '-' }}</b>
                                    </div>
                                    
                                    <!-- Reward Info -->
                                    <div style="margin-top:0.4rem;background:linear-gradient(135deg,#e0e7ff,#c7d2fe);border-radius:0.8rem;padding:0.5rem;border:1px solid #6366f1;">
                                        <div style="display:flex;align-items:center;gap:0.3rem;margin-bottom:0.2rem;">
                                            <span style="font-size:0.9rem;">⭐</span>
                                            <span style="font-size:0.8rem;color:#3730a3;font-weight:600;">Reward Poin:</span>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;font-size:0.75rem;color:#3730a3;">
                                            <span>Base: 80 poin</span>
                                            <span>Perfect: 160 poin</span>
                                            <span>XP: 120-360</span>
                                        </div>
                                    </div>
                                    
                                    <div style="margin-top:0.4rem;">
                                        <div
                                            style="background:#f1f5f9;color:#64748b;font-weight:700;padding:0.3rem 0.8rem;border-radius:0.8rem;display:inline-block;margin-bottom:0.2rem;">
                                            @if ($result && $result->score < ($tekaTeki->passing_score ?? 60))
                                                💪 Coba lagi!
                                            @else
                                                🚀 Siap untuk tantangan?
                                            @endif
                                        </div>
                                        @if (!isset($tekaTekiResults[$tekaTeki->id]))
                                            <a href="{{ route('quizzes.show', $tekaTeki->id) }}"
                                                style="display:inline-block;margin-top:0.3rem;background:#a78bfa;color:#fff;font-weight:700;padding:0.4rem 1rem;border-radius:0.8rem;text-decoration:none;font-size:0.98rem;"><i
                                                    class="fa-solid fa-rotate-right"></i> KERJAKAN</a>
                                        @elseif($result && $result->score < ($tekaTeki->passing_score ?? 60) && $remedialCount < 2)
                                            <a href="{{ route('quizzes.show', $tekaTeki->id) }}"
                                                style="display:inline-block;margin-top:0.3rem;background:#a78bfa;color:#fff;font-weight:700;padding:0.4rem 1rem;border-radius:0.8rem;text-decoration:none;font-size:0.98rem;"><i
                                                    class="fa-solid fa-rotate-right"></i> COBA LAGI</a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if ($tekaTekis->filter(fn($tekaTeki) => !isset($tekaTekiResults[$tekaTeki->id]))->count() == 0)
                            <div style="color:#64748b;font-size:0.98rem;margin-top:1.2rem;">Tidak ada teka-teki yang
                                perlu dikerjakan.</div>
                        @endif
                    </div>
                    <!-- Boss Quiz Mingguan -->
                    <div class="fitur-card boss"
                        style="position:relative;z-index:2;{{ !$canAccessBossQuiz ? 'opacity:0.7;' : '' }}">
                        @if (!$canAccessBossQuiz)
                            <div
                                style="position:absolute;inset:0;background:rgba(0,0,0,0.18);border-radius:2.2rem;z-index:1;">
                            </div>
                        @endif
                        <div
                            style="background:#fde68a;width:3.2rem;height:3.2rem;display:flex;align-items:center;justify-content:center;border-radius:1rem;margin-bottom:1.1rem;font-size:2rem;position:relative;z-index:2;">
                            <span role="img" aria-label="boss">👑</span>
                        </div>
                        <div
                            style="font-weight:900;font-size:1.25rem;color:#b45309;margin-bottom:0.7rem;position:relative;z-index:2;">
                            Boss Quiz Mingguan</div>
                        <div
                            style="background:#fde68a;color:#b45309;font-weight:700;padding:0.5rem 1.2rem;border-radius:1rem;margin-bottom:1.1rem;font-size:1rem;position:relative;z-index:2;">
                            Total: {{ $bossQuizzes->count() }} Boss Quiz</div>
                        @foreach ($bossQuizzes as $bossQuiz)
                            @if (!isset($bossQuizResults[$bossQuiz->id]))
                                <div
                                    style="background:rgba(255,255,255,0.97);border-radius:1rem;padding:1rem;margin-bottom:0.7rem;box-shadow:0 2px 8px rgba(251,191,36,0.08);width:100%;font-size:0.98rem;position:relative;z-index:2;">
                                    <div class="quiz-title"
                                        style="display:flex;align-items:center;gap:0.5rem;color:#b45309;">
                                        <span role="img" aria-label="boss">👑</span>
                                        <span style="flex:1;">{{ $bossQuiz->title }}</span>
                                    </div>
                                    <div style="font-size:0.93rem;color:#ef4444;margin-top:0.2rem;">🎯 Target Skor:
                                        <b>{{ $bossQuiz->passing_score ?? '-' }}</b>
                                    </div>
                                    
                                    <!-- Reward Info -->
                                    <div style="margin-top:0.4rem;background:linear-gradient(135deg,#fef3c7,#fde68a);border-radius:0.8rem;padding:0.5rem;border:1px solid #f59e0b;">
                                        <div style="display:flex;align-items:center;gap:0.3rem;margin-bottom:0.2rem;">
                                            <span style="font-size:0.9rem;">⭐</span>
                                            <span style="font-size:0.8rem;color:#92400e;font-weight:600;">Reward Poin:</span>
                                        </div>
                                        <div style="display:flex;justify-content:space-between;font-size:0.75rem;color:#92400e;">
                                            <span>Base: 150 poin</span>
                                            <span>Perfect: 300 poin</span>
                                            <span>XP: 200-600</span>
                                        </div>
                                    </div>
                                    
                                    <div style="margin-top:0.4rem;">
                                        <div
                                            style="background:#f1f5f9;color:#64748b;font-weight:700;padding:0.3rem 0.8rem;border-radius:0.8rem;display:inline-block;margin-bottom:0.2rem;">
                                            🚀 Siap untuk tantangan?</div>
                                        @if ($canAccessBossQuiz)
                                            <a href="{{ route('quizzes.show', $bossQuiz->id) }}"
                                                style="display:inline-block;margin-top:0.3rem;background:#fde68a;color:#b45309;font-weight:700;padding:0.4rem 1rem;border-radius:0.8rem;text-decoration:none;font-size:0.98rem;"><i
                                                    class="fa-solid fa-rotate-right"></i> KERJAKAN</a>
                                        @else
                                            <button
                                                style="display:inline-block;margin-top:0.3rem;background:#fde68a;color:#b45309;font-weight:700;padding:0.4rem 1rem;border-radius:0.8rem;text-decoration:none;cursor:not-allowed;opacity:0.7;font-size:0.98rem;"
                                                disabled>
                                                <span
                                                    style="font-size:1.2rem;vertical-align:middle;margin-right:8px;">🔒</span>
                                                Terkunci
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <!-- Completed Boss Quiz -->
                                <div
                                    style="background:rgba(255,255,255,0.97);border-radius:1rem;padding:1rem;margin-bottom:0.7rem;box-shadow:0 2px 8px rgba(34,197,94,0.08);width:100%;font-size:0.98rem;position:relative;z-index:2;border:2px solid #22c55e;">
                                    <div class="quiz-title"
                                        style="display:flex;align-items:center;gap:0.5rem;color:#16a34a;">
                                        <span role="img" aria-label="completed">✅</span>
                                        <span style="flex:1;">{{ $bossQuiz->title }}</span>
                                        <span style="background:#22c55e;color:white;padding:0.2rem 0.5rem;border-radius:0.5rem;font-size:0.8rem;font-weight:bold;">SELESAI</span>
                                    </div>
                                    <div style="font-size:0.93rem;color:#16a34a;margin-top:0.2rem;">🎯 Skor Anda:
                                        <b>{{ $bossQuizResults[$bossQuiz->id]->score ?? '-' }}</b>
                                    </div>
                                    
                                    <div style="margin-top:0.4rem;background:linear-gradient(135deg,#dcfce7,#bbf7d0);border-radius:0.8rem;padding:0.5rem;border:1px solid #22c55e;">
                                        <div style="display:flex;align-items:center;gap:0.3rem;margin-bottom:0.2rem;">
                                            <span style="font-size:0.9rem;">🏆</span>
                                            <span style="font-size:0.8rem;color:#15803d;font-weight:600;">Boss Quiz Selesai!</span>
                                        </div>
                                        <div style="font-size:0.75rem;color:#15803d;">
                                            Selamat! Anda telah berhasil menyelesaikan boss quiz ini.
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <!-- Boss Quiz section hanya muncul jika ada yang belum dikerjakan -->
                        @if ($bossQuizzes->filter(fn($bossQuiz) => !isset($bossQuizResults[$bossQuiz->id]))->count() > 0)
                            <!-- Boss quiz yang belum dikerjakan akan ditampilkan di atas -->
                        @endif
                    </div>
                    <!-- Tantang Teman -->
                    <div class="fitur-card teman">
                        <div
                            style="background:#6ee7b7;width:3.2rem;height:3.2rem;display:flex;align-items:center;justify-content:center;border-radius:1rem;margin-bottom:1.1rem;font-size:2rem;">
                            <span role="img" aria-label="teman">🧑‍🤝‍🧑</span>
                        </div>
                        <div style="font-weight:900;font-size:1.25rem;color:#047857;margin-bottom:0.7rem;">Tantang
                            Teman
                        </div>
                        <div
                            style="background:#6ee7b7;color:#fff;font-weight:700;padding:0.5rem 1.2rem;border-radius:1rem;margin-bottom:1.1rem;font-size:1rem;">
                            Segera Hadir</div>
                        <div style="color:#64748b;font-size:0.98rem;">Adu kemampuan dengan teman-temanmu!</div>
                        <button
                            style="margin-top:1.1rem;background:#e5e7eb;color:#6b7280;font-weight:700;padding:0.5rem 1.2rem;border-radius:1rem;cursor:not-allowed;border:none;font-size:0.98rem;">Coming
                            Soon</button>
                    </div>
                </div>
            </div>

            <!-- Info Ringkas Quiz -->
            <div
                style="max-width:900px;margin:0 auto 2.5rem auto;text-align:center;background:rgba(255,255,255,0.7);border-radius:18px;padding:1.7rem 1.2rem 1.4rem 1.2rem;box-shadow:0 2px 12px rgba(80,80,200,0.08);position:relative;z-index:1;backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,0.3);transition:all 0.3s ease;"
                onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 25px rgba(80,80,200,0.15)'" 
                onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 12px rgba(80,80,200,0.08)'">
                <div style="font-size:1.25rem;font-weight:700;color:#4f46e5;margin-bottom:0.7rem;">Info Quiz Kamu</div>
                <div style="display:flex;justify-content:center;gap:2.5rem;flex-wrap:wrap;font-size:1.13rem;">
                    <div><span style="font-weight:700;color:#2563eb;">Total Quiz:</span>
                        {{ $jumlahQuizHarian + $jumlahTekaTeki + $jumlahBossQuiz }}</div>
                    <div><span style="font-weight:700;color:#38bdf8;">Quiz Harian:</span> {{ $jumlahQuizHarian }}
                    </div>
                    <div><span style="font-weight:700;color:#a78bfa;">Teka-Teki:</span> {{ $jumlahTekaTeki }}</div>
                    <div><span style="font-weight:700;color:#fde68a;">Boss Quiz:</span> {{ $jumlahBossQuiz }}</div>
                    <div><span style="font-weight:700;color:#22c55e;">Quiz Selesai:</span>
                        {{ $results->filter(fn($r) => $r->passed)->count() }}</div>
                </div>
            </div>

            <!-- Tombol Lihat Semua Quiz -->
            <div style="text-align:center;margin-bottom:2.5rem;position:relative;z-index:1;">
                <a href="{{ route('quizzes.index') }}"
                    style="display:inline-block;background:linear-gradient(90deg,#6366f1,#a78bfa);color:#fff;font-weight:700;padding:1.1rem 2.5rem;border-radius:1.7rem;font-size:1.18rem;box-shadow:0 4px 16px rgba(99,102,241,0.13);text-decoration:none;transition:all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
                    onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 25px rgba(99,102,241,0.25)'" 
                    onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 16px rgba(99,102,241,0.13)'">
                    <i class="fa-solid fa-list-ul" style="margin-right:0.7rem;"></i> Lihat Semua Quiz
                </a>
            </div>
        </div>
    </div>



    <script>
        // Create floating particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Random size
                const size = Math.random() * 4 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';

                // Random position
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';

                // Random animation delay
                particle.style.animationDelay = Math.random() * 6 + 's';

                particlesContainer.appendChild(particle);
            }
        }

        // Initialize particles
        createParticles();

        // Create interactive stars
        function createInteractiveStars() {
            const starField = document.getElementById('star-field');
            if (!starField) return;
            
            // Clear existing stars
            starField.innerHTML = '';
            
            // Create many small stars
            const STAR_COUNT = 25;
            for (let i = 0; i < STAR_COUNT; i++) {
                const star = document.createElement('span');
                star.className = 'star-animated';
                star.innerHTML = '⭐';
                
                // Random position around header
                const top = Math.random() * 150 + 10; // px
                const left = Math.random() * 95 + 2; // %
                const size = Math.random() * 0.3 + 0.5; // rem
                
                star.style.top = `${top}px`;
                star.style.left = `${left}%`;
                star.style.fontSize = `${size}rem`;
                
                // Random animation delay
                star.style.animationDelay = `${Math.random() * 6}s`;
                
                starField.appendChild(star);
            }
        }

        // Initialize interactive stars
        createInteractiveStars();

        // Add click effect to stars
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('star-animated')) {
                const star = e.target;
                star.style.transform = 'scale(2) rotate(720deg)';
                star.style.filter = 'drop-shadow(0 0 15px #fbbf24)';
                
                // Create ripple effect
                const ripple = document.createElement('div');
                ripple.style.position = 'absolute';
                ripple.style.left = '50%';
                ripple.style.top = '50%';
                ripple.style.width = '0';
                ripple.style.height = '0';
                ripple.style.background = 'rgba(251, 191, 36, 0.2)';
                ripple.style.borderRadius = '50%';
                ripple.style.transform = 'translate(-50%, -50%)';
                ripple.style.pointerEvents = 'none';
                ripple.style.zIndex = '1000';
                ripple.style.animation = 'ripple 1s ease-out';
                
                star.appendChild(ripple);
                
                setTimeout(() => {
                    star.style.transform = '';
                    star.style.filter = '';
                    if (ripple.parentNode) {
                        ripple.parentNode.removeChild(ripple);
                    }
                }, 1000);
            }
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                0% {
                    width: 0;
                    height: 0;
                    opacity: 1;
                }
                50% {
                    width: 40px;
                    height: 40px;
                    opacity: 0.6;
                }
                100% {
                    width: 80px;
                    height: 80px;
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Add interactive effects
        document.addEventListener('mousemove', (e) => {
            const particles = document.querySelectorAll('.particle');
            particles.forEach((particle, index) => {
                if (index % 3 === 0) {
                    const rect = particle.getBoundingClientRect();
                    const centerX = rect.left + rect.width / 2;
                    const centerY = rect.top + rect.height / 2;

                    const deltaX = (e.clientX - centerX) * 0.01;
                    const deltaY = (e.clientY - centerY) * 0.01;

                    particle.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
                }
            });
        });

        // Add click effect to icon
        document.querySelector('.icon-container').addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });

        // Sidebar functionality
        let sidebarOpen = false;

        function toggleSidebar(event) {
            // Prevent default behavior and stop propagation
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleBtn = document.getElementById('toggleBtn');
            const overlay = document.getElementById('overlay');
            
            sidebarOpen = !sidebarOpen;
            
            if (sidebarOpen) {
                // Open sidebar
                sidebar.classList.add('open');
                mainContent.classList.add('sidebar-open');
                toggleBtn.classList.add('sidebar-open');
                overlay.classList.add('show');
            } else {
                // Close sidebar
                sidebar.classList.remove('open');
                mainContent.classList.remove('sidebar-open');
                toggleBtn.classList.remove('sidebar-open');
                overlay.classList.remove('show');
            }
        }

        function closeSidebar(event) {
            // Prevent default behavior and stop propagation
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const toggleBtn = document.getElementById('toggleBtn');
            const overlay = document.getElementById('overlay');
            
            sidebar.classList.remove('open');
            mainContent.classList.remove('sidebar-open');
            toggleBtn.classList.remove('sidebar-open');
            overlay.classList.remove('show');
            sidebarOpen = false;
        }

        // Initialize sidebar
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-open sidebar after 2 seconds for demo
            setTimeout(() => {
                if (!sidebarOpen) {
                    toggleSidebar();
                }
            }, 2000);
            
            // Update progress bar animation
            const progressFill = document.querySelector('.progress-fill');
            if (progressFill) {
                const currentWidth = progressFill.style.width;
                progressFill.style.width = '0%';
                
                setTimeout(() => {
                    progressFill.style.width = currentWidth;
                }, 500);
            }
            
            // Add event listeners to prevent path changes
            const toggleBtn = document.getElementById('toggleBtn');
            const overlay = document.getElementById('overlay');
            
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar(e);
                });
            }
            
            if (overlay) {
                overlay.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    closeSidebar(e);
                });
            }
        });

        // EXP Details Function
        function showExpDetails() {
            const currentExp = {{ Auth::user()->userPoint?->experience ?? 0 }};
            const nextLevelExp = {{ Auth::user()->userPoint?->experience_to_next_level ?? 100 }};
            const currentLevel = {{ Auth::user()->getLevel() }};
            const progressPercentage = {{ (Auth::user()->userPoint?->experience ?? 0) > 0 && (Auth::user()->userPoint?->experience_to_next_level ?? 100) > 0 ? ((Auth::user()->userPoint?->experience ?? 0) / (Auth::user()->userPoint?->experience_to_next_level ?? 100)) * 100 : 0 }};
            
            alert(`Detail EXP:\n\nCurrent Level: ${currentLevel}\nCurrent XP: ${currentExp.toLocaleString()}\nNext Level XP: ${nextLevelExp.toLocaleString()}\nProgress: ${progressPercentage.toFixed(1)}%\n\nKeep learning to reach the next level!`);
        }

        // Create floating particles for background
        function createBackgroundParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');

                // Random size
                const size = Math.random() * 4 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';

                // Random position
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';

                // Random animation delay
                particle.style.animationDelay = Math.random() * 6 + 's';

                particlesContainer.appendChild(particle);
            }
        }

        // Initialize background particles
        createBackgroundParticles();




    </script>
</body>

</html>
