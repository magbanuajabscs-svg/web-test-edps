  <!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Website CMS - EDPS Studio</title>
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
                <a class="flex items-center gap-4 text-[#F5F5F0] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#2C1A12] transition-colors duration-200 group" href="webedit.php">
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
<a class="flex items-center gap-4 text-[#F5F5F0] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#2C1A12] transition-colors duration-200" href="webedit.php">
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
<main class="flex-1 flex flex-col min-w-0">
            <!-- TopAppBar -->
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
<!-- Content Canvas -->
<section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full">
<div class="space-y-12">
<!-- Section 1A: Announcement Ticker -->
<section class="bg-[#1A1614] p-8 rounded-3xl relative group hover:shadow-lg hover:shadow-[#C5A059]/40 transition-all duration-300 border-2 border-[#C5A059]">
<div class="flex justify-between items-start mb-8">
<div>
<div class="flex items-center space-x-2 text-[#C5A059] text-xs font-bold uppercase tracking-widest mb-2">
<span class="material-symbols-outlined text-base" data-icon="notifications_active">notifications_active</span>
<span>High Alert</span>
</div>
<div class="flex items-center gap-3">
<h2 class="font-serif text-2xl text-[#F5F5F0]">Announcement Ticker</h2>
<span class="px-2 py-1 bg-[#C5A059] text-[#12100E] text-[10px] font-bold uppercase tracking-widest rounded-full">ACTIVE</span>
</div>
<p class="text-xs text-[#D1CDC7] mt-2">This appears as a thin bar at the very top of the landing page.</p>
</div>
<div class="flex items-center gap-3">
<a href="announcements_manager.php" class="flex items-center space-x-1 px-4 py-2 border-2 border-[#C5A059] rounded-lg text-sm font-bold text-[#C5A059] hover:bg-[#C5A059]/10 transition-all">
<span class="material-symbols-outlined text-sm" data-icon="list">list</span>
<span>Manage Announcement</span>
</a>
<button class="flex items-center space-x-1 px-4 py-2 bg-[#C5A059] rounded-lg text-sm font-bold text-[#12100E] hover:shadow-md transition-all" id="announcementSaveBtn">
<span class="material-symbols-outlined text-sm" data-icon="save">save</span>
<span>Save Announcement</span>
</button>
</div>
</div>
<div class="space-y-6">
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<div>
<label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-2">Announcement Category</label>
<input class="w-full bg-[#2d2825]/50 border border-[#C5A059]/30 focus:border-[#C5A059] focus:ring-1 focus:ring-[#C5A059]/30 p-4 rounded-lg text-[#F5F5F0] placeholder-[#D1CDC7]/40 transition-colors" type="text" id="announcementCategory" value="WEDDING FAIR" placeholder="e.g., WEDDING FAIR" onchange="document.body.setAttribute('data-announcement-unsaved', 'true')"/>
</div>
<div>
<label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-2">Announcement Title</label>
<input class="w-full bg-[#2d2825]/50 border border-[#C5A059]/30 focus:border-[#C5A059] focus:ring-1 focus:ring-[#C5A059]/30 p-4 rounded-lg text-[#F5F5F0] placeholder-[#D1CDC7]/40 transition-colors" type="text" id="announcementTitle" value="With you, even silence feels warm" placeholder="e.g., With you, even silence feels warm" onchange="document.body.setAttribute('data-announcement-unsaved', 'true')"/>
</div>
</div>
<div>
<label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-2">Announcement Description</label>
<textarea class="w-full bg-[#2d2825]/50 border border-[#C5A059]/30 focus:border-[#C5A059] focus:ring-1 focus:ring-[#C5A059]/30 p-4 rounded-lg text-[#F5F5F0] placeholder-[#D1CDC7]/40 transition-colors resize-none" id="announcementDescription" rows="4" placeholder="e.g., EDPS Studio showcases the warmth and intimacy of genuine moments captured through our lens..." onchange="document.body.setAttribute('data-announcement-unsaved', 'true')">EDPS Studio showcases the warmth and intimacy of genuine moments captured through our lens...</textarea>
</div>
<div>
<label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-3">Announcement Image</label>
<div class="space-y-4">
<div class="relative">
<div class="w-full h-48 rounded-lg border-2 border-dashed border-[#C5A059]/40 overflow-hidden bg-[#2d2825]/30 flex items-center justify-center">
<img id="announcementImagePreview" src="" class="w-full h-full object-cover hidden" alt="Announcement Preview"/>
<div id="announcementImagePlaceholder" class="flex flex-col items-center justify-center text-center">
<span class="material-symbols-outlined text-[#C5A059] text-3xl mb-2">image</span>
<p class="text-xs text-[#D1CDC7]/60">No image uploaded</p>
</div>
</div>
</div>
<div class="flex gap-3">
<label class="flex-1 px-6 py-3 bg-[#2d2825]/50 border border-[#C5A059]/30 rounded-lg text-sm font-bold text-[#C5A059] cursor-pointer hover:bg-[#C5A059]/5 hover:border-[#C5A059]/50 transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-base">photo_camera</span>
<span>Upload Announcement Image</span>
<input type="file" id="announcementImageInput" accept="image/*" class="hidden" onchange="handleAnnouncementImageUpload(event)"/>
</label>
</div>
<p class="text-[10px] text-[#D1CDC7]/60">Recommended: 1200x630px · Max 5MB · JPG, PNG supported</p>
</div>
</div>
<div class="flex items-center justify-between bg-[#2d2825]/50 p-4 rounded-lg border border-[#C5A059]/20">
<div>
<label class="text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-1 block">Display Status</label>
<p class="text-sm text-[#D1CDC7]">Show this announcement on the landing page</p>
</div>
<div class="flex items-center space-x-2 ml-4">
<input type="checkbox" id="announcementToggle" checked onchange="document.body.setAttribute('data-announcement-unsaved', 'true')" class="w-5 h-5 rounded cursor-pointer accent-[#C5A059]"/>
<label for="announcementToggle" class="text-sm font-bold text-[#F5F5F0] cursor-pointer">
<span id="toggleLabel" class="text-[#C5A059]">Visible</span>
</label>
</div>
</div>
</div>
</section>

