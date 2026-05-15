<?php
require_once 'config.php';
?>
<!DOCTYPE html>

<html class="scroll-smooth" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>EDPS Studio | Capturing the Soul</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400&family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "primary-fixed": "#e7d8c9",
              "surface-dim": "#d7ccc8",
              "tertiary-container": "#5d4037",
              "background": "#fdfaf7",
              "on-background": "#2c1a12",
              "inverse-primary": "#d7ccc8",
              "on-primary-fixed-variant": "#4e342e",
              "on-background": "#2c1a12",
              "inverse-primary": "#d7ccc8",
              "on-secondary-fixed-variant": "#5d4037",
              "on-primary": "#ffffff",
              "secondary-fixed": "#efebe9",
              "error": "#ba1a1a",
              "outline": "#8d6e63",
              "outline-variant": "#d7ccc8",
              "primary": "#3e2723",
              "on-error-container": "#93000a",
              "on-tertiary-fixed-variant": "#4e342e",
              "tertiary": "#5d4037",
              "surface-container-highest": "#efebe9",
              "on-tertiary-container": "#d7ccc8",
              "on-surface": "#2c1a12",
              "on-secondary": "#ffffff",
              "surface": "#fdfaf7",
              "surface-variant": "#f3e5f5",
              "on-tertiary-fixed": "#2c1a12",
              "on-primary-container": "#a1887f",
              "on-primary-fixed": "#1b0000",
              "surface-container-lowest": "#ffffff",
              "inverse-on-surface": "#fdfaf7",
              "tertiary-fixed-dim": "#d7ccc8",
              "surface-container-low": "#faf3ed",
              "primary-container": "#4e342e",
              "tertiary-fixed": "#efebe9",
              "surface-container": "#f5ece5",
              "on-secondary-fixed": "#1b0000",
              "secondary": "#795548",
              "surface-bright": "#fdfaf7",
              "inverse-surface": "#2c1a12",
              "surface-container-high": "#efebe9",
              "on-error": "#ffffff",
              "primary-fixed-dim": "#d7ccc8",
              "on-secondary-container": "#5d4037",
              "on-tertiary": "#ffffff",
              "surface-tint": "#5d4037",
              "error-container": "#ffdad6",
              "secondary-container": "#d7ccc8",
              "on-surface-variant": "#4e342e",
              "secondary-fixed-dim": "#bcaaa4"
            },
            fontFamily: {
              "headline": ["Noto Serif"],
              "body": ["Manrope"],
              "label": ["Manrope"]
            },
            borderRadius: {"DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem"},
          },
        },
      }
    </script>
