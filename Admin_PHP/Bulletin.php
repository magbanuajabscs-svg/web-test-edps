<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard - EDPS Studio</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&amp;family=Manrope:wght@400;500;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                <a class="flex items-center gap-4 text-[#F5F5F0] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#2C1A12] transition-colors duration-200 group" href="Bulletin.php">
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
              <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors rounded-lg" href="settings.php">
        <span class="material-symbols-outlined text-[#C5A059]">settings</span>
        <span class="font-medium">Settings</span>
    </a>
                <button id="desktopLogout" class="w-full flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 bg-transparent border-none cursor-pointer">
                    <span class="material-symbols-outlined text-[#C5A059]" data-icon="logout">logout</span>
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
<a class="flex items-center gap-4 text-[#F5F5F0] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#2C1A12] transition-colors duration-200" href="Bulletin.php">
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
<a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors rounded-lg" href="settings.php">
<span class="material-symbols-outlined text-[#C5A059]">settings</span>
<span class="font-medium">Settings</span>
</a>
<button id="mobileDrawerLogout" class="w-full flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 bg-transparent border-none cursor-pointer">
<span class="material-symbols-outlined text-[#C5A059]" data-icon="logout">logout</span>
<span class="font-body font-medium">Logout</span>
</button>
</div>
</aside>
</div>
        <!-- Main Content Area -->
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
            <!-- Dashboard Content -->
            <section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full space-y-8">
                <!-- Header Section -->
                <div class="mb-12">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-headline font-bold text-[#F5F5F0] tracking-tight mb-4 leading-tight">Dashboard</h1>
                    <p class="text-[#D1CDC7] max-w-xl text-lg font-body">Welcome back! Here's an overview of your projects, staff, and studio activity.</p>
                </div>
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="group bg-[#1A1614] hover:bg-[#2C1A12] transition-all duration-300 p-6 rounded-2xl border border-[#2C1A12]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[#D1CDC7] text-sm font-bold uppercase tracking-widest">Total Projects</p>
                                <p class="text-3xl font-bold text-[#C5A059] mt-2" id="total-projects">0</p>
                            </div>
                            <span class="material-symbols-outlined text-[#C5A059] text-3xl">photo_library</span>
                        </div>
                    </div>
                    <div class="group bg-[#1A1614] hover:bg-[#2C1A12] transition-all duration-300 p-6 rounded-2xl border border-[#2C1A12]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[#D1CDC7] text-sm font-bold uppercase tracking-widest">Active Staff</p>
                                <p class="text-3xl font-bold text-[#C5A059] mt-2" id="active-staff">0</p>
                            </div>
                            <span class="material-symbols-outlined text-[#C5A059] text-3xl">group</span>
                        </div>
                    </div>
                    <div class="group bg-[#1A1614] hover:bg-[#2C1A12] transition-all duration-300 p-6 rounded-2xl border border-[#2C1A12]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[#D1CDC7] text-sm font-bold uppercase tracking-widest">Completed</p>
                                <p class="text-3xl font-bold text-[#C5A059] mt-2" id="completed-projects">0</p>
                            </div>
                            <span class="material-symbols-outlined text-[#C5A059] text-3xl">check_circle</span>
                        </div>
                    </div>
                    <div class="group bg-[#1A1614] hover:bg-[#2C1A12] transition-all duration-300 p-6 rounded-2xl border border-[#2C1A12]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-[#D1CDC7] text-sm font-bold uppercase tracking-widest">Pending</p>
                                <p class="text-3xl font-bold text-[#C5A059] mt-2" id="pending-projects">0</p>
                            </div>
                            <span class="material-symbols-outlined text-[#C5A059] text-3xl">schedule</span>
                        </div>
                    </div>
                </div>
                <!-- Recent Projects -->
                <div class="group bg-[#1A1614] hover:bg-[#2C1A12] transition-all duration-300 p-6 rounded-2xl border border-[#2C1A12]">
                    <h2 class="text-2xl font-headline font-bold mb-6 text-[#F5F5F0]">Announcement</h2>
                    <div class="space-y-4" id="recent-projects">
                        <p class="text-[#D1CDC7]">No announcement yet.</p>
                    </div>
                </div>
                <!-- Quick Actions -->
                <div class="group bg-[#1A1614] hover:bg-[#2C1A12] transition-all duration-300 p-6 rounded-2xl border border-[#2C1A12]">
                    <h2 class="text-2xl font-headline font-bold mb-6 text-[#F5F5F0]">Quick Actions</h2>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <button class="px-6 py-4 bg-[#3E2723] text-[#C5A059] rounded-lg font-bold flex items-center justify-center gap-2 hover:bg-[#4A3728] transition-all border border-[#C5A059]" onclick="window.location.href='stafflist.php'">
                            <span class="material-symbols-outlined">add</span>
                            <span>Create Project</span>
                        </button>
                        <button class="px-6 py-4 bg-[#3E2723] text-[#C5A059] rounded-lg font-bold flex items-center justify-center gap-2 hover:bg-[#4A3728] transition-all border border-[#C5A059]" onclick="window.location.href='staffmanage.php'">
                            <span class="material-symbols-outlined">group_add</span>
                            <span>Add Staff</span>
                        </button>
                        <button class="px-6 py-4 bg-[#3E2723] text-[#C5A059] rounded-lg font-bold flex items-center justify-center gap-2 hover:bg-[#4A3728] transition-all border border-[#C5A059]" onclick="window.location.href='webedit.php'">
                            <span class="material-symbols-outlined">edit</span>
                            <span>Edit Website</span>
                        </button>
                        <button class="px-6 py-4 bg-[#3E2723] text-[#C5A059] rounded-lg font-bold flex items-center justify-center gap-2 hover:bg-[#4A3728] transition-all border border-[#C5A059]">
                            <span class="material-symbols-outlined">notifications_active</span>
                            <span>Announcement</span>
                        </button>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script>
        // ===== GLOBAL FUNCTIONS =====
        
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
        
        // Load data from localStorage and update dashboard
        function updateDashboard() {
            const staff = JSON.parse(localStorage.getItem('staff') || '[]');
            const projects = JSON.parse(localStorage.getItem('projects') || '[]');

            document.getElementById('active-staff').textContent = staff.length;
            document.getElementById('total-projects').textContent = projects.length;
            document.getElementById('completed-projects').textContent = projects.filter(p => p.status === 'completed').length;
            document.getElementById('pending-projects').textContent = projects.filter(p => p.status === 'pending').length;

            // Recent projects
            const recentProjectsDiv = document.getElementById('recent-projects');
            if (projects.length > 0) {
                recentProjectsDiv.innerHTML = projects.slice(0, 3).map(project => `
                    <div class="flex items-center justify-between p-4 bg-[#2C1A12] rounded-2xl border border-[#2C1A12]">
                        <div>
                            <h3 class="font-bold text-[#F5F5F0]">${project.name || 'Unnamed Project'}</h3>
                            <p class="text-[#D1CDC7] text-sm">${project.description || 'No description'}</p>
                        </div>
                        <span class="px-3 py-1 bg-[#3E2723] text-[#C5A059] text-xs rounded-full border border-[#C5A059]">${project.status || 'pending'}</span>
                    </div>
                `).join('');
            }
        }

        // Initialize dashboard
        updateDashboard();
    </script>
</body>
</html>