<!-- Section 1B: Hero Visuals -->
<section class="bg-[#1A1614] p-8 rounded-3xl relative group hover:shadow-lg hover:shadow-[#C5A059]/20 transition-all duration-300">
<div class="flex justify-between items-start mb-8">
<div>
<div class="flex items-center space-x-2 text-[#C5A059] text-xs font-bold uppercase tracking-widest mb-2">
<span class="material-symbols-outlined text-base" data-icon="home">home</span>
<span>Home Hero Section</span>
</div>
<div class="flex items-center gap-3">
<h2 class="font-serif text-2xl text-[#F5F5F0]">Hero Visuals</h2>
<span class="px-2 py-1 bg-[#C5A059] text-[#12100E] text-[10px] font-bold uppercase tracking-widest rounded-full">ACTIVE</span>
</div>
</div>
<button class="flex items-center space-x-1 px-4 py-2 bg-[#C5A059] rounded-lg text-sm font-bold text-[#12100E] hover:shadow-md transition-all" id="heroSaveBtn">
<span class="material-symbols-outlined text-sm" data-icon="save">save</span>
<span>Save Hero</span>
</button>
</div>
<div class="space-y-6">
<div>
<label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-2">Main Headline</label>
<input class="w-full bg-[#2d2825]/50 border border-[#C5A059]/20 focus:border-[#C5A059] focus:ring-1 focus:ring-[#C5A059]/30 p-4 rounded-lg text-[#F5F5F0] placeholder-[#D1CDC7]/40 transition-colors" type="text" id="heroHeadline" value="Capturing the Essence of Now" onchange="document.body.setAttribute('data-hero-unsaved', 'true')"/>
</div>
<div>
<label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-3">Hero Banner Image</label>
<div class="space-y-4">
<div class="relative">
<div class="w-full h-64 rounded-3xl border-2 border-dashed border-[#C5A059]/40 overflow-hidden bg-[#2d2825]/30">
<img id="heroImagePreview" src="https://scontent.fmnl44-1.fna.fbcdn.net/v/t1.6435-9/180213608_3784252291679723_1672327313611677638_n.jpg" class="w-full h-full object-cover" alt="Hero Banner Preview"/>
</div>
</div>
<div class="flex gap-3">
<label class="flex-1 px-6 py-3 bg-[#2d2825]/50 border border-[#C5A059]/30 rounded-lg text-sm font-bold text-[#C5A059] cursor-pointer hover:bg-[#C5A059]/5 hover:border-[#C5A059]/50 transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-base">add_a_photo</span>
<span>Upload New Image</span>
<input type="file" id="heroImageInput" accept="image/*" class="hidden" onchange="handleHeroImageUpload(event)"/>
</label>
<button class="px-6 py-3 border border-[#C5A059]/20 rounded-lg text-sm font-bold text-[#D1CDC7] hover:border-[#C5A059]/50 hover:text-[#C5A059] transition-all">
<span class="material-symbols-outlined">delete</span>
</button>
</div>
<p class="text-[10px] text-[#D1CDC7]/60">Recommended: 1920x1080px (16:9 ratio) · Max 5MB · JPG, PNG supported</p>
</div>
</div>
</section>
<!-- Section 2: Curated Collections -->
<section class="bg-[#1A1614] p-8 rounded-3xl hover:shadow-lg hover:shadow-[#C5A059]/20 transition-all duration-300">
<div class="flex justify-between items-start mb-8">
<div>
<div class="flex items-center space-x-2 text-[#C5A059] text-xs font-bold uppercase tracking-widest mb-2">
<span class="material-symbols-outlined text-base" data-icon="collections">collections</span>
<span>Home Section 2</span>
</div>
<div class="flex items-center gap-3">
<h2 class="font-serif text-2xl text-[#F5F5F0]">Curated Collections</h2>
<span class="px-2 py-1 bg-[#C5A059] text-[#12100E] text-[10px] font-bold uppercase tracking-widest rounded-full">ACTIVE</span>
</div>
</div>
<div class="flex space-x-3">
<button id="addCategoryBtn" class="flex items-center space-x-1 px-4 py-2 border border-[#C5A059]/30 rounded-lg text-sm font-bold text-[#C5A059] hover:bg-[#C5A059]/5 transition-colors">
<span class="material-symbols-outlined text-sm" data-icon="add">add</span>
<span>Add Category</span>
</button>
<button id="saveCategoriesBtn" class="flex items-center space-x-1 px-4 py-2 bg-[#C5A059] rounded-lg text-sm font-bold text-[#12100E] hover:shadow-md transition-all">
<span class="material-symbols-outlined text-sm" data-icon="save">save</span>
<span>Save Collections</span>
</button>
</div>
</div>
<div id="categoriesGrid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
<!-- Categories will be dynamically inserted here -->
</div>
</section>
<!-- Section 3: Tailored Experiences -->
<section class="bg-[#1A1614] p-8 rounded-3xl hover:shadow-lg hover:shadow-[#C5A059]/20 transition-all duration-300">
<div class="flex justify-between items-start mb-8">
<div>
<div class="flex items-center space-x-2 text-[#C5A059] text-xs font-bold uppercase tracking-widest mb-2">
<span class="material-symbols-outlined text-base" data-icon="payments">payments</span>
<span>Home Section 3</span>
</div>
<div class="flex items-center gap-3">
<h2 class="font-serif text-2xl text-[#F5F5F0]">Tailored Experiences</h2>
<span class="px-2 py-1 bg-[#C5A059] text-[#12100E] text-[10px] font-bold uppercase tracking-widest rounded-full">ACTIVE</span>
</div>
<p class="text-xs text-[#D1CDC7] mt-2">Click on any package title to manage its pricing and inclusions.</p>
</div>
<div class="flex space-x-3">
<button id="packageSaveBtn" class="flex items-center space-x-1 px-4 py-2 bg-[#C5A059] rounded-lg text-sm font-bold text-[#12100E] hover:shadow-md transition-all">
<span class="material-symbols-outlined text-sm" data-icon="save">save</span>
<span>Save Packages</span>
</button>
</div>
</div>
<!-- Package List -->
<div id="packagesList" class="space-y-2 mb-6">
<!-- Package items will be dynamically inserted here -->
</div>
<button id="addPackageBtn" class="w-full py-4 border-2 border-dashed border-[#C5A059]/30 rounded-lg text-sm font-bold text-[#D1CDC7] hover:border-[#C5A059]/50 hover:text-[#C5A059] transition-all flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-lg" data-icon="add_circle">add_circle</span>
<span>+ Add Package Option</span>
</button>
</section>
<!-- Section 4: Let's Create Together / Connect -->
<section class="bg-[#1A1614] p-8 rounded-3xl hover:shadow-lg hover:shadow-[#C5A059]/20 transition-all duration-300" id="section4Container">
<div class="flex justify-between items-start mb-8">
<div>
<div class="flex items-center space-x-2 text-[#C5A059] text-xs font-bold uppercase tracking-widest mb-2">
<span class="material-symbols-outlined text-base" data-icon="mail">mail</span>
<span>Home Section 4</span>
</div>
<div class="flex items-center gap-3">
<h2 class="font-serif text-2xl text-[#F5F5F0]">Connect With Us</h2>
<span class="px-2 py-1 bg-[#C5A059] text-[#12100E] text-[10px] font-bold uppercase tracking-widest rounded-full">ACTIVE</span>
</div>
</div>
<div class="flex space-x-3">
<!-- Edit/Cancel Button -->
<button id="section4EditBtn" class="flex items-center space-x-1 px-4 py-2 border border-[#C5A059]/30 rounded-lg text-sm font-bold text-[#C5A059] hover:bg-[#C5A059]/10 transition-all">
<span class="material-symbols-outlined text-sm" data-icon="edit">edit</span>
<span>Edit</span>
</button>
<!-- Save Button -->
<button id="section4SaveBtn" class="flex items-center space-x-1 px-4 py-2 bg-[#C5A059] rounded-lg text-sm font-bold text-[#12100E] hover:shadow-md transition-all disabled:opacity-50 disabled:cursor-not-allowed" disabled>
<span class="material-symbols-outlined text-sm" data-icon="save">save</span>
<span>Save Section</span>
</button>
</div>
</div>