<style>
      .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      }
      .material-symbols-outlined.filled {
        font-variation-settings: 'FILL' 1;
      }
      .glass-nav {
        background: rgba(253, 250, 247, 0.8);
        backdrop-filter: blur(20px);
      }
      .dark .glass-nav {
        background: rgba(18, 16, 14, 0.8);
      }
      .editorial-shadow {
        box-shadow: 0 40px 80px -20px rgba(62, 39, 35, 0.08);
      }
      .dark .editorial-shadow {
        box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.3);
      }
      .no-scrollbar::-webkit-scrollbar {
        display: none;
      }
      .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
      }
      /* Social Media Icon Brand Colors */
      .instagram-icon {
        background: linear-gradient(135deg, #833ab4 0%, #fd1d1d 25%, #fcaf45 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        fill: url(#instagramGradient);
      }
      .dark .instagram-icon {
        background: linear-gradient(135deg, #833ab4 0%, #fd1d1d 25%, #fcaf45 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }
      .instagram-icon path {
        fill: url(#instagramGradient);
      }
      svg .instagram-icon {
        fill: url(#instagramGradient) !important;
      }
      /* Facebook Brand Color */
      .dark .facebook-icon,
      .facebook-icon {
        color: #1877F2;
      }
      .facebook-icon path {
        fill: #1877F2;
      }
      /* TikTok Brand Color */
      .tiktok-icon {
        filter: drop-shadow(-2px -1px 0px #25f4ee) drop-shadow(2px 1px 0px #fe2c55);
      }
      /* Review Track Animation */
      @keyframes scroll-reviews {
        0% {
          transform: translateX(0);
        }
        100% {
          transform: translateX(-50%);
        }
      }
      .review-track {
        display: flex;
        gap: 3rem;
        width: max-content;
        animation: scroll-reviews 10s linear infinite;
      }
      .review-track:hover {
        animation-play-state: paused;
      }
      .review-card {
        width: 400px;
        min-width: 400px;
        flex-shrink: 0;
        border: 0.5px solid #C5A059;
      }
      .dark .review-card {
        border-color: #C5A059;
      }
      /* Package Card Styling */
      .package-card {
        height: 100%;
        min-height: 600px;
        display: flex;
        flex-direction: column;
      }
      /* Force checkmarks to be visible with gold/ivory color */
      .package-card .material-symbols-outlined.check {
        color: #C5A059 !important;
        font-variation-settings: 'FILL' 1;
      }
      .dark .package-card .material-symbols-outlined.check {
        color: #F5F5F0 !important;
        font-variation-settings: 'FILL' 1;
      }
      /* Package card hover effects */
      .package-card-hover {
        transition: all 500ms ease;
      }
      .package-card-hover:hover {
        transform: scale(1.02) translateY(-4px);
        box-shadow: 0 0 40px rgba(197, 160, 89, 0.25);
      }
      .package-card {
        border: 0.5px solid #C5A059;
      }
      .dark .package-card {
        border-color: #C5A059;
      }
      /* Lock text color in 'The Latest' section */
      .latest-item h3,
      .latest-item .text-secondary {
        color: inherit !important;
      }
      .dark .latest-item h3 {
        color: #F5F5F0 !important;
      }
      .dark .latest-item .text-secondary {
        color: #D1CDC7 !important;
      }
      .latest-item:hover h3 {
        color: inherit !important;
      }
      /* Announcements Carousel Styling */
      .announcementsSwiper {
        overflow: visible;
      }
      .announcementsSwiper .swiper-slide {
        padding: 0 12px;
      }
      .announcements-pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        margin-top: 24px;
      }
      .announcements-pagination .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background-color: #D1CDC7;
        opacity: 0.5;
        transition: all 300ms ease;
      }
      .announcements-pagination .swiper-pagination-bullet-active {
        background-color: #C5A059;
        opacity: 1;
        box-shadow: 0 0 8px rgba(197, 160, 89, 0.6);
      }
      .dark .announcements-pagination .swiper-pagination-bullet {
        background-color: #D1CDC7;
      }
      .dark .announcements-pagination .swiper-pagination-bullet-active {
        background-color: #C5A059;
      }
      /* Active Navigation Link Indicator */
      .nav-link {
        position: relative;
        transition: color 300ms ease;
      }
      .nav-link.active {
        color: #C5A059 !important;
      }
      .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 6px;
        height: 6px;
        background-color: #C5A059;
        border-radius: 50%;
        box-shadow: 0 0 8px rgba(197, 160, 89, 0.6);
      }
      /* TikTok icon container fix */
      .social-icon-container {
        overflow: visible;
        padding: 0;
      }
      @keyframes fall {
        0% {
          transform: translateY(-100vh) rotate(0deg);
          opacity: 0;
        }
        10% {
          opacity: 1;
        }
        90% {
          opacity: 1;
        }
        100% {
          transform: translateY(100vh) rotate(360deg);
          opacity: 0;
        }
      }
      .falling {
        position: absolute;
        z-index: -1;
        animation: fall linear infinite;
        pointer-events: none;
      }
      /* Mobile Sidebar */
      .mobile-sidebar {
        position: fixed;
        right: 0;
        top: 0;
        height: 100vh;
        width: 80%;
        max-width: 320px;
        background: #fdfaf7;
        box-shadow: -4px 0 12px rgba(44, 26, 18, 0.2);
        z-index: 40;
        transform: translateX(100%);
        transition: transform 300ms ease-in-out;
      }
      .dark .mobile-sidebar {
        background: #12100E;
        box-shadow: -4px 0 12px rgba(0, 0, 0, 0.5);
      }
      .mobile-sidebar.open {
        transform: translateX(0);
      }
      .mobile-sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        pointer-events: none;
        z-index: 30;
        transition: opacity 300ms ease-in-out;
      }
      .mobile-sidebar-overlay.open {
        opacity: 1;
        pointer-events: auto;
      }
      /* Portfolio Carousel Styles */
      .portfolio-grid {
        display: grid;
        opacity: 1;
        transition: opacity 400ms ease-in-out;
        pointer-events: auto;
      }
      .portfolio-grid.hidden {
        display: none;
        opacity: 0;
        pointer-events: none;
      }
      .portfolio-carousel {
        opacity: 1;
        transition: opacity 400ms ease-in-out;
        pointer-events: auto;
      }
      .portfolio-carousel.hidden {
        display: none;
        opacity: 0;
        pointer-events: none;
      }
      .swiper-coverflow {
        padding: 40px 0;
      }
      .swiper-coverflow .swiper-slide {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 500px;
        aspect-ratio: 1 / 1;
        opacity: 0.5;
        transition: opacity 300ms ease-in-out;
        margin: 0;
      }
      /* Mobile Square Fix - Responsive Height */
      @media (max-width: 768px) {
        .swiper-coverflow .swiper-slide {
          height: 300px;
        }
      }
      @media (max-width: 640px) {
        .swiper-coverflow .swiper-slide {
          height: 250px;
        }
      }
      .swiper-coverflow .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        aspect-ratio: 1 / 1;
        border-radius: 0.125rem;
        box-shadow: 0 40px 80px -20px rgba(62, 39, 35, 0.08);
        margin: 0;
      }
      .swiper-coverflow .swiper-slide-active {
        opacity: 1;
      }
      .swiper-coverflow .swiper-slide-prev,
      .swiper-coverflow .swiper-slide-next {
        opacity: 0.5;
      }
      .swiper-coverflow .swiper-slide-active img {
        border: 4px solid #C5A059;
        box-shadow: 0 0 40px rgba(197, 160, 89, 0.4);
      }
      .dark .swiper-coverflow .swiper-slide-active img {
        border: 4px solid #F5F5F0;
        box-shadow: 0 0 40px rgba(245, 245, 240, 0.3);
      }
      .carousel-controls {
        display: flex;
        justify-content: center;
        gap: 16px;
        margin-top: 24px;
      }
      .carousel-btn {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: white;
        dark:background: #3a2a21;
        border: 1px solid #d7ccc8;
        dark:border-color: #5d4037;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 300ms ease;
        color: #3e2723;
        dark:color: #D1CDC7;
      }
      .carousel-btn:hover {
        background: #3e2723;
        color: white;
        dark:background: #5d4037;
      }
      .carousel-slide-title {
        text-align: center;
        margin-top: 16px;
        font-family: 'Noto Serif';
        font-size: 28px;
        color: #2c1a12;
        dark:color: #F5F5F0;
        font-weight: 400;
      }
      /* Studio Paper Texture Overlay */
      body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
          repeating-linear-gradient(
            0deg,
            transparent,
            transparent 2px,
            rgba(44, 26, 18, 0.03) 2px,
            rgba(44, 26, 18, 0.03) 4px
          ),
          repeating-linear-gradient(
            90deg,
            transparent,
            transparent 2px,
            rgba(44, 26, 18, 0.02) 2px,
            rgba(44, 26, 18, 0.02) 4px
          );
        pointer-events: none;
        z-index: 1;
      }
      .dark body::before {
        background-image: 
          repeating-linear-gradient(
            0deg,
            transparent,
            transparent 2px,
            rgba(255, 255, 255, 0.02) 2px,
            rgba(255, 255, 255, 0.02) 4px
          ),
          repeating-linear-gradient(
            90deg,
            transparent,
            transparent 2px,
            rgba(255, 255, 255, 0.015) 2px,
            rgba(255, 255, 255, 0.015) 4px
          );
      }
      /* Scroll Reveal Animation */
      @keyframes scrollReveal {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      .scroll-reveal {
        opacity: 0;
        transform: translateY(20px);
        animation: scrollReveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
      }
      /* Enhanced navbar link hover scale */
      .nav-link {
        position: relative;
        transition: color 300ms ease, transform 300ms cubic-bezier(0.16, 1, 0.3, 1);
      }
      .nav-link:hover {
        transform: scale(1.05);
      }
      .nav-link.active {
        color: #C5A059 !important;
      }
      .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 6px;
        height: 6px;
        background-color: #C5A059;
        border-radius: 50%;
        box-shadow: 0 0 8px #C5A059;
        animation: glowPulse 2s ease-in-out infinite;
      }
      @keyframes glowPulse {
        0%, 100% {
          box-shadow: 0 0 8px #C5A059, 0 0 16px rgba(197, 160, 89, 0.3);
        }
        50% {
          box-shadow: 0 0 12px #C5A059, 0 0 24px rgba(197, 160, 89, 0.5);
        }
      }

    </style>
