<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Staff Assignment | EDPS Studio</title>
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
<!-- Main Content Canvas -->
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
<div class="p-12 max-w-7xl w-full mx-auto">
<!-- Stepper Component -->
<div class="mb-16">
<div class="flex items-center justify-between max-w-3xl mx-auto relative">
<!-- Progress Line -->
<div class="absolute top-5 left-0 w-full h-[2px] bg-surface-container-highest -z-10"></div>
<div class="absolute top-5 left-0 w-2/3 h-[2px] bg-primary -z-10"></div>
<!-- Step 1: Completed -->
<div class="flex flex-col items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold ring-8 ring-background">
<span class="material-symbols-outlined text-sm" data-icon="check">check</span>
</div>
<span class="text-xs font-bold uppercase tracking-widest text-primary/60">Client Details</span>
</div>
<!-- Step 2: Active -->
<div class="flex flex-col items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold ring-8 ring-background">2</div>
<span class="text-xs font-bold uppercase tracking-widest text-primary">Staff Assignment</span>
</div>
<!-- Step 3: Inactive -->
<div class="flex flex-col items-center gap-3">
<div class="w-10 h-10 rounded-full bg-surface-container-highest text-secondary flex items-center justify-center font-bold ring-8 ring-background">3</div>
<span class="text-xs font-bold uppercase tracking-widest text-secondary/40">Review</span>
</div>
</div>
</div>
<div class="grid grid-cols-12 gap-10">
<!-- Directory Section -->
<div class="col-span-8 space-y-8">
<div class="flex flex-col gap-3">
<h3 class="text-4xl font-serif text-primary">Assemble your Team</h3>
<p class="text-secondary text-sm leading-relaxed max-w-xl">Assign specialized artists and editors to ensure the editorial quality of Project: Mr. Ken meets the studio's gold standard.</p>
</div>
<!-- Filters & Search -->
<div class="flex items-center justify-between gap-4">
<div class="flex gap-2">
<button class="px-6 py-2 rounded-full bg-primary text-white text-[10px] font-bold uppercase tracking-widest">All</button>
<button class="px-6 py-2 rounded-full bg-surface-container text-secondary text-[10px] font-bold uppercase tracking-widest hover:bg-surface-container-high transition-colors">Artist</button>
<button class="px-6 py-2 rounded-full bg-surface-container text-secondary text-[10px] font-bold uppercase tracking-widest hover:bg-surface-container-high transition-colors">Editor</button>
<button class="px-6 py-2 rounded-full bg-surface-container text-secondary text-[10px] font-bold uppercase tracking-widest hover:bg-surface-container-high transition-colors">Bindery</button>
</div>
<div class="relative flex-1 max-w-[240px] group">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-secondary/50 text-lg group-focus-within:text-primary" data-icon="search">search</span>
<input class="w-full bg-surface-container-low border-0 border-b border-outline-variant/30 py-2.5 pl-10 pr-4 text-sm focus:ring-0 focus:border-primary placeholder:text-secondary/40" placeholder="Search Directory..." type="text"/>
</div>
</div>
<!-- Staff Grid -->
<div class="grid grid-cols-2 gap-6">
<!-- Staff Card 1 -->
<div class="bg-surface-container-low p-5 flex gap-5 items-center rounded-xl border border-outline-variant/5 group hover:shadow-md transition-all duration-300">
<div class="w-24 h-32 bg-surface-container-highest overflow-hidden relative rounded-sm">
<img alt="Maris Profile" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" data-alt="Portrait of a young woman with a creative professional look" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBhTTtN_Prkk217UGpbwJDDTcULrIZLWSTpCYGH6UytPJtSKoyYm7nhTQvS1MipE681_vlRxQZLw0V8NQtPMdW1zpDuNtZpXfAtBbQ6q6F6dGh_Cq5eQao7JY4jEGdmbdONgSwlZJJQXD9EG4xUJLapNe2KA-HO_Q7bUxvw249P_Kyo1C7xaPcakvYiMkQbMLfqRRRxjmA1ZBcJ1xnesxp5AcSRt8Fer_np3fDvEgVqdWkQ6cgY6tTS-e-nB3hnT8VKHWBSZAbsLw"/>
</div>
<div class="flex-1 space-y-2">
<div>
<h4 class="font-serif font-bold text-lg text-primary">Maris Thorne</h4>
<p class="text-[10px] uppercase tracking-widest text-secondary font-bold">ARTIST</p>
</div>
<button class="w-full bg-[#63434E] text-white py-2 px-4 rounded font-bold uppercase tracking-widest text-[10px] flex items-center justify-center gap-2 hover:opacity-90 transition-opacity mt-4">ASSIGN </button>
</div>
</div>
<!-- Staff Card 2 -->
<div class="bg-surface-container-low p-5 flex gap-5 items-center rounded-xl border border-outline-variant/5 group hover:shadow-md transition-all duration-300">
<div class="w-24 h-32 bg-surface-container-highest overflow-hidden relative rounded-sm">
<img alt="Aaron Profile" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" data-alt="Portrait of a male photographer in a studio setting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA97HYHJocOt3G833hcCBmsFqLnfcc46nzfOCgfb9zHPPA66MW8F9yxS_Xlz7IDksP7ysrB4zuagImQHGNBHIPAlRoBBnkmMl0aVxyzsdIjKRZV0OkTPd37qn4WdJ6YrfPzCdJuKPZC32YRgecUtbi5L6dvYBM9yZuN2jhme6bqQ8mdjGne-4dzm1I5Tif_n-CFmzer1zuuNFqq3vu-9au6KXo3fs65AAyWh6wss6OJaZkp7sQhvLnwCh9bgBVomHr2Bn8buGXTiQ"/>
</div>
<div class="flex-1 space-y-2">
<div>
<h4 class="font-serif font-bold text-lg text-primary">Aaron Vance</h4>
<p class="text-[10px] uppercase tracking-widest text-secondary font-bold">EDITOR</p>
</div>
<button class="w-full bg-[#63434E] text-white py-2 px-4 rounded font-bold uppercase tracking-widest text-[10px] flex items-center justify-center gap-2 hover:opacity-90 transition-opacity mt-4">ASSIGN </button>
</div>
</div>
<!-- Staff Card 3 -->
<div class="bg-surface-container-low p-5 flex gap-5 items-center rounded-xl border border-outline-variant/5 group hover:shadow-md transition-all duration-300">
<div class="w-24 h-32 bg-surface-container-highest overflow-hidden relative rounded-sm">
<img alt="Elena Profile" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500" data-alt="Close up portrait of a female creative with artistic lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuANe7_CpYjg0eM47Y3SQTrCMy3D0lcSrx-3eIaQ5nm9IBJZv6oBTjY1MjJPf5PaevMlO7VFgQvJOtG-M6NeLW5dzQtQ9acRzYRk5qXGlkdnY8RlTGlyIB54yWylFCuMRvDGooV9mGxmf-otYt6Nqo0vPY4T3PWc9yvPOCBzk-_RWVOVbUd9oeQvwV1wewdAnGpjLRYHme_f6K0MlAXZftzVkji2iYSXcfEuGdS1HmbrrAGpQ1EJvgQ5cLvQDh5k7RVEw5paM1Gyvg"/>
</div>
<div class="flex-1 space-y-2">
<div>
<h4 class="font-serif font-bold text-lg text-primary">Elena Rossi</h4>
<p class="text-[10px] uppercase tracking-widest text-secondary font-bold">STYLIST</p>
</div>
<button class="w-full bg-[#63434E] text-white py-2 px-4 rounded font-bold uppercase tracking-widest text-[10px] flex items-center justify-center gap-2 hover:opacity-90 transition-opacity mt-4">ASSIGN </button>
</div>
</div>
<!-- Staff Card 4 -->
<div class="bg-surface-container-low p-5 flex gap-5 items-center rounded-xl border border-outline-variant/5 group">
<div class="w-24 h-32 bg-surface-container-highest overflow-hidden relative rounded-sm">
<img alt="Julian Profile" class="w-full h-full object-cover grayscale" data-alt="Portrait of a man with glasses in a modern office" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCu6ab21Vz8AJWpHC0X_FlTu4JmqZ23cqpNnTkG1Qw3ypYdh-88mqAYRtPjEh6U5DWbtEtruvV6LL4CMPtMD2DdTHsrvKp-6RHYuB48ySgG50DxvOCg-DJLsCJ77FbsIyKJ8--_KkBcGhvdM4mXxZSQHSJbSh8rvZHYeu386uMU1q-c0YJ5TBleKEjje4lJabx4RNUhsly_m7q7IMAlLYZk-RzaTqHLk2MWmdFSUyNusKcbQjfy8Te5JiKhWx50no66fOodzi2xdg"/>
</div>
<div class="flex-1 space-y-2">
<div>
<h4 class="font-serif font-bold text-lg text-primary">Julian Grey</h4>
<p class="text-[10px] uppercase tracking-widest text-secondary font-bold">BINDERY</p>
</div>
<button class="w-full bg-[#63434E] text-white py-2 px-4 rounded font-bold uppercase tracking-widest text-[10px] flex items-center justify-center gap-2 hover:opacity-90 transition-opacity mt-4">ASSIGN </button>
</div>
</div>
</div>
</div>
<!-- Current Selection Side Panel -->
<div class="col-span-4 sticky top-28 self-start">
<div class="bg-surface-container p-8 rounded-xl border border-outline-variant/20 shadow-sm">
<h3 class="text-2xl font-serif text-primary mb-8 border-b border-outline-variant/20 pb-4">Current Selection</h3>
<div class="space-y-6">
<!-- Selection Item -->
<div class="group">
<div class="flex justify-between items-center mb-2">
<p class="text-[10px] uppercase font-bold tracking-widest text-secondary/60">ARTIST</p>
<button class="text-secondary/40 hover:text-error transition-colors">
<span class="material-symbols-outlined text-lg" data-icon="close">close</span>
</button>
</div>
<div class="flex items-center gap-4 bg-background/50 p-3 rounded-lg border border-outline-variant/10">
<div class="w-10 h-10 rounded-full overflow-hidden border border-outline-variant/30">
<img alt="Maris" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAx9YZCIqUR0j4Twp61KoMzdTcw-LmBo5HGB-yI8EmfQDRgfAER9vMtGXHZUcct0SBiv7MZ1wc8vWxL_wc9QLHGfdPznmZswLKZTHoV-FJs0Bv3a89Iynd5TMaPzrkz4d-Bac3hiiqehgsUJ1grllwP4LaSpMiUd3HX5LnzT45eNA0J0tVbQqRXngfPn5pfYxZ6X4nXgWrGXIhqNKr8_E4Ra7KTVoFYdy9Vo4Rz8nAfp55392CXZ0xaFnb1aQdYr7Ih93KcHphikg"/>
</div>
<span class="font-serif font-bold text-primary">Maris Thorne</span>
</div>
</div>
<!-- Selection Item -->
<div class="group">
<div class="flex justify-between items-center mb-2">
<p class="text-[10px] uppercase font-bold tracking-widest text-secondary/60">EDITOR</p>
<button class="text-secondary/40 hover:text-error transition-colors">
<span class="material-symbols-outlined text-lg" data-icon="close">close</span>
</button>
</div>
<div class="flex items-center gap-4 bg-background/50 p-3 rounded-lg border border-outline-variant/10">
<div class="w-10 h-10 rounded-full overflow-hidden border border-outline-variant/30">
<img alt="Aaron" class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDQxOSkRB7VbTQKRupnG_c7C1jVrYGTsmi2Pdb-lBdZUpiLViKwcb0m3cOv5qMydlYEGA2qIbW-GECNmoqXb5ky3uWh-XPNAMbBLLkCUIOwFWX9KJtdQS4kz90qFhQG6y_BUrOUy9N4dNDRw0SP4Vg1BamQFLXUsHzyJft9r_5id6yc46TTb-EALVBF9RF_HT1llRLxkqqpJ9rEW9sVaT6iHGTKaFUUc-ys0mbpL1ID3FGErRR8A1-Zv5FASeCOLQJjJnHWg7erIw"/>
</div>
<span class="font-serif font-bold text-primary">Aaron Vance</span>
</div>
</div>
<!-- Empty Slot -->
<div class="border-2 border-dashed border-outline-variant/40 rounded-xl p-6 flex flex-col items-center justify-center gap-2 opacity-50 hover:opacity-100 hover:bg-background/30 transition-all cursor-pointer group">
<span class="material-symbols-outlined text-secondary group-hover:text-primary transition-colors" data-icon="add_circle">add_circle</span>
<span class="text-[10px] uppercase font-bold tracking-[0.2em] text-secondary group-hover:text-primary transition-colors">Add Member</span>
</div>
</div>
<!-- Summary & Actions -->
<div class="mt-12 pt-8 border-t border-outline-variant/20 space-y-6">
<div class="flex justify-between items-end">
<span class="text-xs font-bold uppercase tracking-widest text-secondary/60">Total Assigned</span>
<span class="font-serif font-bold text-2xl text-primary">02 <span class="text-sm font-sans uppercase tracking-tight font-medium text-secondary/50">Members</span></span>
</div>
<div class="space-y-3">
<button class="w-full bg-gradient-to-r from-primary to-primary-container text-white py-4 font-bold tracking-widest text-[10px] uppercase rounded shadow-lg hover:shadow-xl active:scale-95 transition-all flex items-center justify-center gap-2" onclick="window.location.href='reviewproj.php'">
                                Review Project
                                <span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
</button>
<button class="w-full border border-outline text-secondary py-4 font-bold tracking-widest text-[10px] uppercase rounded hover:bg-surface-container-highest/30 transition-all active:scale-95" onclick="window.location.href='createproj.php'">
                                Back to Details
                            </button>
</div>
</div>
</div>
<!-- Editorial Quote -->
<div class="mt-8 p-6 italic font-serif text-secondary/70 border-l border-primary/30 text-sm leading-relaxed">
                    "A curated team is the lens through which every project finds its true narrative."
                </div>
</div>
</div>
</div>
</section>
</main>
</body></html>