<div class="space-y-6">
<!-- Section Title Input -->
<div>
<label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-2">Section Title</label>
<input id="section4Title" class="section4-input w-full bg-[#2d2825]/50 border border-[#C5A059]/20 focus:border-[#C5A059] focus:ring-1 focus:ring-[#C5A059]/30 p-4 rounded-lg text-[#F5F5F0] placeholder-[#D1CDC7]/40 font-bold text-lg transition-colors opacity-60 disabled:cursor-not-allowed" type="text" value="Let's Create Together" placeholder="e.g., Let's Create Together" disabled onchange="document.body.setAttribute('data-section4-unsaved', 'true')"/>
</div>

<!-- Section Description -->
<div>
<label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-2">Section Description</label>
<textarea id="section4Description" class="section4-input w-full bg-[#2d2825]/50 border border-[#C5A059]/20 focus:border-[#C5A059] focus:ring-1 focus:ring-[#C5A059]/30 p-4 rounded-lg text-[#F5F5F0] placeholder-[#D1CDC7]/40 transition-colors resize-none opacity-60 disabled:cursor-not-allowed" rows="4" placeholder="e.g., Connect with us on social media to stay updated with our latest projects and offerings..." disabled onchange="document.body.setAttribute('data-section4-unsaved', 'true')">Have questions or ready to discuss your next project? Reach out to us on social media or send us a message directly.</textarea>
</div>