</head>
<body class="bg-background dark:bg-[#12100E] text-on-surface dark:text-[#D1CDC7] font-body selection:bg-primary-fixed selection:text-on-primary-fixed dark:selection:bg-[#5d4037] dark:selection:text-[#12100E]">
<nav class="fixed top-0 w-full z-50 bg-[#fdfaf7]/80 dark:bg-[#301f17]/80 backdrop-blur-xl shadow-sm shadow-[#2c1a12]/5 dark:shadow-[#000]/20">
<div class="flex justify-between items-center px-6 md:px-12 py-6 max-w-screen-2xl mx-auto flex-row">
<div class="text-2xl font-serif italic text-[#3e2723] dark:text-[#F5F5F0]">EDPS Studio</div>
<div class="hidden md:flex items-center gap-8 font-['Noto_Serif'] font-light tracking-tight">
<a class="nav-link text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#home">Home</a>
<a class="nav-link text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#reviews">Reviews</a>
<a class="nav-link text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#announcements">Announcements</a>
<a class="nav-link text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#portfolio">Portfolio</a>
<a class="nav-link text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#packages">Packages</a>
<a class="nav-link text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#about">About</a>
<a class="nav-link text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#contact">Contact</a>
</div>
<div class="flex items-center gap-3 sm:gap-4">
<button id="themeToggle" aria-label="Toggle Dark Mode" class="text-[#795548] dark:text-[#C5A059] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300 flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full hover:bg-surface-container dark:hover:bg-[#2C1A12]">
<span class="material-symbols-outlined text-xl sm:text-2xl">dark_mode</span>
</button>
<a href="login.php" aria-label="Staff Login" class="text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300 flex items-center gap-2 hidden md:flex w-10 h-10 sm:w-12 sm:h-12 rounded-full hover:bg-surface-container dark:hover:bg-[#2C1A12] justify-center">
<span class="material-symbols-outlined text-xl sm:text-2xl">person</span>
</a>
<button id="mobileMenuToggle" aria-label="Toggle Mobile Menu" class="text-[#795548] dark:text-[#C5A059] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300 md:hidden flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 rounded-full hover:bg-surface-container dark:hover:bg-[#2C1A12]">
<span class="material-symbols-outlined text-xl sm:text-2xl">menu</span>
</button>
</div>
</div>
</nav>
<!-- Mobile Sidebar Overlay -->
<div id="mobileMenuOverlay" class="mobile-sidebar-overlay"></div>
<!-- Mobile Sidebar -->
<div id="mobileSidebar" class="mobile-sidebar">
<div class="flex justify-between items-center px-6 py-6 border-b border-outline-variant dark:border-[#5d4037]">
<span class="text-lg font-serif italic text-[#3e2723] dark:text-[#F5F5F0]">Menu</span>
<button id="mobileMenuClose" aria-label="Close Mobile Menu" class="text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300 flex items-center">
<span class="material-symbols-outlined text-xl">close</span>
</button>
</div>
<div class="flex flex-col p-6 space-y-6 font-['Noto_Serif'] font-light tracking-tight">
<a class="nav-link text-lg text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#home">Home</a>
<a class="nav-link text-lg text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#reviews">Reviews</a>
<a class="nav-link text-lg text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#announcements">Announcements</a>
<a class="nav-link text-lg text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#portfolio">Portfolio</a>
<a class="nav-link text-lg text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#packages">Packages</a>
<a class="nav-link text-lg text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#about">About</a>
<a class="nav-link text-lg text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300" href="#contact">Contact</a>
</div>
<div class="border-t border-outline-variant dark:border-[#5d4037] px-6 py-6">
<a href="login.php" class="flex items-center gap-3 text-[#795548] dark:text-[#D1CDC7] hover:text-[#3e2723] dark:hover:text-[#F5F5F0] transition-colors duration-300">
<span class="material-symbols-outlined text-xl">person</span>
<span class="font-label text-sm uppercase tracking-widest">Staff Login</span>
</a>
</div>
</div>
<main>
<section class="relative h-screen flex items-center justify-center overflow-hidden" id="home">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" data-alt="Cinematic artistic portrait with soft lighting" src="https://scontent.fmnl44-1.fna.fbcdn.net/v/t1.6435-9/180213608_3784252291679723_1672327313611677638_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=2a1932&_nc_eui2=AeEc_adCxRghzopFv2EL7CqxRRLi41aWU6hFEuLjVpZTqH3B2ih9UKlO1ZtQfnnhrawCM2R3sGo8nLyVr98CFB6A&_nc_ohc=MqPR_hYhxJwQ7kNvwE99QxT&_nc_oc=AdrUcuxv4gp8kORgHbUm9QxCIBVRacnyQcC_jQkpZG35foiRp6lAi9I7Y7_0hjZLsA05E1_NdGct3h77Ixjv3bvm&_nc_zt=23&_nc_ht=scontent.fmnl44-1.fna&_nc_gid=_1Svdr7zFFmDONKUWcigjg&_nc_ss=7a32e&oh=00_AfxcpHVwi5Y63QpIBWXYXgbSFj6MMZ8Uz4scOf25NZkvTw&oe=69E8B2A4"/>
<div class="absolute inset-0 bg-primary/20 mix-blend-multiply"></div>
<div class="absolute inset-0 bg-gradient-to-b from-transparent via-background/20 dark:via-[#12100E]/20 to-background dark:to-[#12100E]"></div>
<div class="absolute inset-0 bg-gradient-to-t from-[#12100E] via-transparent to-transparent"></div>
</div>
<div class="relative z-10 text-center px-6">
<p class="font-label tracking-[0.3em] uppercase text-primary mb-6"></p>
<h1 class="font-headline text-4xl sm:text-6xl md:text-8xl lg:text-9xl text-on-surface dark:text-[#F5F5F0] leading-tight mb-8">Art. Love. <br/><span class="italic font-light">Passion.</span></h1>
<div class="flex flex-col md:flex-row gap-6 justify-center items-center">
<a class="text-primary font-label border-b border-primary/30 pb-1 hover:border-primary transition-all" href="#about"></a>
</div>
</div>
</section>

