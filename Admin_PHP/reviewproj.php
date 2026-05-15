<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Review &amp; Confirm - EDPS Admin</title>
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
        <aside class="hidden md:flex flex-col h-screen w-72 border-r border-[#2C1A12] bg-[#1A1614] py-8 px-6 sticky top-0 font-['Noto_Serif'] antialiased overflow-y-auto">
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
              <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors rounded-lg" href="settings.php">
        <span class="material-symbols-outlined text-[#C5A059]">settings</span>
        <span class="font-medium">Settings</span>
    </a>
                <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 group" href="login.php">
                    <span class="material-symbols-outlined text-[#C5A059]" data-icon="logout">logout</span>
                    <span class="font-body font-medium">Logout</span>
                </a>
            </div>
        </aside>
<!-- Main Content Area -->
<main class="flex-1 flex flex-col min-w-0">
<!-- TopAppBar -->
            <!-- TopAppBar -->
            <header class="sticky top-0 z-40 flex justify-between items-center w-full px-8 py-4 bg-[#1A1614]/80 backdrop-blur-md text-[#F5F5F0] font-['Manrope'] font-medium border-b border-[#2C1A12]">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-2xl text-[#C5A059]" data-icon="menu">menu</span>
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
<!-- Page Canvas -->
<section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full">
<!-- Canvas -->
<div class="p-12 max-w-6xl mx-auto">
<!-- Header & Stepper -->
<div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-8">
<div>
<span class="text-primary font-label text-sm font-bold tracking-[0.2em] uppercase mb-2 block">Step 3 of 3</span>
<h2 class="font-serif text-5xl text-primary leading-tight">Review &amp; Confirm</h2>
</div>
<!-- Progress Stepper -->
<div class="flex items-center gap-4">
<div class="flex flex-col items-center gap-2">
<div class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center">
<span class="material-symbols-outlined text-sm" data-icon="check" style="font-variation-settings: 'FILL' 1;">check</span>
</div>
<span class="text-[10px] font-bold uppercase tracking-widest text-secondary">Details</span>
</div>
<div class="w-12 h-[2px] bg-primary-container mb-6"></div>
<div class="flex flex-col items-center gap-2">
<div class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center">
<span class="material-symbols-outlined text-sm" data-icon="check" style="font-variation-settings: 'FILL' 1;">check</span>
</div>
<span class="text-[10px] font-bold uppercase tracking-widest text-secondary">Staff</span>
</div>
<div class="w-12 h-[2px] bg-primary mb-6"></div>
<div class="flex flex-col items-center gap-2">
<div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center ring-4 ring-primary/10">
<span class="text-sm font-bold">03</span>
</div>
<span class="text-[10px] font-bold uppercase tracking-widest text-primary">Review</span>
</div>
</div>
</div>
<!-- Bento Grid Review -->
<div class="grid grid-cols-1 md:grid-cols-12 gap-6">
<!-- Project Summary Card -->
<div class="md:col-span-7 bg-surface-container-low p-8 rounded-lg">
<div class="flex justify-between items-start mb-8">
<h3 class="font-serif text-2xl text-primary">Project Identity</h3>
<button class="text-primary text-sm font-bold flex items-center gap-1 hover:underline">
<span class="material-symbols-outlined text-sm" data-icon="edit">edit</span> Edit
                        </button>
</div>
<div class="space-y-6">
<div class="flex gap-8 items-center">
<div class="w-32 h-32 rounded bg-surface-container-highest overflow-hidden">
<img alt="Project Preview" class="w-full h-full object-cover" data-alt="Bespoke wedding photography session sample" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBrUlOVLyQYFZ4CBaVuYQBhbNnCROCjjn4R5x3Bg9-KXMa3Gd-i0_gRwKS6OyOfFKxc-7sR0oiWd-eYb8OnAuqr9VtHTU_0z5ceyn_THhqkx4e_aFeiEEO5vOfvQHGovB3pwTkiOuN9VrW9soJSzYFkwnaaGnMJScPrXPHfUgDk-36CZp2eCt10fRMGg6DF7_GSCHObwmMGWvbUSt8iFYWEr48pPm082xx2Tpbot_NUnVKgLINjNRTbp6YHouO4jRSSfwQjyE41MQ"/>
</div>
<div>
<p class="text-xs uppercase tracking-widest text-secondary mb-1">Project Name</p>
<p class="text-2xl font-serif text-on-surface">The Renaissance Wedding</p>
<div class="flex gap-4 mt-2">
<span class="bg-primary/5 text-primary text-[10px] px-2 py-1 rounded font-bold uppercase tracking-tighter">Premium Session</span>
<span class="bg-tertiary/5 text-tertiary text-[10px] px-2 py-1 rounded font-bold uppercase tracking-tighter">Outdoor Location</span>
</div>
</div>
</div>
<div class="grid grid-cols-2 gap-8 pt-6 border-t border-outline-variant/10">
<div>
<p class="text-xs uppercase tracking-widest text-secondary mb-1">Session Date</p>
<p class="font-medium">October 24, 2024</p>
</div>
<div>
<p class="text-xs uppercase tracking-widest text-secondary mb-1">Client Contact</p>
<p class="font-medium">Evelyn Harper</p>
</div>
<div class="col-span-2">
<p class="text-xs uppercase tracking-widest text-secondary mb-1">Project Description</p>
<p class="text-on-surface-variant text-sm leading-relaxed italic">"Capture the soft evening light at the botanical gardens with a focus on editorial posing and natural textures."</p>
</div>
</div>
</div>
</div>
<!-- Assigned Staff Card -->
<div class="md:col-span-5 bg-surface-container-highest p-8 rounded-lg relative overflow-hidden">
<div class="flex justify-between items-start mb-8 relative z-10">
<h3 class="font-serif text-2xl text-primary">Team Assignment</h3>
<button class="text-primary text-sm font-bold flex items-center gap-1 hover:underline">
<span class="material-symbols-outlined text-sm" data-icon="edit">edit</span> Change
                        </button>
</div>
<div class="space-y-4 relative z-10">
<!-- Staff Item 1 -->
<div class="bg-surface/60 backdrop-blur-sm p-4 rounded-md flex items-center gap-4 border border-white/20">
<div class="w-12 h-12 rounded-full overflow-hidden bg-secondary/10">
<img alt="Staff Member 1" class="w-full h-full object-cover" data-alt="Portrait of professional photographer Aaron" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC0jBajc8OYDA2bNcERvuKcdajnJAKXtGKKwnjQx8BRyk8LGlQIsqSJ-ltJWNTlA_g1E6ErV_rND3Lv81Zol6Ag1Ui9a4l9hjEJgPBQFYABEIGOMlQa68vg3ZFq6tXC3GZ_qRNb1Y_7NWPdHuru5fg41jiuLBs_FVeu0bAgwpNIeqIXFHgo6vQsJO9JaR5PEccO8-I_PGKkKgFddVml1B-hmg3agMLF-V5wFYB0eLV-wqFPnt_4EaWdusBUOFmNXYuIcMybV9kIww"/>
</div>
<div>
<p class="font-bold text-on-surface">Mr. Ken (Aaron)</p>
<p class="text-xs uppercase tracking-widest text-primary font-bold">Editor</p>
</div>
</div>
<!-- Staff Item 2 -->
<div class="bg-surface/60 backdrop-blur-sm p-4 rounded-md flex items-center gap-4 border border-white/20">
<div class="w-12 h-12 rounded-full overflow-hidden bg-secondary/10">
<img alt="Staff Member 2" class="w-full h-full object-cover" data-alt="Portrait of professional photographer Maris" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBlpBJxRs750L0s6BjMKurWZ4s5V6pEfx_BIpTqKdR2dDFFFPtIs769ZrRkji2pyfllHzYA4bSuxER1V-Jk22nKaT817pTn9TjeWpuqeWhpHWjFRXwo06KW1nJnBiVAqffyvUYISYyfT3OgshOXq-XuZyD7Kjjb8nKNxMaexBFgrV8M_CZ4vEiLc6IH52w5IlYapdxslBfg-uOTBhzGR_2DgD9_BR3D3lwtLVXTtSIHbh8_9PUywBkKlFth2W5gvw9N1dleayMFYA"/>
</div>
<div>
<p class="font-bold text-on-surface">Mr. Ken (Maris)</p>
<p class="text-xs uppercase tracking-widest text-primary font-bold">Artist</p>
</div>
</div>
<!-- Visibility Note -->
<div class="mt-8 p-4 border-l-2 border-primary bg-primary/5">
<p class="text-xs text-secondary leading-relaxed">
<span class="font-bold text-primary block mb-1">Staff Visibility:</span>
                                These team members will see this project listed under their assigned roles on their personalized dashboards.
                            </p>
</div>
</div>
</div>
<!-- Action Bar (Footer of content) -->
<div class="md:col-span-12 mt-8 flex items-center justify-between p-8 bg-surface-container-low rounded-lg">
<div class="flex items-center gap-2 text-secondary">
<span class="material-symbols-outlined" data-icon="info">info</span>
<span class="text-sm">Final check complete. All assets are ready for project launch.</span>
</div>
<div class="flex gap-4">
<button class="px-8 py-3 bg-surface-container-highest text-on-surface font-bold text-sm rounded-md transition-all hover:bg-surface-variant active:scale-95">
                            Save Draft
                        </button>
<button class="px-10 py-3 bg-gradient-to-r from-primary to-primary-container text-white font-bold text-sm rounded-md shadow-lg shadow-primary/20 hover:opacity-90 active:scale-95 transition-all" onclick="window.location.href='viewprojects.php'">
                            Create Project
                        </button>
</div>
</div>
</div>
</div>
</section>
</main>
</body></html>