<!-- Social Media Links -->
<div>
<label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-3">Social Media Links</label>
<div class="space-y-3">
<!-- Instagram -->
<div class="flex items-center space-x-3 bg-[#2d2825]/50 p-4 rounded-lg border border-[#C5A059]/20 transition-all opacity-60" id="instagramContainer">
<svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 24 24" fill="none">
<defs>
<linearGradient id="instagramGradient" x1="0%" y1="100%" x2="100%" y2="0%">
<stop offset="0%" style="stop-color:#FD5949;stop-opacity:1" />
<stop offset="5%" style="stop-color:#D6249F;stop-opacity:1" />
<stop offset="45%" style="stop-color:#D6249F;stop-opacity:1" />
<stop offset="60%" style="stop-color:#962FBF;stop-opacity:1" />
<stop offset="90%" style="stop-color:#4F63F7;stop-opacity:1" />
</linearGradient>
</defs>
<path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.117.6c-.779.267-1.459.645-2.228 1.414-.768.769-1.147 1.448-1.414 2.228-.267.779-.467 1.649-.527 2.927C.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.527 2.927.267.79.645 1.469 1.414 2.228.768.768 1.448 1.146 2.228 1.413.778.267 1.649.467 2.927.527 1.27.06 1.677.072 4.947.072s3.667-.015 4.947-.072c1.277-.06 2.148-.26 2.927-.527.79-.267 1.469-.645 2.228-1.413.768-.769 1.146-1.448 1.413-2.228.267-.779.467-1.649.527-2.927.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.26-2.148-.527-2.927-.267-.79-.645-1.469-1.413-2.228-.769-.768-1.448-1.147-2.228-1.414-.779-.267-1.649-.467-2.927-.527C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.009 4.849.070 1.171.054 1.805.244 2.227.408.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.354 1.057.408 2.227.061 1.264.07 1.646.07 4.849 0 3.203-.009 3.585-.07 4.849-.054 1.171-.244 1.805-.408 2.227-.217.562-.477.96-.896 1.382-.42.419-.819.679-1.381.896-.422.164-1.057.354-2.227.408-1.264.061-1.646.07-4.849.07-3.203 0-3.585-.009-4.849-.07-1.171-.054-1.805-.244-2.227-.408-.562-.217-.96-.477-1.382-.896-.419-.42-.679-.819-.896-1.381-.164-.422-.354-1.057-.408-2.227-.061-1.264-.07-1.646-.07-4.849 0-3.203.009-3.585.07-4.849.054-1.171.244-1.805.408-2.227.217-.562.477-.96.896-1.382.42-.419.819-.679 1.381-.896.422-.164 1.057-.354 2.227-.408 1.264-.061 1.646-.07 4.849-.07zM5.838 12a6.162 6.162 0 1 1 12.324 0 6.162 6.162 0 0 1-12.324 0zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm4.965-10.322a1.44 1.44 0 1 1 2.881.001 1.44 1.44 0 0 1-2.881-.001z" fill="url(#instagramGradient)"/>
</svg>
<span class="text-sm font-bold text-[#C5A059] min-w-[80px]">Instagram</span>
<input id="instagramUrl" class="section4-input flex-1 bg-transparent border-none text-sm text-[#F5F5F0] focus:ring-0 placeholder-[#D1CDC7]/40 outline-none disabled:cursor-not-allowed" placeholder="https://instagram.com/your_handle" type="text" value="https://instagram.com/edps.studio" disabled onchange="document.body.setAttribute('data-section4-unsaved', 'true')"/>
</div>
<!-- Facebook -->
<div class="flex items-center space-x-3 bg-[#2d2825]/50 p-4 rounded-lg border border-[#C5A059]/20 transition-all opacity-60" id="facebookContainer">
<svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 24 24" fill="#1877F2">
<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
</svg>
<span class="text-sm font-bold text-[#C5A059] min-w-[80px]">Facebook</span>
<input id="facebookUrl" class="section4-input flex-1 bg-transparent border-none text-sm text-[#F5F5F0] focus:ring-0 placeholder-[#D1CDC7]/40 outline-none disabled:cursor-not-allowed" placeholder="https://facebook.com/your_page" type="text" value="" disabled onchange="document.body.setAttribute('data-section4-unsaved', 'true')"/>
</div>
<!-- TikTok -->
<div class="flex items-center space-x-3 bg-[#2d2825]/50 p-4 rounded-lg border border-[#C5A059]/20 transition-all opacity-60" id="tiktokContainer">
<svg class="w-6 h-6 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
<defs>
<filter id="tiktokChromatic">
<feOffset in="SourceGraphic" dx="0.5" dy="0" result="offsetCyan"/>
<feOffset in="SourceGraphic" dx="-0.5" dy="0" result="offsetMagenta"/>
<feFlood flood-color="#00D9FF" flood-opacity="0.8" result="cyanColor"/>
<feComposite in="cyanColor" in2="offsetCyan" operator="in" result="cyanLayer"/>
<feFlood flood-color="#FF2D7C" flood-opacity="0.8" result="magentaColor"/>
<feComposite in="magentaColor" in2="offsetMagenta" operator="in" result="magentaLayer"/>
<feComposite in="cyanLayer" in2="magentaLayer" operator="screen" result="aberration"/>
</filter>
</defs>
<!-- Chromatic aberration layers -->
<g opacity="0.6">
<path d="M 8 4 L 8 16 Q 8 18 10 18 L 14 18 Q 16 18 16 16 L 16 7 Q 16 5.5 14.5 4.5 L 10 4 L 8 4" stroke="#00D9FF" stroke-width="1.2" fill="none" transform="translate(0.3, 0)"/>
<path d="M 8 4 L 8 16 Q 8 18 10 18 L 14 18 Q 16 18 16 16 L 16 7 Q 16 5.5 14.5 4.5 L 10 4 L 8 4" stroke="#FF2D7C" stroke-width="1.2" fill="none" transform="translate(-0.3, 0)"/>
</g>
<!-- Main white note glyph -->
<path d="M 8 4 L 8 16 Q 8 18 10 18 L 14 18 Q 16 18 16 16 L 16 7 Q 16 5.5 14.5 4.5 L 10 4 L 8 4" stroke="white" stroke-width="1.3" fill="none"/>
<!-- Note head circle -->
<circle cx="9" cy="16.5" r="2" fill="white" stroke="none"/>
<!-- Top flag bars for musical note -->
<line x1="16" y1="7" x2="18" y2="5" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
<line x1="16" y1="8.5" x2="18" y2="6.5" stroke="white" stroke-width="1.2" stroke-linecap="round"/>
</svg>
<span class="text-sm font-bold text-[#C5A059] min-w-[80px]">TikTok</span>
<input id="tiktokUrl" class="section4-input flex-1 bg-transparent border-none text-sm text-[#F5F5F0] focus:ring-0 placeholder-[#D1CDC7]/40 outline-none disabled:cursor-not-allowed" placeholder="https://tiktok.com/@your_handle" type="text" value="" disabled onchange="document.body.setAttribute('data-section4-unsaved', 'true')"/>
</div>
</div>
</div>

</div>
</section>
</div>
<footer class="mt-16 pt-8 border-t border-[#3a3430] flex justify-between items-center text-xs text-[#D1CDC7]">
<p>© 2024 EDPS Studio · Curated Editorial Design System</p>
<div class="flex space-x-6">
<a class="hover:text-[#C5A059]" href="#">Help Center</a>
<a class="hover:text-[#C5A059]" href="#">Style Guide</a>
<a class="hover:text-[#C5A059]" href="#">API Docs</a>
</div>
</footer>
</section>

<!-- Global Save Button -->
<div id="globalSaveButton" class="fixed bottom-8 right-8 hidden z-50 animate-pulse">
<button class="flex items-center gap-2 px-6 py-3 bg-[#C5A059] text-[#12100E] font-bold rounded-lg shadow-2xl shadow-[#C5A059]/40 hover:shadow-[#C5A059]/60 hover:scale-105 transition-all">
<span class="material-symbols-outlined">save</span>
<span>Save Changes</span>
</button>
</div>

<script>
// Announcement Toggle Switch Logic
const announcementToggle = document.getElementById('announcementToggle');
const toggleLabel = document.getElementById('toggleLabel');

announcementToggle.addEventListener('change', () => {
  toggleLabel.textContent = announcementToggle.checked ? 'Visible' : 'Hidden';
  toggleLabel.style.color = announcementToggle.checked ? '#C5A059' : '#D1CDC7';
  document.body.setAttribute('data-announcement-unsaved', 'true');
});

// Hero Image Upload Handler
function handleHeroImageUpload(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      document.getElementById('heroImagePreview').src = e.target.result;
      document.body.setAttribute('data-hero-unsaved', 'true');
    };
    reader.readAsDataURL(file);
  }
}