<section class="py-12 sm:py-16 md:py-24 px-6 md:px-12 bg-background dark:bg-[#12100E] border-t border-primary/5 dark:border-primary/20" id="reviews">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="font-label text-[#C5A059] dark:text-[#C5A059] tracking-widest uppercase text-xs">Testimonials</span>
            <h2 class="font-headline text-3xl sm:text-4xl md:text-5xl dark:text-[#F5F5F0] mt-2">Voices of Love</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
            <div class="lg:col-span-1 bg-surface-container dark:bg-[#3a2a21] p-8 editorial-shadow rounded-3xl">
                <h3 class="font-headline text-2xl dark:text-[#F5F5F0] mb-6">Leave a Review</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-secondary dark:text-[#D1CDC7] mb-2">Your Name</label>
                        <input type="text" class="w-full bg-background dark:bg-[#2a1810] border-outline-variant dark:border-[#5d4037] focus:border-primary focus:ring-0 transition-colors p-3 text-sm" placeholder="John Doe">
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-secondary dark:text-[#D1CDC7] mb-2">Rating</label>
                        <div class="flex gap-1 text-primary dark:text-[#F5F5F0]">
                            <span class="material-symbols-outlined cursor-pointer hover:scale-110 transition-transform">star</span>
                            <span class="material-symbols-outlined cursor-pointer hover:scale-110 transition-transform">star</span>
                            <span class="material-symbols-outlined cursor-pointer hover:scale-110 transition-transform">star</span>
                            <span class="material-symbols-outlined cursor-pointer hover:scale-110 transition-transform">star</span>
                            <span class="material-symbols-outlined cursor-pointer hover:scale-110 transition-transform">star</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-widest text-secondary dark:text-[#D1CDC7] mb-2">Comment</label>
                        <textarea rows="4" class="w-full bg-background dark:bg-[#2a1810] border-outline-variant dark:border-[#5d4037] focus:border-primary focus:ring-0 transition-colors p-3 text-sm" placeholder="Share your experience..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-primary text-on-primary py-4 font-label uppercase tracking-widest text-xs hover:bg-tertiary transition-colors rounded-3xl">Post Review</button>
                </form>
            </div>

            <div class="lg:col-span-2 relative">
                <div class="w-full overflow-x-hidden pb-8">
                    <div class="review-track">
                        <!-- Card 1 -->
                        <div class="review-card bg-white dark:bg-[#3a2a21] p-5 sm:p-6 md:p-8 rounded-3xl editorial-shadow border-l-4 border-primary">
                            <div class="flex gap-1 text-primary dark:text-[#e7d8c9] mb-4">
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                            </div>
                            <p class="text-on-surface-variant dark:text-[#D1CDC7] italic font-light leading-relaxed mb-6">"EDPS Studio captured our wedding with such grace. Every photo feels like a still from a movie. Their team was professional yet felt like family."</p>
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center font-bold text-primary">M</div>
                                <div>
                                    <h4 class="font-bold text-sm dark:text-[#F5F5F0]">Maria Clara</h4>
                                    <span class="text-xs text-secondary dark:text-[#a89a8f] italic">Wedding Shoot</span>
                                </div>
                            </div>
                        </div>
                        <!-- Card 2 -->
                        <div class="review-card bg-white dark:bg-[#3a2a21] p-5 sm:p-6 md:p-8 rounded-3xl editorial-shadow border-l-4 border-primary">
                            <div class="flex gap-1 text-primary dark:text-[#e7d8c9] mb-4">
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                            </div>
                            <p class="text-on-surface-variant dark:text-[#D1CDC7] italic font-light leading-relaxed mb-6">"The pre-debut shoot was amazing! They knew exactly how to make me feel comfortable in front of the lens. The results were beyond my expectations."</p>
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center font-bold text-primary">S</div>
                                <div>
                                    <h4 class="font-bold text-sm dark:text-[#F5F5F0]">Sophia Reyes</h4>
                                    <span class="text-xs text-secondary dark:text-[#a89a8f] italic">Debut Package</span>
                                </div>
                            </div>
                        </div>
                        <!-- Duplicate Card 1 for seamless loop -->
                        <div class="review-card bg-white dark:bg-[#3a2a21] p-5 sm:p-6 md:p-8 rounded-3xl editorial-shadow border-l-4 border-primary">
                            <div class="flex gap-1 text-primary dark:text-[#e7d8c9] mb-4">
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                            </div>
                            <p class="text-on-surface-variant dark:text-[#D1CDC7] italic font-light leading-relaxed mb-6">"EDPS Studio captured our wedding with such grace. Every photo feels like a still from a movie. Their team was professional yet felt like family."</p>
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center font-bold text-primary">M</div>
                                <div>
                                    <h4 class="font-bold text-sm dark:text-[#F5F5F0]">Maria Clara</h4>
                                    <span class="text-xs text-secondary dark:text-[#a89a8f] italic">Wedding Shoot</span>
                                </div>
                            </div>
                        </div>
                        <!-- Duplicate Card 2 for seamless loop -->
                        <div class="review-card bg-white dark:bg-[#3a2a21] p-5 sm:p-6 md:p-8 rounded-3xl editorial-shadow border-l-4 border-primary">
                            <div class="flex gap-1 text-primary dark:text-[#e7d8c9] mb-4">
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined filled text-sm">star</span>
                                <span class="material-symbols-outlined text-sm">star</span>
                            </div>
                            <p class="text-on-surface-variant dark:text-[#D1CDC7] italic font-light leading-relaxed mb-6">"The pre-debut shoot was amazing! They knew exactly how to make me feel comfortable in front of the lens. The results were beyond my expectations."</p>
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center font-bold text-primary">S</div>
                                <div>
                                    <h4 class="font-bold text-sm dark:text-[#F5F5F0]">Sophia Reyes</h4>
                                    <span class="text-xs text-secondary dark:text-[#a89a8f] italic">Debut Package</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-12 sm:py-16 md:py-24 px-6 md:px-12 bg-surface-container-low dark:bg-[#12100E]" id="announcements">
<div class="max-w-7xl mx-auto">
<div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-4">
<div>
<span class="font-label text-[#C5A059] dark:text-[#C5A059] tracking-widest uppercase text-xs">Stay Updated</span>
<h2 class="font-headline text-3xl sm:text-3.5xl md:text-5xl dark:text-[#F5F5F0] mt-2">The Latest</h2>
</div>
<p class="text-secondary dark:text-[#D1CDC7] max-w-md font-light italic">Recent studio updates, upcoming bridal fair, and exclusive shoot locations.</p>
</div>
<!-- Desktop Grid View (md+) -->
<div class="hidden md:grid grid-cols-3 gap-16" id="announcementsGrid">
<div class="group cursor-pointer latest-item">
<div class="aspect-[4/5] overflow-hidden mb-6 rounded-2xl">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="Bride and groom at sunset" src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068"/>
</div>
<span class="text-xs font-label uppercase text-secondary dark:text-[#a89a8f] tracking-widest">Wedding Fair</span>
<h3 class="font-headline text-2xl dark:text-[#F5F5F0] mt-2 transition-colors">With you, even silence feels warm.</h3>
<p class="mt-3 text-on-surface-variant dark:text-[#D1CDC7] font-light leading-relaxed">EDPS STUDIO is a proud exhibitor at the Toast Wedding Fair on March 7–8 at the World Trade Center, Metro Manila. Visit our booth and let's start capturing your love story!</p>
</div>
<div class="group cursor-pointer latest-item">
<div class="aspect-[4/5] overflow-hidden mb-6 rounded-2xl">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="Corporate professional team portrait" src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068"/>
</div>
<span class="text-xs font-label uppercase text-secondary dark:text-[#D1CDC7] tracking-widest">The City Union</span>
<h3 class="font-headline text-2xl dark:text-[#F5F5F0] mt-2 transition-colors">Neon Noir: Urban Elopements</h3>
<p class="mt-3 text-on-surface-variant dark:text-[#D1CDC7] font-light leading-relaxed">"In a city of millions, we found a corner that was only ours." — The Couple</p>
</div>
<div class="group cursor-pointer latest-item">
<div class="aspect-[4/5] overflow-hidden mb-6 rounded-2xl">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="Dramatic black and white portrait" src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068"/>
</div>
<span class="text-xs font-label uppercase text-secondary dark:text-[#E8B873] tracking-widest">The Lakeside Vow</span>
<h3 class="font-headline text-2xl dark:text-[#F5F5F0] mt-2 transition-colors">A Breath of Gold: The Natural Light Session</h3>
<p class="mt-3 text-on-surface-variant dark:text-[#D1CDC7] font-light leading-relaxed">"The most beautiful weddings aren't seen; they are felt in the soft glow of the horizon." — Lead Photographer</p>
</div>
</div>

<!-- Mobile Carousel View (below md) -->
<div class="md:hidden">
<div class="swiper announcementsSwiper">
<div class="swiper-wrapper">
<div class="swiper-slide">
<div class="group cursor-pointer latest-item">
<div class="aspect-[4/5] overflow-hidden mb-6 rounded-2xl">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="Bride and groom at sunset" src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068"/>
</div>
<span class="text-xs font-label uppercase text-secondary dark:text-[#a89a8f] tracking-widest">Wedding Fair</span>
<h3 class="font-headline text-2xl dark:text-[#F5F5F0] mt-2 transition-colors">With you, even silence feels warm.</h3>
<p class="mt-3 text-on-surface-variant dark:text-[#D1CDC7] font-light leading-relaxed">EDPS STUDIO is a proud exhibitor at the Toast Wedding Fair on March 7–8 at the World Trade Center, Metro Manila. Visit our booth and let's start capturing your love story!</p>
</div>
</div>
<div class="swiper-slide">
<div class="group cursor-pointer latest-item">
<div class="aspect-[4/5] overflow-hidden mb-6 rounded-2xl">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="Corporate professional team portrait" src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068"/>
</div>
<span class="text-xs font-label uppercase text-secondary dark:text-[#D1CDC7] tracking-widest">The City Union</span>
<h3 class="font-headline text-2xl dark:text-[#F5F5F0] mt-2 transition-colors">Neon Noir: Urban Elopements</h3>
<p class="mt-3 text-on-surface-variant dark:text-[#D1CDC7] font-light leading-relaxed">"In a city of millions, we found a corner that was only ours." — The Couple</p>
</div>
</div>
<div class="swiper-slide">
<div class="group cursor-pointer latest-item">
<div class="aspect-[4/5] overflow-hidden mb-6 rounded-2xl">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="Dramatic black and white portrait" src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068"/>
</div>
<span class="text-xs font-label uppercase text-secondary dark:text-[#E8B873] tracking-widest">The Lakeside Vow</span>
<h3 class="font-headline text-2xl dark:text-[#F5F5F0] mt-2 transition-colors">A Breath of Gold: The Natural Light Session</h3>
<p class="mt-3 text-on-surface-variant dark:text-[#D1CDC7] font-light leading-relaxed">"The most beautiful weddings aren't seen; they are felt in the soft glow of the horizon." — Lead Photographer</p>
</div>
</div>
</div>
<!-- Pagination Dots -->
<div class="swiper-pagination announcements-pagination mt-20 sm:mt-24 md:mt-8 flex justify-center gap-2"></div>
</div>
</div>
</div>
</section>
<section class="py-12 sm:py-16 md:py-24 px-6 md:px-12" id="portfolio">
<div class="max-w-7xl mx-auto">
<div class="text-center mb-20">
<h2 class="font-headline text-3xl sm:text-4xl md:text-6xl dark:text-[#F5F5F0] mb-4">Curated Collections</h2>
<div class="w-24 h-px bg-primary/20 mx-auto mb-6"></div>
<div class="flex flex-wrap justify-center gap-8 font-label text-sm uppercase tracking-widest text-secondary dark:text-[#a89a8f]" id="portfolioFilters">
<button class="portfolio-filter-btn active text-primary font-bold transition-colors" data-filter="all">All</button>
<button class="portfolio-filter-btn hover:text-primary transition-colors" data-filter="weddings">Weddings</button>
<button class="portfolio-filter-btn hover:text-primary transition-colors" data-filter="debut">Debut</button>
<button class="portfolio-filter-btn hover:text-primary transition-colors" data-filter="portraits">Portraits</button>
<button class="portfolio-filter-btn hover:text-primary transition-colors" data-filter="highlights">Highlights</button>
</div>
</div>

<!-- Grid View (All) -->
<div class="portfolio-grid" id="portfolioGrid">
<div class="grid grid-cols-12 gap-6 md:gap-8">
<div class="col-span-12 md:col-span-8 lg:col-span-7 aspect-[16/9] overflow-hidden rounded-3xl relative group">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Elegant wedding reception hall" src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068"/>
<div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
<h4 class="text-white font-headline text-3xl">The Wedding</h4>
</div>
</div>
<div class="col-span-12 md:col-span-4 lg:col-span-5 aspect-[4/5] overflow-hidden rounded-3xl relative group">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Modern corporate boardroom meeting" src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068"/>
<div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
<h4 class="text-white font-headline text-3xl">Couple Portraits</h4>
</div>
</div>
<div class="col-span-12 md:col-span-6 lg:col-span-4 aspect-square overflow-hidden rounded-3xl relative group">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="Candid family laughter in park" src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068"/>
<div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
<h4 class="text-white font-headline text-3xl">The Elements</h4>
</div>
</div>
<div class="col-span-12 md:col-span-6 lg:col-span-8 aspect-[21/9] overflow-hidden rounded-3xl relative group">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" data-alt="High-end gala event crowd" src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068"/>
<div class="absolute inset-0 bg-primary/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-8">
<h4 class="text-white font-headline text-3xl">The Debut</h4>
</div>
</div>
</div>
</div>

<!-- Carousel View (Category) -->
<div class="portfolio-carousel hidden" id="portfolioCarousel">
<div class="swiper portfolioSwiper">
<div class="swiper-wrapper">
<!-- Weddings Slides -->
<div class="swiper-slide" data-category="weddings">
<img src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068" alt="Wedding 1"/>
</div>
<div class="swiper-slide" data-category="weddings">
<img src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068" alt="Wedding 2"/>
</div>
<div class="swiper-slide" data-category="weddings">
<img src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068" alt="Wedding 3"/>
</div>
<!-- Debut Slides -->
<div class="swiper-slide" data-category="debut">
<img src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068" alt="Debut 1"/>
</div>
<div class="swiper-slide" data-category="debut">
<img src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068" alt="Debut 2"/>
</div>
<div class="swiper-slide" data-category="debut">
<img src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068" alt="Debut 3"/>
</div>
<!-- Portraits Slides -->
<div class="swiper-slide" data-category="portraits">
<img src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068" alt="Portraits 1"/>
</div>
<div class="swiper-slide" data-category="portraits">
<img src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068" alt="Portraits 2"/>
</div>
<div class="swiper-slide" data-category="portraits">
<img src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068" alt="Portraits 3"/>
</div>
<!-- Highlights Slides -->
<div class="swiper-slide" data-category="highlights">
<img src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068" alt="Highlights 1"/>
</div>
<div class="swiper-slide" data-category="highlights">
<img src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068" alt="Highlights 2"/>
</div>
<div class="swiper-slide" data-category="highlights">
<img src="https://scontent.fmnl4-3.fna.fbcdn.net/v/t39.30808-6/671586056_1589521363174599_4338977493471316379_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeH-b9AUnUdBgVOCwO3AdkMex_Dr-ZpmDM3H8Ov5mmYMzQ3mMDFBFvlhIDXwnFfKIN1L3x3fzVzyzYi36alNL5XD&_nc_ohc=xbc90Y_Axd0Q7kNvwF_MAiS&_nc_oc=AdqFBEaHwHFEOLpwQFN1h2k0rroXKLPdA3mDW7EuhDSRRJdpcUVhVXyXybk7cQOMv24cCQzHaOuv2jLEcp7zHMie&_nc_zt=23&_nc_ht=scontent.fmnl4-3.fna&_nc_gid=u0wVkLRC0iEAiY12XryyXA&_nc_ss=7a3a8&oh=00_Af33vxZcKCUZHwIif97Ljy5VdYHhsYLRvOxNS649U0VS7A&oe=69E77068" alt="Highlights 3"/>
</div>
</div>
</div>
<div class="carousel-controls">
<button class="carousel-btn portfolio-prev" id="portfolioPrev">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<button class="carousel-btn portfolio-next" id="portfolioNext">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
</div>

</div>
</section>
<section class="py-12 sm:py-16 md:py-24 px-6 md:px-12 bg-surface-container-low dark:bg-[#12100E] overflow-hidden" id="packages">
<div class="max-w-7xl mx-auto relative">
<div class="text-center mb-10 md:mb-20">
<span class="font-label text-primary dark:text-[#F5F5F0] tracking-widest uppercase text-xs">Invest in the moment</span>
<h2 class="font-headline text-2xl sm:text-3xl md:text-6xl dark:text-[#F5F5F0] mt-2">Debut Packages</h2>
</div>
<div class="absolute top-1/2 -left-4 -right-4 md:-left-8 md:-right-8 flex justify-between items-center pointer-events-none z-20 translate-y-8">
<button class="pointer-events-auto w-12 h-12 rounded-full bg-white/90 dark:bg-[#3a2a21]/90 border border-outline-variant dark:border-[#5d4037] flex items-center justify-center text-primary shadow-lg hover:bg-primary hover:text-white transition-all focus:outline-none" id="prevPackage">
<span class="material-symbols-outlined">chevron_left</span>
</button>
<button class="pointer-events-auto w-12 h-12 rounded-full bg-white/90 dark:bg-[#3a2a21]/90 border border-outline-variant dark:border-[#5d4037] flex items-center justify-center text-primary shadow-lg hover:bg-primary hover:text-white transition-all focus:outline-none" id="nextPackage">
<span class="material-symbols-outlined">chevron_right</span>
</button>
</div>
<div class="flex gap-3 sm:gap-4 md:gap-8 overflow-x-auto snap-x snap-mandatory no-scrollbar scroll-smooth pb-6 md:pb-12 px-4 md:px-0" id="packageSlider">
<div class="min-w-[85%] md:min-w-[calc(33.333%-1.35rem)] flex-shrink-0 snap-center">
<div class="bg-surface dark:bg-[#3a2a21] p-2 sm:p-3 md:p-10 flex flex-col editorial-shadow rounded-2xl md:rounded-3xl package-card-hover package-card">
<h3 class="font-headline text-base sm:text-lg md:text-5xl dark:text-[#F5F5F0] mb-1 md:mb-2">Basic</h3>
<div class="mb-2 md:mb-8">
<span class="text-sm sm:text-base md:text-4xl font-headline dark:text-[#F5F5F0]">Php. 39,999</span>
<span class="text-xs md:text-base text-on-surface-variant dark:text-[#D1CDC7] block text-xs">/shoot</span>
</div>
<ul class="space-y-0.5 sm:space-y-1.5 md:space-y-4 mb-3 md:mb-12 flex-grow">
<li class="flex items-center gap-1.5 md:gap-3 text-xs md:text-sm text-on-surface-variant dark:text-[#D1CDC7]">
<span class="material-symbols-outlined check text-xs md:text-lg flex-shrink-0">check</span>
                                 1 Photographer, Videographer & Assistant
                            </li>
<li class="flex items-center gap-1.5 md:gap-3 text-xs md:text-sm text-on-surface-variant dark:text-[#D1CDC7]">
<span class="material-symbols-outlined check text-xs md:text-lg flex-shrink-0">check</span>
                                 Full Edited Video
                            </li>
<li class="flex items-center gap-1.5 md:gap-3 text-xs md:text-sm text-on-surface-variant dark:text-[#D1CDC7]">
<span class="material-symbols-outlined check text-xs md:text-lg flex-shrink-0">check</span>
                                 20 Pages 8x10 Digital Storybook Layout
                            </li>
                            <li class="flex items-center gap-1.5 md:gap-3 text-xs md:text-sm text-on-surface-variant dark:text-[#D1CDC7]">
<span class="material-symbols-outlined check text-xs md:text-lg flex-shrink-0">check</span>
                                 Raw HD Photo and Video
                            </li>
                            <li class="flex items-center gap-1.5 md:gap-3 text-xs md:text-sm text-on-surface-variant dark:text-[#D1CDC7]">
<span class="material-symbols-outlined check text-xs md:text-lg flex-shrink-0">check</span>
                                 11x14 Picture Frame
                            </li>
                            <li class="flex items-center gap-1.5 md:gap-3 text-xs md:text-sm text-on-surface-variant dark:text-[#D1CDC7]">
<span class="material-symbols-outlined check text-xs md:text-lg flex-shrink-0">check</span>
                                 Use of Projector, Screen, and Mannequin
                            </li>
</ul>
</div>
</div>
<div class="min-w-[85%] md:min-w-[calc(33.333%-1.35rem)] flex-shrink-0 snap-center">
<div class="bg-primary text-on-primary p-2 sm:p-3 md:p-10 flex flex-col editorial-shadow rounded-2xl md:rounded-3xl package-card-hover package-card relative z-10">

<h3 class="font-headline text-base sm:text-lg md:text-5xl mb-1 md:mb-2">Classic</h3>
<div class="mb-2 md:mb-8">
<span class="text-sm sm:text-base md:text-4xl font-headline">Php. 49,999</span>
<span class="text-xs md:text-base text-primary-fixed/70 block text-xs">/shoot</span>
</div>
<ul class="space-y-0.5 sm:space-y-1.5 md:space-y-4 mb-3 md:mb-12 flex-grow">
<li class="flex items-center gap-1.5 md:gap-3 text-xs md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs md:text-lg flex-shrink-0">check</span>
<span class="leading-tight">
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Full Edited Video
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 20 Pages 8x10 Digital Storybook Layout
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Raw HD Photo and Video
                            </li>
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Pre-Debut Pictorial & SDE Video
                            </li>
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 11x14 Picture Frame
                            </li>
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Use of Projector, Screen, and Mannequin
                            </li>
</ul>
</div>
</div>
<div class="min-w-[85%] md:min-w-[calc(33.333%-1.35rem)] flex-shrink-0 snap-center">
<div class="bg-surface dark:bg-[#3a2a21] p-2 sm:p-3 md:p-10 flex flex-col editorial-shadow rounded-2xl md:rounded-3xl package-card-hover package-card">
<h3 class="font-headline text-base sm:text-lg md:text-5xl dark:text-[#F5F5F0] mb-1 md:mb-2">Bronze</h3>
<div class="mb-2 md:mb-8">
<span class="text-sm sm:text-base md:text-4xl font-headline dark:text-[#F5F5F0]">Php. 49,999</span>
<span class="text-xs md:text-base text-on-surface-variant dark:text-[#D1CDC7] dark:!text-[#F5F5F0] block text-xs">/shoot</span>
</div>
<ul class="space-y-0.5 sm:space-y-1.5 md:space-y-4 mb-3 md:mb-12 flex-grow">
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-on-surface-variant dark:text-[#D1CDC7] dark:!text-[#F5F5F0]">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 1 Photographer, 2 Videographer & Assistant
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-on-surface-variant dark:text-[#D1CDC7] dark:!text-[#F5F5F0]">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Full Edited Video
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-on-surface-variant dark:text-[#D1CDC7] dark:!text-[#F5F5F0]">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Raw HD Photo and Video
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-on-surface-variant dark:text-[#D1CDC7] dark:!text-[#F5F5F0]">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Pre-Debut Pictorial, SDE & Save the Date Videos
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-on-surface-variant dark:text-[#D1CDC7] dark:!text-[#F5F5F0]">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Audio Visual Presentation
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-on-surface-variant dark:text-[#D1CDC7] dark:!text-[#F5F5F0]">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 11x14 Picture Frame
                            </li>  
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-on-surface-variant dark:text-[#D1CDC7] dark:!text-[#F5F5F0]">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Use of Projector, Screen, and Mannequin
                            </li>                                                                                                                                
</ul>
</div>
</div>
<div class="min-w-[85%] md:min-w-[calc(33.333%-1.35rem)] flex-shrink-0 snap-center">
<div class="bg-primary text-on-primary p-2 sm:p-3 md:p-10 flex flex-col editorial-shadow rounded-2xl md:rounded-3xl package-card-hover package-card relative z-10">
<h3 class="font-headline text-base sm:text-lg md:text-5xl mb-1 md:mb-2">Silver</h3>
<div class="mb-2 md:mb-8">
<span class="text-sm sm:text-base md:text-4xl font-headline">Php. 59,999</span>
<span class="text-xs md:text-base text-primary-fixed/70 block text-xs">/shoot</span>
</div>
<ul class="space-y-0.5 sm:space-y-1.5 md:space-y-4 mb-3 md:mb-12 flex-grow">
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 2 Photographer, Videographer, and Assistant
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Full Edited Video
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Raw HD Photo and Video
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Pre-Debut Pictorial, SDE & Save the Date Videos
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Audio Visual Presentation
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 20 Pages 8x10 Digital Storybook Layout
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 14 Pre-debut Album
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 11x14 Picture Frame
                            </li>
<li class="flex items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-sm text-primary-fixed/90">
<span class="material-symbols-outlined check text-xs sm:text-sm md:text-lg">check</span>
                                 Use of Projector, Screen, and Mannequin
                            </li>                                                                                                                                                                                                                            
</ul>
</div>
</div>
</div>
</div>
</section>
<section class="py-12 sm:py-20 md:py-32 px-6 md:px-12 bg-surface dark:bg-[#12100E]" id="about">
<div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-20">
<div class="w-full lg:w-1/2 relative">
<div class="aspect-[3/4] overflow-hidden rounded-2xl editorial-shadow" style="filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.08))">
<img class="w-full h-full object-cover" data-alt="Photographer checking camera lens" src="https://scontent.fmnl44-1.fna.fbcdn.net/v/t39.30808-6/649072754_1552318566894879_681581515804303874_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=dd6889&_nc_eui2=AeF1wD2SI2KJ6mpGGX5i4AfUX8bsd26OkLBfxux3bo6QsEUBk7pGX4atnKF2w0AKauJvg7UVrxxT_RAEpw9qtkoB&_nc_ohc=KUAHMnN0UZwQ7kNvwEk_CdM&_nc_oc=AdrvE07C5NUu_ePI0TlO91M1ulmKWZOB5LpW4Axce3EVTbWkj0dhZ2PuM9NW9wIHpjpVE7CSLTtGnoRFEVLyeacA&_nc_zt=23&_nc_ht=scontent.fmnl44-1.fna&_nc_gid=PA2HF-0UIOaoEePf4zkH3w&_nc_ss=7a32e&oh=00_AfxRlKF-RY5bHq2Q2uVHvXJJt8mxBDp9GdMoW12-9wHNxg&oe=69C739B2"/>
</div>
<div class="absolute -bottom-10 -right-10 hidden md:block w-64 aspect-square bg-surface-container-highest dark:bg-[#3a2a21] p-8">
<p class="font-headline italic text-primary dark:text-[#F5F5F0] text-xl">"Where light meets emotion, a story begins."</p>
</div>
</div>
<div class="w-full lg:w-1/2">
<span class="font-label text-[#C5A059] dark:text-[#C5A059] tracking-widest uppercase text-xs">Our Philosophy</span>
<h2 class="font-headline text-5xl md:text-6xl dark:text-[#F5F5F0] mb-8 leading-tight">Crafting Legacies <br/>through Lens</h2>
<div class="space-y-6 text-on-surface-variant dark:text-[#D1CDC7] leading-relaxed text-lg font-light">
<p>EDPS Studio was founded on a singular premise: that every moment, whether a high-stakes corporate merger or a quiet sunrise wedding, carries an inherent poetry.</p>
<p>Our mission transcends mere documentation. We seek the textures of the soul—the flicker of determination in a CEO's eyes, the unbridled joy of a first dance, the silent strength of a portrait. We don't just take photos; we curate memories.</p>
<p>With an editorial eye and a documentary heart, we bridge the gap between business and personal, capturing the professional excellence and human warmth that define your journey.</p>
</div>
<div class="mt-12 flex items-center gap-4">
<span class="font-headline italic text-2xl text-[#C5A059] dark:text-[#C5A059]">EDPS Studio</span>
<div class="h-px w-20 bg-[#C5A059] dark:bg-[#C5A059]"></div>
</div>
</div>
</div>
</section>
<section class="py-12 sm:py-20 md:py-32 px-6 md:px-12 bg-surface dark:bg-[#12100E]" id="contact">
<div class="max-w-7xl mx-auto flex flex-col items-center text-center">
<span class="font-label text-[#C5A059] dark:text-[#C5A059] tracking-widest uppercase text-xs">Connect</span>
<h2 class="font-headline text-3xl sm:text-4xl md:text-6xl dark:text-[#F5F5F0] mt-4 mb-8" data-scroll-reveal>Let's Create Together</h2>
<p class="text-on-surface-variant dark:text-[#D1CDC7] text-lg font-light leading-relaxed mb-12 max-w-2xl" data-scroll-reveal>
                 Whether it's a whisper of a wedding idea or a clear corporate directive, we want to hear your vision. Connect with us on our social platforms to start your journey.
             </p>
<div class="flex justify-center gap-3 sm:gap-6 md:gap-12 flex-wrap"><a class="group flex flex-col items-center gap-2 sm:gap-4 transition-transform hover:-translate-y-1" href="https://www.instagram.com/edps_studio?igsh=MWcxb2Jqbnoyd3E5ZQ==" target="_blank">
<div class="w-14 sm:w-18 md:w-20 h-14 sm:h-18 md:h-20 rounded-full bg-surface-container-highest dark:bg-[#3a2a21] flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all duration-500 editorial-shadow">
<svg class="w-6 sm:w-7 md:w-8 h-6 sm:h-7 md:h-8 instagram-icon" viewbox="0 0 24 24">
<defs>
<linearGradient id="instagramGradient" x1="0%" y1="100%" x2="100%" y2="0%">
<stop offset="0%" style="stop-color:#fd1d1d;stop-opacity:1" />
<stop offset="50%" style="stop-color:#833ab4;stop-opacity:1" />
<stop offset="100%" style="stop-color:#fcaf45;stop-opacity:1" />
</linearGradient>
</defs>
<path fill="url(#instagramGradient)" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.85-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path>
</svg>
</div>
<span class="font-label text-xs uppercase tracking-[0.1em] sm:tracking-[0.2em] text-secondary dark:text-[#a89a8f] group-hover:text-primary dark:group-hover:text-[#F5F5F0] transition-colors\">Instagram</span>
</a>
<a class="group flex flex-col items-center gap-2 sm:gap-4 transition-transform hover:-translate-y-1" href="https://web.facebook.com/EdpsStudio" target="_blank">
<div class="w-14 sm:w-18 md:w-20 h-14 sm:h-18 md:h-20 rounded-full bg-surface-container-highest dark:bg-[#3a2a21] flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all duration-500 editorial-shadow">
<svg class="w-6 sm:w-7 md:w-8 h-6 sm:h-7 md:h-8 facebook-icon" viewbox="0 0 24 24">
<path fill="#1877F2" d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
</svg>
</div>
<span class="font-label text-xs uppercase tracking-[0.1em] sm:tracking-[0.2em] text-secondary dark:text-[#a89a8f] group-hover:text-primary dark:group-hover:text-[#F5F5F0] transition-colors\">Facebook</span>
</a>
<a class="group flex flex-col items-center gap-2 sm:gap-4 transition-transform hover:-translate-y-1" href="https://www.tiktok.com/@edpsstudioofficial" target="_blank">
<div class="w-14 sm:w-18 md:w-20 h-14 sm:h-18 md:h-20 rounded-full bg-surface-container-highest dark:bg-[#3a2a21] flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all duration-500 editorial-shadow overflow-visible social-icon-container">
<svg class="w-7 sm:w-8 md:w-10 h-7 sm:h-8 md:h-10 tiktok-icon" viewBox="0 0 448 512" fill="none">
<path class="fill-black dark:fill-white" d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.25V349.4A162.55 162.55 0 1 1 185 188.31V278.2a74.62 74.62 0 1 0 52.23 50.85V0h87a210.1 210.1 0 0 0 121.77 209.9z"></path>
</svg>
</div>
<span class="font-label text-xs uppercase tracking-[0.1em] sm:tracking-[0.2em] text-secondary dark:text-[#a89a8f] group-hover:text-primary dark:group-hover:text-[#F5F5F0] transition-colors\">TikTok</span>
</a>
</div>
</div>
</section>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dark mode toggle
    const themeToggle = document.getElementById('themeToggle');
    const html = document.documentElement;
    
    // Check if dark mode preference is saved
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    if (isDarkMode) {
        html.classList.add('dark');
    }
    
    // Toggle dark mode on button click
    themeToggle.addEventListener('click', function() {
        html.classList.toggle('dark');
        const isDark = html.classList.contains('dark');
        localStorage.setItem('darkMode', isDark);
    });

    // Navigation active link tracking using Intersection Observer
    const sections = ['home', 'reviews', 'announcements', 'portfolio', 'packages', 'about', 'contact'];
    const navLinks = document.querySelectorAll('.nav-link');
    
    // Intersection Observer with generous rootMargin to catch sections as they enter viewport
    const observerOptions = {
        root: null,
        rootMargin: '-20% 0px -80% 0px',
        threshold: 0
    };
    
    const observerCallback = (entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Remove active class from all links
                navLinks.forEach(link => link.classList.remove('active'));
                
                // Add active class to the corresponding link
                const sectionId = entry.target.id;
                const activeLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);
                if (activeLink) {
                    activeLink.classList.add('active');
                }
            }
        });
    };
    
    const observer = new IntersectionObserver(observerCallback, observerOptions);
    
    // Observe all sections
    sections.forEach(sectionId => {
        const section = document.getElementById(sectionId);
        if (section) {
            observer.observe(section);
        }
    });
    
    // Fallback: If at very bottom of page (Contact section), ensure Contact link is active
    const handleScrollEnd = function() {
        // Check if we're at the bottom of the page
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 100) {
            navLinks.forEach(link => link.classList.remove('active'));
            const contactLink = document.querySelector('.nav-link[href="#contact"]');
            if (contactLink) {
                contactLink.classList.add('active');
            }
        }
    };
    
    window.addEventListener('scroll', handleScrollEnd);
    
    // Handle direct link clicks - update active state immediately
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Remove active class from all links
            navLinks.forEach(l => l.classList.remove('active'));
            // Add active class to clicked link
            this.classList.add('active');
        });
    });

    // Mobile sidebar toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenuClose = document.getElementById('mobileMenuClose');
    const mobileSidebar = document.getElementById('mobileSidebar');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const mobileLinks = mobileSidebar.querySelectorAll('a');

    const toggleMobileMenu = function() {
        mobileSidebar.classList.toggle('open');
        mobileMenuOverlay.classList.toggle('open');
    };

    const closeMobileMenu = function() {
        mobileSidebar.classList.remove('open');
        mobileMenuOverlay.classList.remove('open');
    };

    mobileMenuToggle.addEventListener('click', toggleMobileMenu);
    mobileMenuClose.addEventListener('click', closeMobileMenu);
    mobileMenuOverlay.addEventListener('click', closeMobileMenu);

    // Close sidebar when a link is clicked
    mobileLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
    });

    // Portfolio Filter and Carousel
    let portfolioSwiper = null;
    const portfolioGrid = document.getElementById('portfolioGrid');
    const portfolioCarousel = document.getElementById('portfolioCarousel');
    const filterButtons = document.querySelectorAll('.portfolio-filter-btn');

    const initPortfolioSwiper = function() {
        if (portfolioSwiper) {
            portfolioSwiper.destroy();
        }
        portfolioSwiper = new Swiper('.portfolioSwiper', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 3,
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '#portfolioNext',
                prevEl: '#portfolioPrev',
            },
            coverflowEffect: {
                rotate: 15,
                stretch: -50,
                depth: 200,
                modifier: 1,
                slideShadows: false,
            },
        });
    };

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update button states
            filterButtons.forEach(btn => btn.classList.remove('active', 'text-primary', 'font-bold'));
            this.classList.add('active', 'text-primary', 'font-bold');

            if (filter === 'all') {
                // Show grid, hide carousel
                portfolioGrid.classList.remove('hidden');
                portfolioCarousel.classList.add('hidden');
            } else {
                // Show carousel, hide grid
                portfolioGrid.classList.add('hidden');
                portfolioCarousel.classList.remove('hidden');
                
                // Initialize Swiper if not already done
                setTimeout(() => {
                    if (!portfolioSwiper) {
                        initPortfolioSwiper();
                    }
                }, 100);
            }
        });
    });

    // Package slider
    const packageSlider = document.getElementById('packageSlider');
    const prevPackage = document.getElementById('prevPackage');
    const nextPackage = document.getElementById('nextPackage');

    if (packageSlider && prevPackage && nextPackage) {
        const getPackageCardWidth = () => {
            const cards = packageSlider.querySelectorAll('.snap-center');
            if (cards.length > 0) {
                const card = cards[0];
                const style = window.getComputedStyle(card);
                const marginRight = parseFloat(style.marginRight) || 0;
                return card.offsetWidth + marginRight + 32;
            }
            return 0;
        };

        prevPackage.addEventListener('click', function() {
            const cardWidth = getPackageCardWidth();
            packageSlider.scrollBy({
                left: -cardWidth,
                behavior: 'smooth'
            });
        });

        nextPackage.addEventListener('click', function() {
            const cardWidth = getPackageCardWidth();
            packageSlider.scrollBy({
                left: cardWidth,
                behavior: 'smooth'
            });
        });
    }

    // Announcements Carousel (Mobile Only)
    let announcementsSwiper = null;
    
    const initAnnouncementsSwiper = function() {
        if (window.innerWidth < 768) {
            if (!announcementsSwiper) {
                announcementsSwiper = new Swiper('.announcementsSwiper', {
                    slidesPerView: 1,
                    spaceBetween: 24,
                    grabCursor: true,
                    pagination: {
                        el: '.announcements-pagination',
                        clickable: true,
                        bulletClass: 'swiper-pagination-bullet',
                        bulletActiveClass: 'swiper-pagination-bullet-active',
                    },
                    on: {
                        slideChange: function() {
                            // Update pagination dots styling
                            const bullets = document.querySelectorAll('.announcements-pagination .swiper-pagination-bullet');
                            bullets.forEach((bullet, index) => {
                                if (index === this.activeIndex) {
                                    bullet.classList.add('swiper-pagination-bullet-active');
                                } else {
                                    bullet.classList.remove('swiper-pagination-bullet-active');
                                }
                            });
                        }
                    }
                });
            }
        } else {
            // Destroy swiper on desktop
            if (announcementsSwiper) {
                announcementsSwiper.destroy();
                announcementsSwiper = null;
            }
        }
    };

    // Initialize announcements swiper on load
    initAnnouncementsSwiper();

    // Re-initialize on window resize
    window.addEventListener('resize', function() {
        initAnnouncementsSwiper();
    });

    // Auto-scroll review track handled by CSS animation

    // Scroll Reveal Animation using Intersection Observer
    const revealElements = document.querySelectorAll('[data-scroll-reveal], h1, h2, h3, .editorial-shadow img');
    
    const revealOptions = {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    };

    const revealOnScroll = new IntersectionObserver(function(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('scroll-reveal');
                observer.unobserve(entry.target);
            }
        });
    }, revealOptions);

    revealElements.forEach(element => {
        if (!element.classList.contains('scroll-reveal')) {
            revealOnScroll.observe(element);
        }
    });
});
</script>
</body>
</html>