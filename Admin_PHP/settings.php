<?php
require_once 'config.php';
require_once 'Database.php';
require_once 'Staff.php';

$staff = new Staff();
$staffMembers = $staff->getAll('active');
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Settings | EDPS Studio</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&amp;family=Manrope:wght@400;500;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
        <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-secondary-container": "#745c63",
                        "background": "#fff8f3",
                        "on-primary-fixed-variant": "#5d3e49",
                        "error": "#ba1a1a",
                        "tertiary-fixed-dim": "#b7cdaf",
                        "surface-container": "#f4ede8",
                        "surface-dim": "#dfd9d4",
                        "primary": "#4a2d37",
                        "tertiary": "#283a25",
                        "inverse-primary": "#e6bbc8",
                        "on-primary-fixed": "#2d141d",
                        "surface-container-low": "#f9f2ed",
                        "surface-tint": "#775560",
                        "on-background": "#1e1b18",
                        "primary-container": "#63434e",
                        "primary-fixed-dim": "#e6bbc8",
                        "surface-container-high": "#eee7e2",
                        "outline-variant": "#d2c3c6",
                        "on-tertiary": "#ffffff",
                        "on-primary": "#ffffff",
                        "inverse-surface": "#33302d",
                        "on-secondary-fixed-variant": "#564147",
                        "primary-fixed": "#ffd9e4",
                        "surface-bright": "#fff8f3",
                        "on-primary-container": "#dcb2bf",
                        "on-error": "#ffffff",
                        "outline": "#817477",
                        "on-secondary-fixed": "#28171c",
                        "inverse-on-surface": "#f6efea",
                        "surface-variant": "#e8e1dc",
                        "on-error-container": "#93000a",
                        "secondary-fixed": "#fadbe2",
                        "surface": "#fff8f3",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#6f585f",
                        "on-surface": "#1e1b18",
                        "tertiary-container": "#3e513a",
                        "error-container": "#ffdad6",
                        "on-surface-variant": "#4f4447",
                        "on-secondary": "#ffffff",
                        "secondary-container": "#f7d8e0",
                        "tertiary-fixed": "#d3e9ca",
                        "surface-container-highest": "#e8e1dc",
                        "on-tertiary-fixed-variant": "#394c35",
                        "on-tertiary-fixed": "#0e1f0d"
                    },
                    fontFamily: {
                        "headline": ["Noto Serif"],
                        "body": ["Manrope"],
                        "label": ["Manrope"]
                    },
                    borderRadius: { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-nav {
            background: rgba(255, 248, 243, 0.8);
            backdrop-filter: blur(12px);
        }
        /* Skeleton Loading Animation */
        @keyframes skeleton-loading {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        .skeleton {
            background: linear-gradient(90deg, rgba(200,200,200,0.2) 25%, rgba(200,200,200,0.3) 50%, rgba(200,200,200,0.2) 75%);
            background-size: 1000px 100%;
            animation: skeleton-loading 2s infinite;
            border-radius: 8px;
        }
        .light .skeleton {
            background: linear-gradient(90deg, rgba(100,100,100,0.1) 25%, rgba(100,100,100,0.15) 50%, rgba(100,100,100,0.1) 75%);
            background-size: 1000px 100%;
        }
        /* Skeleton placeholder styles */
        .skeleton-profile {
            width: 128px;
            height: 128px;
            border-radius: 50%;
        }
        .skeleton-title {
            height: 32px;
            width: 60%;
            border-radius: 8px;
        }
        .skeleton-text {
            height: 16px;
            width: 100%;
            border-radius: 4px;
            margin: 8px 0;
        }
        .skeleton-input {
            height: 44px;
            width: 100%;
            border-radius: 8px;
        }
        .skeleton-button {
            height: 44px;
            width: 120px;
            border-radius: 8px;
        }
        /* Prevent white flash on page load */
        html {
            background: #1A1614;
            color: #D1CDC7;
        }
        html.light {
            background: #FFF8F3;
            color: #2D141D;
        }
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
            background: #1A1614;
        }
        body.light {
            background: #FFF8F3;
        }
        /* Smooth page transitions */
        .page-loading {
            pointer-events: none;
        }
    </style>

</head>
<body class="bg-[#12100E] font-body text-[#D1CDC7] antialiased flex min-h-screen">

        <!-- SideNavBar -->
        <aside class="hidden lg:flex flex-col h-screen w-72 border-r border-[#2C1A12] bg-[#1A1614] py-8 px-6 sticky top-0 font-['Noto_Serif'] antialiased overflow-y-auto">
            <div class="mb-10">
                <h1 class="text-2xl font-bold tracking-tight text-[#F5F5F0]" id="sidebar-logo-text">EDPS Studio</h1>
                <p class="text-xs text-[#D1CDC7] mt-1 font-['Manrope']" id="sidebar-logo-subtext">Editorial Management</p>
            </div>
            <!-- Navigation -->
            <nav class="flex-1 space-y-2">
                <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 group" href="Bulletin.php">
                    <span class="material-symbols-outlined text-[#C5A059]" data-icon="dashboard">dashboard</span>
                    <span class="font-body font-medium">Dashboard</span>
                </a>
                <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 group" href="stafflist.php">
                    <span class="material-symbols-outlined text-[#C5A059]" data-icon="photo_library">photo_library</span>
                    <span class="font-body font-medium">Projects</span>
                </a>
                <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 group" href="staffmanage.php">
                    <span class="material-symbols-outlined text-[#C5A059]" data-icon="group">group</span>
                    <span class="font-body font-medium">Staff Management</span>
                </a>
                <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 group" href="webedit.php">
                    <span class="material-symbols-outlined text-[#C5A059]" data-icon="language">language</span>
                    <span class="font-body font-medium">Website CMS</span>
                </a>
            </nav>
            <div class="mt-auto pt-6 border-t border-[#2C1A12] space-y-1">
              <a class="flex items-center gap-4 text-[#F5F5F0] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#2C1A12] transition-colors rounded-lg" href="settings.php">
        <span class="material-symbols-outlined text-[#C5A059]">settings</span>
        <span class="font-medium">Settings</span>
    </a>
                <button id="desktopThemeToggle" class="w-full flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 bg-transparent border-none cursor-pointer">
                    <span class="material-symbols-outlined text-[#C5A059] light:text-[#0D0B08]" style="font-size: 36px;" data-icon="dark_mode">dark_mode</span>
                    <span class="font-body font-medium">Theme</span>
                </button>
                <button id="desktopLogout" class="w-full flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 bg-transparent border-none cursor-pointer">
                    <span class="material-symbols-outlined text-[#C5A059] light:text-[#0D0B08]" style="font-size: 36px;" data-icon="logout">logout</span>
                    <span class="font-body font-medium">Logout</span>
                </button>
            </div>
        </aside>

<!-- Mobile Drawer Menu -->
<div id="mobileDrawer" class="fixed inset-0 z-50 hidden lg:hidden">
<div id="mobileDrawerBackdrop" class="absolute inset-0 bg-black/50 transition-opacity duration-300"></div>
<aside id="mobileDrawerSidebar" class="absolute left-0 top-0 bottom-0 w-72 bg-[#301f17] border-r border-[#2C1A12] py-8 px-6 transform -translate-x-full transition-transform duration-300 overflow-y-auto">
<div class="flex items-center justify-between mb-10">
<div>
<h1 class="text-2xl font-bold tracking-tight text-[#F5F5F0]">EDPS Studio</h1>
<p class="text-xs text-[#D1CDC7] mt-1 font-['Manrope']">Editorial Management</p>
</div>
<button id="mobileDrawerClose" class="p-2 hover:bg-[#2C1A12] rounded-lg transition-colors">
<span class="material-symbols-outlined text-[#C5A059]">close</span>
</button>
</div>
<!-- Mobile Navigation -->
<nav class="flex-1 space-y-2">
<a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200" href="Bulletin.php">
<span class="material-symbols-outlined text-[#C5A059]" data-icon="dashboard">dashboard</span>
<span class="font-body font-medium">Dashboard</span>
</a>
<a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200" href="stafflist.php">
<span class="material-symbols-outlined text-[#C5A059]" data-icon="photo_library">photo_library</span>
<span class="font-body font-medium">Projects</span>
</a>
<a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200" href="staffmanage.php">
<span class="material-symbols-outlined text-[#C5A059]" data-icon="group">group</span>
<span class="font-body font-medium">Staff Management</span>
</a>
<a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200" href="webedit.php">
<span class="material-symbols-outlined text-[#C5A059]" data-icon="language">language</span>
<span class="font-body font-medium">Website CMS</span>
</a>
</nav>
<div class="mt-auto pt-6 border-t border-[#2C1A12] space-y-1">
<a class="flex items-center gap-4 text-[#F5F5F0] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#2C1A12] transition-colors rounded-lg" href="settings.php">
<span class="material-symbols-outlined text-[#C5A059]">settings</span>
<span class="font-medium">Settings</span>
</a>
<button id="mobileThemeToggle" class="w-full flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 bg-transparent border-none cursor-pointer">
<span class="material-symbols-outlined text-[#C5A059] light:text-[#0D0B08]" style="font-size: 36px;" data-icon="dark_mode">dark_mode</span>
<span class="font-body font-medium">Theme</span>
</button>
<button id="mobileDrawerLogout" class="w-full flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 bg-transparent border-none cursor-pointer">
<span class="material-symbols-outlined text-[#C5A059] light:text-[#0D0B08]" style="font-size: 36px;" data-icon="logout">logout</span>
<span class="font-body font-medium">Logout</span>
</button>
</div>
</aside>
</div>

<main class="flex-1 flex flex-col min-w-0">
                <!-- TopAppBar -->
            <header class="sticky top-0 z-40 flex justify-between items-center w-full px-8 py-4 bg-[#1A1614]/80 backdrop-blur-md text-[#F5F5F0] font-['Manrope'] font-medium border-b border-[#2C1A12]">
                <div class="flex items-center gap-4">
                    <span id="mobileMenuToggle" class="material-symbols-outlined text-2xl text-[#C5A059] cursor-pointer hover:opacity-70 transition-opacity inline-flex lg:!hidden" data-icon="menu">menu</span>
                    <h2 class="text-lg font-bold text-[#F5F5F0]">Admin Portal</h2>
                </div>
                <div class="flex items-center gap-6">
                    <div class="relative hidden sm:block">
                        <span class="absolute inset-y-0 left-3 flex items-center text-[#C5A059]">
                            <span class="material-symbols-outlined text-xl" data-icon="search">search</span>
                        </span>
                        <input class="bg-[#2C1A12] border border-[#2C1A12] rounded-full py-2 pl-10 pr-4 w-64 focus:ring-1 focus:ring-[#C5A059]/30 text-sm placeholder:text-[#D1CDC7] text-[#F5F5F0]" placeholder="Global search..." type="text"/>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center h-full">
                            <span class="material-symbols-outlined text-[#C5A059] cursor-pointer hover:opacity-70 transition-opacity p-2" data-icon="notifications">notifications</span>
                        </div>
                        <div class="w-px h-8 bg-[#2C1A12]"></div>
                        <div class="flex items-center gap-3 cursor-pointer hover:opacity-80 transition-opacity">
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold text-[#F5F5F0] leading-tight">Admin</p>
                                <p class="text-[10px] text-[#D1CDC7] font-medium uppercase tracking-wider">Account</p>
                            </div>
                            <div class="w-10 h-10 rounded-lg overflow-hidden border border-[#C5A059] bg-[#3E2723] flex items-center justify-center text-[#C5A059] font-bold">A</div>
                        </div>
                    </div>
                </div>
            </header>

    <!-- Skeleton Loaders (Hidden by default) -->
    <div id="skeletonLoader" class="hidden p-8 md:p-12 lg:p-20 max-w-6xl mx-auto w-full">
        <div class="mb-12">
            <div class="skeleton skeleton-title mb-4" style="width: 40%;"></div>
            <div class="skeleton skeleton-text" style="width: 60%;"></div>
        </div>

        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 lg:col-span-4 space-y-8">
                <div class="bg-[#3d2b22] p-8 rounded-xl flex flex-col items-center text-center shadow-sm border border-[#4a3a2f]">
                    <div class="skeleton skeleton-profile mx-auto mb-4"></div>
                    <div class="skeleton skeleton-text" style="width: 70%; height: 24px; margin: 0 auto 8px;"></div>
                    <div class="skeleton skeleton-text" style="width: 60%; height: 14px; margin: 0 auto 8px;"></div>
                    <div class="skeleton skeleton-text" style="width: 50%; height: 14px; margin: 0 auto;"></div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-8 space-y-8">
                <div class="bg-[#3d2b22] p-8 rounded-xl shadow-sm border border-[#4a3a2f]">
                    <div class="skeleton skeleton-title mb-8" style="width: 50%;"></div>
                    <div class="space-y-8">
                        <div class="space-y-6">
                            <div class="skeleton skeleton-text" style="width: 30%; height: 18px;"></div>
                            <div class="space-y-4">
                                <div class="skeleton skeleton-input"></div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="skeleton skeleton-input"></div>
                                    <div class="skeleton skeleton-input"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content (Shown by default) -->
    <div id="mainContent" class="p-8 md:p-12 lg:p-20 max-w-6xl mx-auto w-full">
        <div class="mb-12">
            <h3 class="text-4xl md:text-5xl lg:text-6xl font-headline font-bold text-[#E4E0DC] tracking-tight mb-4 leading-tight">Settings</h3>
            <p class="text-[#D1CDC7] max-w-xl text-lg font-body">Manage your account preferences and studio configurations.</p>
        </div>

        <div class="grid grid-cols-12 gap-8">
            <div class="col-span-12 lg:col-span-4 space-y-8">
                <section class="bg-[#3d2b22] p-8 rounded-xl flex flex-col items-center text-center shadow-sm border border-[#4a3a2f]">
                    <div class="relative group mb-4">
                        <img alt="Admin Large" class="w-32 h-32 rounded-full object-cover shadow-sm ring-4 ring-[#C5A059]" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAeZg8-K8uPLWfAPjWetjQg8OgFwc7V5GVKo69YtAiu-3TAYfeYDDkOJd9FePGppepCPlIJluZfVcYy7ts7aMjNyaFLwQIs2_PVx2U86LhAvcdnktDWq0_JlgFPiybyxzaLOoM38ks4oSZAeqYpyF4OPPYza1GJZfCzr44Ms1t3M7zZJvUC8QI3ebw8JbBiT8vX2heUW54X9OF6PSUf7s2Bwb8cbqncEWJMFBzApBu5qsKkVLwyqU7yTi7IQLYgyKPzJJyrgCUqPQ"/>
                        <button class="absolute bottom-0 right-0 bg-[#C5A059] text-[#1A1614] p-2 rounded-full shadow-lg hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-sm">edit</span>
                        </button>
                    </div>
                    <h2 class="text-2xl font-headline text-[#F5F5F0] font-bold">EDPS Admin</h2>
                    <p class="text-[#C5A059] font-medium tracking-wide text-xs mb-1 uppercase">Studio Director</p>
                    <p class="text-[#D1CDC7] text-sm italic font-body">admin@edps.studio</p>
                </section>

                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                          
                            </label>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-span-12 lg:col-span-8 space-y-8">
                <section class="bg-[#3d2b22] p-8 rounded-xl shadow-sm border border-[#4a3a2f]">
                    <h2 class="text-3xl font-headline mb-8 text-[#E4E0DC] leading-tight font-bold">Account Security</h2>
                    <form method="POST">
                        <div class="space-y-8">
                            <div class="space-y-6">
                                <h3 class="font-headline text-md text-[#C5A059] flex items-center gap-2">
                                    <span class="material-symbols-outlined">lock</span> Change Password
                                </h3>
                                <div class="space-y-4">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-bold uppercase tracking-widest text-[#F5F5F0]">Current Password</label>
                                        <input class="w-full bg-[#1c120d] py-3 px-4 rounded-lg border border-[#5a4a3f]/40 focus:ring-1 focus:ring-[#C5A059]/30 transition-all text-[#D1CDC7] placeholder:text-[#D1CDC7]/50" placeholder="••••••••" type="password"/>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-bold uppercase tracking-widest text-[#F5F5F0]">New Password</label>
                                            <input class="w-full bg-[#1c120d] py-3 px-4 rounded-lg border border-[#5a4a3f]/40 focus:ring-1 focus:ring-[#C5A059]/30 transition-all text-[#D1CDC7] placeholder:text-[#D1CDC7]/50" placeholder="••••••••" type="password"/>
                                        </div>
                                        <div class="space-y-2">
                                            <label class="block text-[10px] font-bold uppercase tracking-widest text-[#F5F5F0]">Confirm New Password</label>
                                            <input class="w-full bg-[#1c120d] py-3 px-4 rounded-lg border border-[#5a4a3f]/40 focus:ring-1 focus:ring-[#C5A059]/30 transition-all text-[#D1CDC7] placeholder:text-[#D1CDC7]/50" placeholder="••••••••" type="password"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-[#4a3a2f] pt-8">
                                <h3 class="font-headline text-md mb-4 text-[#E4E0DC]">Studio Profile</h3>
                                <div class="space-y-4 max-w-md">
                                    <div class="space-y-2">
                                        <label class="block text-[10px] font-bold uppercase tracking-widest text-[#F5F5F0]">Studio Name</label>
                                        <input class="w-full bg-[#1c120d] py-3 px-4 rounded-lg border border-[#5a4a3f]/40 focus:ring-1 focus:ring-[#C5A059]/30 transition-all text-[#D1CDC7]" type="text" value="EDPS Studio"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

    <div class="sticky bottom-0 left-0 right-0 p-6 bg-[#1A1614]/95 backdrop-blur-md border-t border-[#2C1A12] z-30">
        <div class="max-w-6xl mx-auto flex justify-end items-center gap-6">
            <button class="text-[#D1CDC7]/70 font-label font-bold text-xs uppercase tracking-widest hover:text-[#D1CDC7] transition-colors">Discard</button>
            <button class="bg-[#C5A059] text-[#1A1614] px-8 py-4 rounded-lg shadow-lg hover:bg-[#D4A76A] active:scale-95 transition-all font-label font-bold text-xs uppercase tracking-widest flex items-center gap-2">
                Save Changes
                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">check_circle</span>
            </button>
        </div>
    </div>
</main>

<script>
// ===== GLOBAL FUNCTIONS =====

// Add page transition listener to show skeleton loading
document.addEventListener('click', function(e) {
  const target = e.target.closest('a');
  if (target && !target.hasAttribute('data-no-transition')) {
    const href = target.getAttribute('href');
    if (href && !href.startsWith('#') && !href.startsWith('javascript:')) {
      // Show skeleton loaders
      const skeletonLoader = document.getElementById('skeletonLoader');
      const mainContent = document.getElementById('mainContent');
      if (skeletonLoader) skeletonLoader.classList.remove('hidden');
      if (mainContent) mainContent.classList.add('hidden');
      
      // Add loading class to prevent white flash
      document.body.classList.add('page-loading');
      // Smooth transition without white flash
      document.documentElement.style.transition = 'none';
    }
  }
});

// Ensure body inherits the correct theme class on load
window.addEventListener('load', function() {
  const html = document.documentElement;
  if (html.classList.contains('light')) {
    document.body.classList.add('light');
  } else {
    document.body.classList.remove('light');
  }
  
  // Hide skeleton loaders and show main content
  const skeletonLoader = document.getElementById('skeletonLoader');
  const mainContent = document.getElementById('mainContent');
  if (skeletonLoader) skeletonLoader.classList.add('hidden');
  if (mainContent) mainContent.classList.remove('hidden');
  
  document.body.classList.remove('page-loading');
});

// Apply theme to body when HTML theme changes
const observer = new MutationObserver(function(mutations) {
  mutations.forEach(function(mutation) {
    if (mutation.attributeName === 'class') {
      const html = document.documentElement;
      if (html.classList.contains('light')) {
        document.body.classList.add('light');
      } else {
        document.body.classList.remove('light');
      }
    }
  });
});

observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

// Theme Toggle Function
function initThemeToggle() {
  const html = document.documentElement;
  const desktopThemeToggle = document.getElementById('desktopThemeToggle');
  const mobileThemeToggle = document.getElementById('mobileThemeToggle');
  
  // Get saved theme or use system preference
  const savedTheme = localStorage.getItem('adminTheme');
  const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const initialTheme = savedTheme || (prefersDark ? 'dark' : 'light');
  
  // Apply initial theme
  if (initialTheme === 'light') {
    html.classList.add('light');
    document.body.classList.add('light');
  } else {
    html.classList.remove('light');
    document.body.classList.remove('light');
  }
  
  // Toggle theme on button click
  const toggleTheme = () => {
    html.classList.toggle('light');
    document.body.classList.toggle('light');
    const isDark = !html.classList.contains('light');
    localStorage.setItem('adminTheme', isDark ? 'dark' : 'light');
  };
  
  if (desktopThemeToggle) {
    desktopThemeToggle.addEventListener('click', toggleTheme);
  }
  if (mobileThemeToggle) {
    mobileThemeToggle.addEventListener('click', toggleTheme);
  }
}

// Global Logout Function
function globalLogout() {
  // Clear localStorage
  localStorage.clear();
  
  // Clear session storage
  sessionStorage.clear();
  
  // Redirect to login page
  window.location.href = 'login.php';
}

// Mobile Drawer Toggle
const mobileMenuToggle = document.getElementById('mobileMenuToggle');
const mobileDrawer = document.getElementById('mobileDrawer');
const mobileDrawerBackdrop = document.getElementById('mobileDrawerBackdrop');
const mobileDrawerSidebar = document.getElementById('mobileDrawerSidebar');
const mobileDrawerClose = document.getElementById('mobileDrawerClose');
const desktopLogout = document.getElementById('desktopLogout');
const mobileDrawerLogout = document.getElementById('mobileDrawerLogout');

// Initialize theme toggle
initThemeToggle();

// Toggle mobile drawer
if (mobileMenuToggle) {
  mobileMenuToggle.addEventListener('click', () => {
    mobileDrawer.classList.remove('hidden');
    setTimeout(() => {
      mobileDrawerSidebar.classList.remove('-translate-x-full');
    }, 10);
  });
}

// Close mobile drawer
if (mobileDrawerClose) {
  mobileDrawerClose.addEventListener('click', closeMobileDrawer);
}

if (mobileDrawerBackdrop) {
  mobileDrawerBackdrop.addEventListener('click', closeMobileDrawer);
}

function closeMobileDrawer() {
  mobileDrawerSidebar.classList.add('-translate-x-full');
  setTimeout(() => {
    mobileDrawer.classList.add('hidden');
  }, 300);
}

// Logout handlers
if (desktopLogout) {
  desktopLogout.addEventListener('click', globalLogout);
}

if (mobileDrawerLogout) {
  mobileDrawerLogout.addEventListener('click', globalLogout);
}

// Close drawer when navigating
document.querySelectorAll('#mobileDrawerSidebar a').forEach(link => {
  link.addEventListener('click', closeMobileDrawer);
});
</script>

</body>
</html>