// Announcement Image Upload Handler
function handleAnnouncementImageUpload(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      const preview = document.getElementById('announcementImagePreview');
      const placeholder = document.getElementById('announcementImagePlaceholder');
      preview.src = e.target.result;
      preview.classList.remove('hidden');
      placeholder.classList.add('hidden');
      document.body.setAttribute('data-announcement-unsaved', 'true');
    };
    reader.readAsDataURL(file);
  }
}

// Announcement Section Save Button
document.getElementById('announcementSaveBtn').addEventListener('click', () => {
  const category = document.getElementById('announcementCategory').value;
  const title = document.getElementById('announcementTitle').value;
  const description = document.getElementById('announcementDescription').value;
  const imageData = document.getElementById('announcementImagePreview').src;
  const isVisible = document.getElementById('announcementToggle').checked;
  
  console.log('Saving Announcement:', { category, title, description, hasImage: !!imageData, isVisible });
  document.body.setAttribute('data-announcement-unsaved', 'false');
  
  // Show success feedback
  showSuccessNotification('Announcement updated successfully!');
});

// Hero Section Save Button
document.getElementById('heroSaveBtn').addEventListener('click', () => {
  const headline = document.getElementById('heroHeadline').value;
  const imageData = document.getElementById('heroImagePreview').src;
  
  console.log('Saving Hero Section:', { headline, hasImage: !!imageData });
  document.body.setAttribute('data-hero-unsaved', 'false');
  
  // Show success feedback
  showSuccessNotification('Hero section updated successfully!');
});

// Section 4 (Connect) Edit/Cancel Toggle Logic
let section4OriginalValues = {};
let section4IsEditMode = false;

const section4EditBtn = document.getElementById('section4EditBtn');
const section4SaveBtn = document.getElementById('section4SaveBtn');
const section4Inputs = document.querySelectorAll('.section4-input');

