<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Project Monitoring - Aaron | EDPS Studio</title>
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
<!-- Content Canvas -->
<section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full">
<!-- Breadcrumbs / Back Link -->
<div class="mb-10">
<a class="inline-flex items-center text-[#D1CDC7] hover:text-[#C5A059] transition-colors font-body text-sm font-bold group" href="stafflist.php">
<span class="material-symbols-outlined text-[18px] mr-2 transition-transform group-hover:-translate-x-1" data-icon="arrow_back">arrow_back</span>
                    Back to Staff List
                </a>
</div>
<!-- Staff Profile Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-8 mb-16">
<div class="flex items-center gap-8">
<div class="relative">
<img alt="Aaron Profile" class="w-32 h-40 object-cover rounded-3xl shadow-xl grayscale hover:grayscale-0 transition-all duration-500" data-alt="Close up portrait of male photographer Aaron" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBADodIjiaebuTt7Cdn6GVUzEvvNs-7gLO_hhjjLubNobPhrTjc9N7OyZeS4gnpnRNkoSutsEv6Nespe3PbvgA3Ll6w4tjVxbcZNNAYUnsrM14pwtaPxjksysOV157sWOij9kSfVXS0JUQl7nvDubDiHASoO28IGL_wBQrC-BuwIaxeYuU49cK-8yE6smYaeTKFw5Dc3Pu_gsanySQ7iAehAJKvaLA7VUSPuuDEIebSi95CfAEWB5EJ41F0lqMobnwiOkp2hgw6kA"/>
</div>
<div>
<h2 class="font-headline text-5xl text-[#F5F5F0] tracking-tight leading-none mb-2">Aaron V.</h2>
<p class="font-body text-[#C5A059] text-lg flex items-center gap-2"><span class="material-symbols-outlined text-[18px]" data-icon="location_on">location_on</span>Photographer</p>
<p class="font-body text-[#C5A059] text-lg flex items-center gap-2 mt-1"><span class="material-symbols-outlined text-[18px]" data-icon="place">place</span>New York, USA</p>
<div class="mt-4 flex gap-4">
<span class="px-4 py-2 bg-[#3E2723] border border-[#C5A059] text-[#C5A059] text-xs font-bold uppercase tracking-widest rounded-full">12 Active Projects</span>
</div>
</div>
</div>
</div>
<!-- Section Title -->
<div class="flex items-center justify-between mb-8 border-b border-[#C5A059]/20 pb-4">
<h3 class="font-headline text-2xl text-[#F5F5F0] italic">Project Monitoring</h3>
<div class="flex gap-2">
<button class="p-2 bg-[#2C1A12] text-[#C5A059] rounded-lg hover:text-[#F5F5F0] transition-colors">
<span class="material-symbols-outlined" data-icon="filter_list">filter_list</span>
</button>
</div>
</div>
<!-- Projects Bento Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
<!-- Card 1 -->
<div class="group relative bg-[#1A1614] rounded-3xl overflow-hidden flex flex-col h-full hover:shadow-lg transition-all duration-300 border border-[#2C1A12]">
<div class="relative h-64 overflow-hidden border-b border-[#C5A059]/50">
<img alt="Wedding Project" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 border-b-[0.5px] border-[#C5A059]" data-alt="Elegant wedding banquet table with floral arrangements" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB3fAWpJXRPB0cTPRPC6gEVrKGY3irCSQ7Pfh2ELLxcm5_daMwcVIDPYhzz8DSKmjOcEsUDdV7GOqagr5ZUS5muFb4xTxjSv8E55IfGkXr5stIKfWoq0mGwcjsPmkOGd4lRX-y8OZlCcQ0rAtyhCDE5iEW2QvIJGuwZdSKDv9rOtFZHpcRx_I3ENQ3n3fs_cnqCj4hNkteb7mF6vSDa5L5uXv3ifYObRCAEbxcyOKi1mevOsApa6aJq1H3zCt8gHTkcTaNVaSHqgQ"/>
<div class="absolute top-4 left-4 z-20">
<span class="bg-[#3E2723] text-[#C5A059] text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 backdrop-blur-sm rounded-full shadow-lg inline-flex items-center gap-1">
ON PROCESS
</span>
</div>
<div class="absolute top-4 right-4 z-20 bg-[#1A1614]/90 backdrop-blur-sm px-3 py-1.5 rounded-full">
<span class="text-[#C5A059] text-[10px] font-bold">Lead Photographer</span>
</div>
</div>
<div class="p-6 flex-1 flex flex-col justify-between">
<div>
<div class="flex justify-between items-start mb-2">
<h4 class="font-headline text-xl text-[#F5F5F0] font-bold">Mr. Ken (Aaron)</h4>
<span class="text-xs text-[#D1CDC7]">May 24, 2024</span>
</div>
<p class="text-sm text-[#D1CDC7] leading-relaxed mb-6 line-clamp-2">
Full coverage editorial for a private wedding reception in Kyoto. Focus on natural light and candid interactions.
</p>
</div>
<div class="flex items-center justify-between mt-auto">
<div class="flex -space-x-2">
<div class="w-8 h-8 rounded-full border-2 border-[#2C1A12] bg-[#2C1A12] flex items-center justify-center overflow-hidden">
<img alt="Client" data-alt="Female client portrait circle" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjVIUTfauNXRL8MJfd2aidMEdrsvaQLOI1brIcyXxuYLaYDoobkIT1FVg9SVZ_fWEFvBPa01qEKPxF-i96-ftSZ2FoDl1FEG2E8PikPlY5-cSYwfP1mVRT86uBrObGniQm2ZXhQ2z98hpN4XsSu-8MqH7ZevfEPa9OZ9co4ZU0Wm5ot_7aYUxCGQDQXu4juFCmthyiitxDW1ZvUhI3Ll13rUYqz571PGOI3RWJ4pUCz1DKnr1ngnL4f0EuQoSCVdaxyqpPR1gK1g"/>
</div>
<div class="w-8 h-8 rounded-full border-2 border-[#2C1A12] bg-[#2C1A12] flex items-center justify-center">
<span class="text-[10px] font-bold text-[#C5A059]">+2</span>
</div>
</div>
<a href="taskmonitoring.php?assignment_id=1" class="flex items-center gap-2 text-[#C5A059] font-bold text-xs uppercase tracking-widest hover:text-[#F5F5F0] transition-all pb-1 group/btn">
VIEW DETAILS
<span class="material-symbols-outlined text-sm transition-transform group-hover/btn:translate-x-1" data-icon="chevron_right">chevron_right</span>
</a>
</div>
</div>
</div>
<!-- Card 2 -->
<div class="group relative bg-[#1A1614] rounded-3xl overflow-hidden flex flex-col h-full hover:shadow-lg transition-all duration-300 border border-[#2C1A12]">
<div class="relative h-64 overflow-hidden border-b border-[#C5A059]/50">
<img alt="Nature Project" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 border-b-[0.5px] border-[#C5A059]" data-alt="Misty morning in a lush forest landscape" src="https://lh3.googleusercontent.com/aida-public/AB6AXuARazrM_hjSORWXedCvcvUMB5WrVxemynxEgkBXHogSVwGJNtc43q6ibleHqVXdjxcDAEgmyR9CYv5_kiZdn9f0jEKFxiN9ic8NoiQh7u9uXej9s8rN_f_rQsgIZbpaXf38VQbn2Dn-PCV29nCipf6TNEwL0h-hFAl1lMaY4vMnv2o4BAxJ7tpPUdztyW4Vu5io3wPibNiCFpcRArCtBOcacvnTFSVLjfYQbJ0oeneexlU3IeWm0586loUhmAAObOcHJ5ao9KuMQw"/>
<div class="absolute top-4 left-4 z-10">
<span class="bg-[#3E2723] text-[#C5A059] text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 backdrop-blur-sm rounded-full shadow-lg">DONE</span>
</div>
<div class="absolute top-4 right-4 z-20 bg-[#1A1614]/90 backdrop-blur-sm px-3 py-1.5 rounded-full">
<span class="text-[#C5A059] text-[10px] font-bold">Editor</span>
</div>
</div>
<div class="p-6 flex-1 flex flex-col justify-between">
<div>
<div class="flex justify-between items-start mb-2">
<h4 class="font-headline text-xl text-[#F5F5F0] font-bold">The Nordic Retreat</h4>
<span class="text-xs text-[#D1CDC7]">April 12, 2024</span>
</div>
<p class="text-sm text-[#D1CDC7] leading-relaxed mb-6 line-clamp-2">
Branding photography for an eco-luxury lodge. Emphasizing the textures of wood, stone, and morning mist.
</p>
</div>
<div class="flex items-center justify-between mt-auto">
<div class="flex -space-x-2">
<div class="w-8 h-8 rounded-full border-2 border-[#2C1A12] bg-[#2C1A12] flex items-center justify-center overflow-hidden">
<img alt="Client" data-alt="Male client headshot circle" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAk_fXtPOu_7goUGqUc2qloaoUBYExeZWTUzJijnjNDSXSC70QYEPeT3qFC-chsJtuVMkIcOn6u2rFHhy3lOhWQYhEyRs9fP9eMIW4CuWfbWjBkRZE2PeaxJNhf1Ksaak6ie79199-d2yYF5AK3yqD9knu5n_v2gQstKiBfPf64Ln0EM9t__PVVZuunobj-8YCIBnuGU-QT_vxqcbKxswajQ-TBUWaHr5H4WPvjzsmWuXnfRL9lbGgDFuhU-CrfYfLXsWheeqqLHw"/>
</div>
</div>
<a href="taskmonitoring.php?assignment_id=2" class="flex items-center gap-2 text-[#C5A059] font-bold text-xs uppercase tracking-widest hover:text-[#F5F5F0] transition-all pb-1 group/btn">
VIEW DETAILS
<span class="material-symbols-outlined text-sm transition-transform group-hover/btn:translate-x-1" data-icon="chevron_right">chevron_right</span>
</a>
</div>
</div>
</div>
<!-- Card 3 -->
<div class="group relative bg-[#1A1614] rounded-3xl overflow-hidden flex flex-col h-full hover:shadow-lg transition-all duration-300 border border-[#2C1A12]">
<div class="relative h-64 overflow-hidden border-b border-[#C5A059]/50">
<img alt="Urban Project" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 border-b-[0.5px] border-[#C5A059]" data-alt="High-fashion model posing against brutalist architecture" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAlmcl-iDPSskacWKcBI3EKJd0TNYBhnIpsM8Zynb90iQZG1au8FDnZImJzZnA6t52AtXw7mau4q9i-8zYViqIzRAv0dyF4mOwc7xzM3Cx6kpTQHMbrezyYAss2kspjo9_eQ0XVNQsNkv1mm80jNosMlssjEGjf-NpxKufPF4GRjQmu5-z_tuMKllQUFqCrG-RkhQaSjTVv17JQMaM_Z-9tjoB_n5coj37uqw9w5_3kfsel7HJ5FjgaY599X53OfiqP08IfW0vAHg"/>
<div class="absolute top-4 left-4 z-20">
<span class="bg-[#3E2723] text-[#C5A059] text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 backdrop-blur-sm rounded-full shadow-lg">ON PROCESS</span>
</div>
<div class="absolute top-4 right-4 z-20 bg-[#1A1614]/90 backdrop-blur-sm px-3 py-1.5 rounded-full">
<span class="text-[#C5A059] text-[10px] font-bold">Photography Lead</span>
</div>
</div>
<div class="p-6 flex-1 flex flex-col justify-between">
<div>
<div class="flex justify-between items-start mb-2">
<h4 class="font-headline text-xl text-[#F5F5F0] font-bold">Vogue Brutalist Series</h4>
<span class="text-xs text-[#D1CDC7]">June 02, 2024</span>
</div>
<p class="text-sm text-[#D1CDC7] leading-relaxed mb-6 line-clamp-2">
A high-fashion concept shoot exploring the intersection of soft silk fabrics and rigid concrete architecture.
</p>
</div>
<div class="flex items-center justify-between mt-auto">
<div class="flex -space-x-2">
<div class="w-8 h-8 rounded-full border-2 border-[#2C1A12] bg-[#2C1A12] flex items-center justify-center overflow-hidden">
<img alt="Client" data-alt="Stylish client portrait circle" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAHu2hCJSTPoOc-kyyK1FBSU4i-vVcODlPwXWmBXvF4cIL07B-RtVOwGcGraagnJ7fxvGWKrZEJU4Aiyj1dt3DY4GTkxDtgE1MFrIj2NAc3CzMdZVT6uhi_8Cd_GklgxpLEmrdvs16d_M_zgGOe5iTsItufEVhgF9bge9HKH_GN1SEoQEZ7DsG27wORHnygcfLzTxY5fhDLxqxr-jPK99tSqY9GDwflOEjfLXhLm4947ZH7ihtF5fbz-2XQgnMcACMTQ70Fg4DeKQ"/>
</div>
<div class="w-8 h-8 rounded-full border-2 border-[#2C1A12] bg-[#2C1A12] flex items-center justify-center">
<span class="text-[10px] font-bold text-[#C5A059]">+5</span>
</div>
</div>
<a href="taskmonitoring.php?assignment_id=3" class="flex items-center gap-2 text-[#C5A059] font-bold text-xs uppercase tracking-widest hover:text-[#F5F5F0] transition-all pb-1 group/btn">
VIEW DETAILS
<span class="material-symbols-outlined text-sm transition-transform group-hover/btn:translate-x-1" data-icon="chevron_right">chevron_right</span>
</a>
</div>
</div>
</div>
</div>

<!-- Pagination Section -->
<div class="mt-20 flex flex-col items-center">
<p class="text-[#D1CDC7] font-headline italic mb-8">Viewing 3 of 12 assignments</p>
<div class="flex items-center gap-1 font-body text-xs font-bold uppercase tracking-widest">
<button class="px-4 py-2 text-[#D1CDC7] hover:text-[#C5A059] transition-colors flex items-center gap-1 group">
<span class="material-symbols-outlined text-sm transition-transform group-hover:-translate-x-1" data-icon="chevron_left">chevron_left</span>
Prev
</button>
<button class="w-10 h-10 flex items-center justify-center bg-[#C5A059] text-[#1A1614] rounded-lg font-bold">1</button>
<button class="w-10 h-10 flex items-center justify-center hover:bg-[#2C1A12] transition-colors rounded-lg text-[#D1CDC7]">2</button>
<button class="w-10 h-10 flex items-center justify-center hover:bg-[#2C1A12] transition-colors rounded-lg text-[#D1CDC7]">3</button>
<button class="w-10 h-10 flex items-center justify-center hover:bg-[#2C1A12] transition-colors rounded-lg text-[#D1CDC7]">4</button>
<button class="px-4 py-2 text-[#D1CDC7] hover:text-[#C5A059] transition-colors flex items-center gap-1 group">
Next
<span class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1" data-icon="chevron_right">chevron_right</span>
</button>
</div>
<div class="mt-12">
<button class="font-body font-extrabold text-[#C5A059] text-sm uppercase tracking-widest hover:text-[#F5F5F0] transition-all duration-500">
Explore Full Archive
</button>
</div>
</div>
</section>
</main>
</div>
</body></html>