// Toggle Edit Mode
section4EditBtn.addEventListener('click', () => {
  if (!section4IsEditMode) {
    // Enter edit mode
    section4IsEditMode = true;
    
    // Store original values
    section4OriginalValues = {
      title: document.getElementById('section4Title').value,
      description: document.getElementById('section4Description').value,
      instagramUrl: document.getElementById('instagramUrl').value,
      facebookUrl: document.getElementById('facebookUrl').value,
      tiktokUrl: document.getElementById('tiktokUrl').value
    };
    
    // Enable all inputs
    section4Inputs.forEach(input => {
      input.disabled = false;
      input.classList.add('!opacity-100');
    });
    
    // Update containers opacity
    document.getElementById('instagramContainer').classList.add('!opacity-100');
    document.getElementById('facebookContainer').classList.add('!opacity-100');
    document.getElementById('tiktokContainer').classList.add('!opacity-100');
    
    // Update button state
    section4EditBtn.textContent = 'Cancel';
    section4EditBtn.querySelector('span:first-child').textContent = 'close';
    section4EditBtn.classList.add('border-[#ff6b6b]', 'text-[#ff6b6b]', 'hover:bg-[#ff6b6b]/10');
    section4SaveBtn.disabled = false;
    section4SaveBtn.classList.remove('disabled:opacity-50', 'disabled:cursor-not-allowed');
  } else {
    // Exit edit mode (Cancel)
    section4IsEditMode = false;
    
    // Revert to original values
    document.getElementById('section4Title').value = section4OriginalValues.title;
    document.getElementById('section4Description').value = section4OriginalValues.description;
    document.getElementById('instagramUrl').value = section4OriginalValues.instagramUrl;
    document.getElementById('facebookUrl').value = section4OriginalValues.facebookUrl;
    document.getElementById('tiktokUrl').value = section4OriginalValues.tiktokUrl;
    
    // Disable all inputs
    section4Inputs.forEach(input => {
      input.disabled = true;
      input.classList.remove('!opacity-100');
    });
    
    // Update containers opacity
    document.getElementById('instagramContainer').classList.remove('!opacity-100');
    document.getElementById('facebookContainer').classList.remove('!opacity-100');
    document.getElementById('tiktokContainer').classList.remove('!opacity-100');
    
    // Update button state
    section4EditBtn.textContent = 'Edit';
    section4EditBtn.querySelector('span:first-child').textContent = 'edit';
    section4EditBtn.classList.remove('border-[#ff6b6b]', 'text-[#ff6b6b]', 'hover:bg-[#ff6b6b]/10');
    section4SaveBtn.disabled = true;
    section4SaveBtn.classList.add('disabled:opacity-50', 'disabled:cursor-not-allowed');
    
    // Clear unsaved flag
    document.body.setAttribute('data-section4-unsaved', 'false');
  }
});

// Section 4 (Connect) Save Button
section4SaveBtn.addEventListener('click', () => {
  const title = document.getElementById('section4Title').value;
  const description = document.getElementById('section4Description').value;
  const instagramUrl = document.getElementById('instagramUrl').value;
  const facebookUrl = document.getElementById('facebookUrl').value;
  const tiktokUrl = document.getElementById('tiktokUrl').value;
  
  console.log('Saving Section 4:', { 
    title, 
    description, 
    socials: { instagram: instagramUrl, facebook: facebookUrl, tiktok: tiktokUrl }
  });
  
  // Store in localStorage
  localStorage.setItem('section4Data', JSON.stringify({
    title,
    description,
    instagramUrl,
    facebookUrl,
    tiktokUrl
  }));
  
  document.body.setAttribute('data-section4-unsaved', 'false');
  
  // Exit edit mode
  section4IsEditMode = false;
  
  // Disable all inputs
  section4Inputs.forEach(input => {
    input.disabled = true;
    input.classList.remove('!opacity-100');
  });
  
  // Update containers opacity
  document.getElementById('instagramContainer').classList.remove('!opacity-100');
  document.getElementById('facebookContainer').classList.remove('!opacity-100');
  document.getElementById('tiktokContainer').classList.remove('!opacity-100');
  
  // Update button state
  section4EditBtn.textContent = 'Edit';
  section4EditBtn.querySelector('span:first-child').textContent = 'edit';
  section4EditBtn.classList.remove('border-[#ff6b6b]', 'text-[#ff6b6b]', 'hover:bg-[#ff6b6b]/10');
  section4SaveBtn.disabled = true;
  section4SaveBtn.classList.add('disabled:opacity-50', 'disabled:cursor-not-allowed');
  
  // Show success feedback
  showSuccessNotification('Section updated successfully!');
});

// Success Notification
function showSuccessNotification(message) {
  const notification = document.createElement('div');
  notification.className = 'fixed bottom-8 right-8 px-6 py-3 bg-[#C5A059] text-[#12100E] font-bold rounded-lg shadow-2xl shadow-[#C5A059]/40 animate-pulse z-50';
  notification.textContent = message;
  document.body.appendChild(notification);
  
  setTimeout(() => {
    notification.remove();
  }, 2000);
}

// Global Save Button Logic
const body = document.body;
const globalSaveButton = document.getElementById('globalSaveButton');

// Show/hide global save button based on any unsaved data
const observer = new MutationObserver(() => {
  const hasUnsaved = 
    body.getAttribute('data-announcement-unsaved') === 'true' ||
    body.getAttribute('data-hero-unsaved') === 'true' ||
    body.getAttribute('data-section4-unsaved') === 'true' ||
    body.getAttribute('data-unsaved') === 'true';
  
  if (hasUnsaved) {
    globalSaveButton.classList.remove('hidden');
  } else {
    globalSaveButton.classList.add('hidden');
  }
});

observer.observe(body, { attributes: true, attributeFilter: ['data-announcement-unsaved', 'data-hero-unsaved', 'data-section4-unsaved', 'data-unsaved'] });

// Handle global save button click
globalSaveButton.addEventListener('click', () => {
  document.getElementById('announcementSaveBtn').click();
  document.getElementById('heroSaveBtn').click();
  document.getElementById('section4SaveBtn').click();
  body.setAttribute('data-announcement-unsaved', 'false');
  body.setAttribute('data-hero-unsaved', 'false');
  body.setAttribute('data-section4-unsaved', 'false');
  body.setAttribute('data-unsaved', 'false');
  globalSaveButton.classList.add('hidden');
});

// Listen for input changes
document.querySelectorAll('input, textarea').forEach(element => {
  element.addEventListener('change', () => {
    body.setAttribute('data-unsaved', 'true');
  });
});

// ====== CURATED COLLECTIONS CATEGORY MANAGEMENT ======

// Initialize categories from localStorage or use defaults
let categories = JSON.parse(localStorage.getItem('curatedCategories')) || [
  { id: 1, name: 'Weddings', thumbnail: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBRH57CvbM3V0nk7LI5Pmhb48kPrB9o7tHIcaOjEmcSJd1gE5OeDey2WTMZoro8FatD_cNSzqK9C2PdAQNrbNSl9WGky9ZFZMXNUsAdQLx46T4FcHsPuVDVv98jsQdnAtyVgMdRpYJ1RzvZRm33mbUMD2hHxC9UtpTAHQ6l_qeBg-zzJ2kCf641yDTdjbw4vk3hWrslw7bVPkrGUM4MufLLjlQoSWi29HASutasGcYd1oWcCnMv__B7pM8tkoK1o-IWwScLLIrGVg' },
  { id: 2, name: 'Corporate', thumbnail: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBcrRg24L0DdHl4F3QmjM4gL32ctSJW04FL6REkcmp-cjbqX5ycl9m4jsDf1h9xDafmQwiwWDjfKra69MuzVp96CR8gG8Vyf_Nmig6Fuvb2rmHTLzt3-f9QSsZ8uKmdsSWiUk9FJ4VUdwEOwyX85ywYPGbug_-iQx152Arhpztqglyp1WbBmlaA_iqYUPFRiEcQmyVuTlEg9Y3yPQYyNNGvncOdHnkpeMKbVafSKXEcVHwX5RhGEr69nvNRK3Jar_kdsG0Lst1pCA' },
  { id: 3, name: 'Fine Art', thumbnail: 'https://lh3.googleusercontent.com/aida-public/AB6AXuD6QrK613XwTq1oVzszEh5R30Fp-4iUr5SraTbqtl8GY1KuaxVzxLyB01j-Lz6KOJQhzsJSFn3La_Wo2oUH3tkOoFw0SnIn4a4ZnYw2JsCgbkXdZTnOWme0Zs48zkjaO0vPCP2_K997-MtPOJylY0WR5VAoH0L30JZM15oxuQVA7Sqzv27ymgnpYoUJ9z1i6O01nBpzcwxciYTLN5rZqUvuV7nnWAVitsYBvinrUi3qWspReNdNE48DvrZuWAIsjacOWPI3oKfW6Q' }
];

// Render categories grid
function renderCategories() {
  const grid = document.getElementById('categoriesGrid');
  grid.innerHTML = categories.map(cat => `
    <div class="space-y-4 flex flex-col items-center group p-4 rounded-lg hover:bg-[#2C1A12]/30 transition-all relative">
      <div class="w-32 h-32 rounded-full overflow-hidden border-3 border-[#C5A059] flex-shrink-0 relative group/img cursor-pointer shadow-lg shadow-[#C5A059]/20 hover:shadow-[#C5A059]/40 transition-all" onclick="navigateToGallery(${cat.id}, '${cat.name}')">
        <img alt="${cat.name}" class="w-full h-full object-cover" src="${cat.thumbnail}"/>
        <div class="absolute inset-0 bg-[#C5A059]/20 flex flex-col items-center justify-center opacity-0 group-hover/img:opacity-100 transition-opacity gap-2">
          <span class="material-symbols-outlined text-[#C5A059] text-2xl">image_search</span>
          <span class="text-[#C5A059] text-xs font-bold">Manage Images</span>
        </div>
      </div>
      <input class="w-full bg-[#2d2825]/50 border border-[#C5A059]/20 focus:border-[#C5A059] text-sm font-bold text-[#F5F5F0] px-3 py-2 rounded-lg transition-colors text-center category-name" type="text" value="${cat.name}" data-id="${cat.id}" onchange="updateCategoryName(${cat.id}, this.value); document.body.setAttribute('data-unsaved', 'true');"/>
      <button class="hidden group-hover:block absolute top-2 right-2 p-2 bg-[#ff6b6b] text-white rounded-lg hover:bg-[#ff5252] transition-all" onclick="deleteCategory(${cat.id})">
        <span class="material-symbols-outlined text-base">delete</span>
      </button>
    </div>
  `).join('');
}

// Add new category
document.getElementById('addCategoryBtn').addEventListener('click', () => {
  const newId = Math.max(...categories.map(c => c.id), 0) + 1;
  const newCategory = {
    id: newId,
    name: `New Category ${newId}`,
    thumbnail: 'https://via.placeholder.com/128?text=No+Image'
  };
  categories.push(newCategory);
  renderCategories();
  document.body.setAttribute('data-unsaved', 'true');
  showSuccessNotification('New category added!');
});

// Update category name
function updateCategoryName(id, newName) {
  const cat = categories.find(c => c.id === id);
  if (cat) {
    cat.name = newName;
  }
}

// Delete category
function deleteCategory(id) {
  if (confirm('Are you sure you want to delete this category? All images will be removed.')) {
    categories = categories.filter(c => c.id !== id);
    renderCategories();
    document.body.setAttribute('data-unsaved', 'true');
    showSuccessNotification('Category deleted!');
  }
}

// Navigate to gallery manager
function navigateToGallery(categoryId, categoryName) {
  window.location.href = `category_gallery_manager.php?category=${categoryId}&name=${encodeURIComponent(categoryName)}`;
}

// Save categories
document.getElementById('saveCategoriesBtn').addEventListener('click', () => {
  localStorage.setItem('curatedCategories', JSON.stringify(categories));
  document.body.setAttribute('data-unsaved', 'false');
  showSuccessNotification('Collections saved successfully!');
});

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

// Initialize on page load
window.addEventListener('load', () => {
  renderCategories();
  renderPackages();
  
  // Load Section 4 data from localStorage
  const section4Data = JSON.parse(localStorage.getItem('section4Data'));
  if (section4Data) {
    document.getElementById('section4Title').value = section4Data.title || 'Let\'s Create Together';
    document.getElementById('section4Description').value = section4Data.description || '';
    document.getElementById('instagramUrl').value = section4Data.instagramUrl || '';
    document.getElementById('facebookUrl').value = section4Data.facebookUrl || '';
    document.getElementById('tiktokUrl').value = section4Data.tiktokUrl || '';
  }
});

// ====== TAILORED PACKAGES MANAGEMENT ======

// Initialize packages from localStorage or use defaults
let tailoredPackages = JSON.parse(localStorage.getItem('tailoredPackages')) || [
  { id: 1, title: 'The Essential', basePrice: '450', priceUnit: '/shoot', checklist: '[]' },
  { id: 2, title: 'Studio Signature', basePrice: '850', priceUnit: '/shoot', checklist: '[]' }
];

// Render packages list
function renderPackages() {
  const list = document.getElementById('packagesList');
  list.innerHTML = tailoredPackages.map((pkg, index) => `
    <div class="group flex items-center justify-between p-4 bg-[#2d2825]/50 rounded-lg border border-[#C5A059]/20 hover:border-[#C5A059]/40 hover:bg-[#2d2825]/70 transition-all cursor-pointer" onclick="navigateToPackageEditor(${pkg.id}, '${encodeURIComponent(pkg.title)}')">
      <div class="flex items-center gap-4">
        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-[#C5A059]/20 text-[#C5A059] font-bold text-sm">
          ${index + 1}
        </div>
        <div>
          <p class="text-lg font-bold text-[#F5F5F0] group-hover:text-[#C5A059] transition-colors">${pkg.title}</p>
          <p class="text-xs text-[#D1CDC7]/60">Click to manage pricing & inclusions</p>
        </div>
      </div>
      <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
        <button class="p-2 text-[#D1CDC7] hover:text-[#C5A059] hover:bg-[#C5A059]/10 rounded-lg transition-colors" title="Move up" onclick="event.stopPropagation(); movePackage(${index}, -1);" ${index === 0 ? 'disabled style="opacity: 0.5;"' : ''}>
          <span class="material-symbols-outlined text-lg">arrow_upward</span>
        </button>
        <button class="p-2 text-[#D1CDC7] hover:text-[#C5A059] hover:bg-[#C5A059]/10 rounded-lg transition-colors" title="Move down" onclick="event.stopPropagation(); movePackage(${index}, 1);" ${index === tailoredPackages.length - 1 ? 'disabled style="opacity: 0.5;"' : ''}>
          <span class="material-symbols-outlined text-lg">arrow_downward</span>
        </button>
        <button class="p-2 text-[#D1CDC7] hover:text-[#ff6b6b] hover:bg-[#ff6b6b]/10 rounded-lg transition-colors" title="Delete" onclick="event.stopPropagation(); deletePackage(${index});">
          <span class="material-symbols-outlined text-lg">delete</span>
        </button>
      </div>
    </div>
  `).join('');
}

// Navigate to package detail editor
function navigateToPackageEditor(packageId, packageName) {
  window.location.href = `package_detail_editor.php?id=${packageId}&name=${packageName}`;
}

// Add new package
document.getElementById('addPackageBtn').addEventListener('click', () => {
  const newId = Math.max(...tailoredPackages.map(p => p.id), 0) + 1;
  const newPackage = {
    id: newId,
    title: `New Package ${newId}`,
    basePrice: '',
    priceUnit: '/shoot',
    checklist: '[]'
  };
  tailoredPackages.push(newPackage);
  renderPackages();
  document.body.setAttribute('data-unsaved', 'true');
  showSuccessNotification('New package added! Click to edit details.');
});

// Move package
function movePackage(index, direction) {
  const newIndex = index + direction;
  if (newIndex >= 0 && newIndex < tailoredPackages.length) {
    [tailoredPackages[index], tailoredPackages[newIndex]] = [tailoredPackages[newIndex], tailoredPackages[index]];
    renderPackages();
    document.body.setAttribute('data-unsaved', 'true');
  }
}

// Delete package
function deletePackage(index) {
  if (confirm(`Are you sure you want to delete "${tailoredPackages[index].title}"?`)) {
    tailoredPackages.splice(index, 1);
    renderPackages();
    document.body.setAttribute('data-unsaved', 'true');
    showSuccessNotification('Package deleted');
  }
}

// Save packages
document.getElementById('packageSaveBtn').addEventListener('click', () => {
  localStorage.setItem('tailoredPackages', JSON.stringify(tailoredPackages));
  document.body.setAttribute('data-unsaved', 'false');
  showSuccessNotification('Packages saved successfully!');
});
</script>
</main>
</body></html>


