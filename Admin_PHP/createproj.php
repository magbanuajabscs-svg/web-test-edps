<?php
require_once 'config.php';
require_once 'Database.php';
require_once 'Project.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project = new Project();

    $data = [
        'title' => $_POST['title'] ?? '',
        'client_name' => $_POST['clientName'] ?? '',
        'session_date' => $_POST['sessionDate'] ?? '',
        'session_time' => $_POST['sessionTime'] ?? '',
        'project_type' => $_POST['projectType'] ?? '',
        'package_type' => $_POST['packageType'] ?? '',
        'venue_location' => $_POST['venueLocation'] ?? '',
        'description' => $_POST['description'] ?? '',
        'status' => 'draft',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];

    if (empty($data['title']) || empty($data['client_name']) || empty($data['session_date'])) {
        $message = 'Title, client name, and session date are required';
        $messageType = 'error';
    } else {
        if ($project->addProject($data)) {
            // Store project ID in session for the next step
            $_SESSION['current_project_id'] = Database::getInstance()->lastInsertId();
            header('Location: staffassign.php');
            exit;
        } else {
            $message = 'Failed to create project';
            $messageType = 'error';
        }
    }
}
?>
<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>EDPS Admin - New Project</title>
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
<!-- Stepper Component -->
<div class="mb-16">
<div class="flex items-center justify-between max-w-3xl mx-auto relative">
<!-- Progress Line -->
<div class="absolute top-5 left-0 w-full h-[2px] bg-surface-container-highest -z-10"></div>
<div class="absolute top-5 left-0 w-1/3 h-[2px] bg-primary -z-10"></div>
<!-- Step 1: Active -->
<div class="flex flex-col items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold ring-8 ring-background">1</div>
<span class="text-xs font-bold uppercase tracking-widest text-primary">Client Details</span>
</div>
<!-- Step 2: Inactive -->
<div class="flex flex-col items-center gap-3">
<div class="w-10 h-10 rounded-full bg-surface-container-highest text-secondary flex items-center justify-center font-bold ring-8 ring-background">2</div>
<span class="text-xs font-bold uppercase tracking-widest text-secondary/40">Staff Assignment</span>
</div>
<!-- Step 3: Inactive -->
<div class="flex flex-col items-center gap-3">
<div class="w-10 h-10 rounded-full bg-surface-container-highest text-secondary flex items-center justify-center font-bold ring-8 ring-background">3</div>
<span class="text-xs font-bold uppercase tracking-widest text-secondary/40">Review</span>
</div>
</div>
</div>
<!-- Bento Form Layout -->
<div class="grid grid-cols-12 gap-8">
<!-- Main Form Section -->
<div class="col-span-8 bg-surface-container-low p-10 rounded-xl shadow-sm border border-outline-variant/5">
<h3 class="text-3xl font-serif text-primary mb-2">Primary Information</h3>
<p class="text-secondary mb-10 text-sm leading-relaxed">Let's begin by establishing the identity and core requirements of this new creative endeavor.</p>
<form class="space-y-8" method="post">
<?php if ($message): ?>
<div class="mb-6 p-4 rounded-lg <?php echo $messageType === 'error' ? 'bg-error-container text-on-error-container' : 'bg-tertiary-container text-on-tertiary-container'; ?>">
    <p class="text-sm font-medium"><?php echo htmlspecialchars($message); ?></p>
</div>
<?php endif; ?>
<div class="grid grid-cols-2 gap-6">
<div class="flex flex-col gap-2">
<label class="text-xs font-bold uppercase tracking-tighter text-secondary/70 ml-1">Project Title</label>
<input class="bg-surface-container-highest/40 border-0 border-b border-outline-variant/40 focus:ring-0 focus:border-primary px-4 py-3 text-on-surface transition-all placeholder:text-secondary/30" placeholder="e.g. The Montgomery Wedding" type="text" name="title" required/>
</div>
<div class="flex flex-col gap-2">
<label class="text-xs font-bold uppercase tracking-tighter text-secondary/70 ml-1">Client Name</label>
<input class="bg-surface-container-highest/40 border-0 border-b border-outline-variant/40 focus:ring-0 focus:border-primary px-4 py-3 text-on-surface transition-all placeholder:text-secondary/30" placeholder="Full Name or Organization" type="text" name="clientName" required/>
</div>
</div>
<div class="grid grid-cols-2 gap-6">
<div class="flex flex-col gap-2">
<label class="text-xs font-bold uppercase tracking-tighter text-secondary/70 ml-1">Session Date</label>
<input class="bg-surface-container-highest/40 border-0 border-b border-outline-variant/40 focus:ring-0 focus:border-primary px-4 py-3 text-on-surface transition-all placeholder:text-secondary/30" type="date" name="sessionDate" required/>
</div>
<div class="flex flex-col gap-2">
<label class="text-xs font-bold uppercase tracking-tighter text-secondary/70 ml-1">Session Time</label>
<input class="bg-surface-container-highest/40 border-0 border-b border-outline-variant/40 focus:ring-0 focus:border-primary px-4 py-3 text-on-surface transition-all placeholder:text-secondary/30" type="time" name="sessionTime"/>
</div>
</div>
<div class="grid grid-cols-2 gap-6 mb-2">
<div class="flex flex-col gap-2">
<label class="text-xs font-bold uppercase tracking-tighter text-secondary/70 ml-1">Project Type</label>
<input class="bg-surface-container-highest/40 border-0 border-b border-outline-variant/40 focus:ring-0 focus:border-primary px-4 py-3 text-on-surface transition-all placeholder:text-secondary/30" placeholder="e.g. Wedding, Portrait, Editorial" type="text" name="projectType"/>
</div>
<div class="flex flex-col gap-2">
<label class="text-xs font-bold uppercase tracking-tighter text-secondary/70 ml-1">Package Type</label>
<select class="bg-surface-container-highest/40 border-0 border-b border-outline-variant/40 focus:ring-0 focus:border-primary px-4 py-3 text-on-surface transition-all" name="packageType">
<option disabled="" selected="" value="">Select a service package</option>
<option value="essential">Essential Collection</option>
<option value="signature">Signature Photographer</option>
<option value="bespoke">Bespoke Premium</option>
<option value="micro">Micro-Event Coverage</option>
</select>
</div>
</div>
<!-- Venue Section -->
<div class="flex flex-col gap-6 mt-2">
<label class="text-xs font-bold uppercase tracking-tighter text-secondary/70 ml-1">Venue &amp; Location</label>
<div class="flex flex-col gap-5">
<div class="relative group">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-primary/60 text-xl transition-colors group-focus-within:text-primary" data-icon="search">search</span>
<input class="w-full bg-surface-container-highest/60 border-0 border-b-2 border-outline-variant/30 focus:border-primary focus:ring-0 pl-12 pr-4 py-4 text-on-surface transition-all placeholder:text-secondary/40 rounded-t-lg shadow-sm hover:bg-surface-container-highest/80" placeholder="Search for a venue or enter address..." type="text" name="venueLocation"/>
</div>
<!-- Map Preview Area -->
<div class="h-60 w-full rounded-xl bg-surface-container-highest/40 relative overflow-hidden border border-outline-variant/30 group">
<!-- Simulated Map Interface -->
<div class="absolute inset-0 opacity-20 bg-[radial-gradient(#817477_1px,transparent_1px)] [background-size:30px_30px]"></div>
<div class="absolute inset-0 flex flex-col items-center justify-center bg-gradient-to-b from-transparent to-surface-container-highest/20">
<div class="w-16 h-16 rounded-full bg-white/80 backdrop-blur-sm flex items-center justify-center shadow-lg mb-4 transform transition-transform group-hover:scale-110 duration-500">
<span class="material-symbols-outlined text-primary text-3xl" data-icon="location_on">location_on</span>
</div>
<p class="text-[11px] font-bold uppercase tracking-[0.2em] text-secondary/60">Click to generate location preview</p>
</div>
<!-- Map Controls Overlay -->
<div class="absolute top-4 right-4 flex flex-col gap-2">
<button class="w-8 h-8 bg-white/90 backdrop-blur rounded shadow-sm flex items-center justify-center hover:bg-white transition-colors" type="button"><span class="material-symbols-outlined text-sm text-secondary" data-icon="add">add</span></button>
<button class="w-8 h-8 bg-white/90 backdrop-blur rounded shadow-sm flex items-center justify-center hover:bg-white transition-colors" type="button"><span class="material-symbols-outlined text-sm text-secondary" data-icon="remove">remove</span></button>
</div>
<!-- Primary Action -->
<button class="absolute bottom-4 left-1/2 -translate-x-1/2 px-6 py-2.5 bg-primary text-white text-[10px] font-bold uppercase tracking-widest rounded-full shadow-md hover:bg-primary-container hover:shadow-lg transition-all active:scale-95" type="button">
                                    Preview Interactive Map
                                </button>
</div>
</div>
</div>
<div class="flex flex-col gap-2">
<label class="text-xs font-bold uppercase tracking-tighter text-secondary/70 ml-1">Project Description</label>
<textarea class="bg-surface-container-highest/40 border-0 border-b border-outline-variant/40 focus:ring-0 focus:border-primary px-4 py-3 text-on-surface transition-all placeholder:text-secondary/30 resize-none" placeholder="Briefly describe the vision, mood, and specific requests..." rows="4" name="description"></textarea>
</div>
<div class="pt-6 flex justify-end items-center gap-6">
<button class="text-secondary text-sm font-bold uppercase tracking-widest hover:text-primary transition-colors" type="button" onclick="window.location.href='stafflist.php'">Back</button>
<button class="px-8 py-3 bg-gradient-to-r from-primary to-primary-container text-white text-sm font-bold uppercase tracking-widest rounded shadow-lg hover:shadow-xl active:scale-95 transition-all" type="submit">
                            Continue to Staffing
                        </button>
</div>
</form>
</div>
<!-- Contextual Sidebar / Info Panel -->
<div class="col-span-4 space-y-8">
<!-- Decorative Card -->
<div class="relative h-64 rounded-xl overflow-hidden group">
<img alt="Photography inspiration" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" data-alt="Soft focused elegant wedding photography shot" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkVC8Xr9V5WCpwK7Pkcre1llTZqvyr75DZHLU_7NXKh9LJLxHo27lF5oboH455X8eOv276TCbo-_NtRi4WA7_5S_x9UzTWMfREKpsuEjPuC4J_JFvg0ysqgh9Dg5JLuHgNfQIswIWlgl50vARfPl-M4IhClVAVKh0Xu5bX6tyCW9ME95szuWCqmRN5echa57WWoFU2yQxsw8hsLuUqcBSwmuTOoluYxNZG0WuNWlGELEtSkRJe_xltrBIB84g9JUJW6_A-vXU0xA"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent"></div>
<div class="absolute bottom-6 left-6 right-6">
<h4 class="text-white font-serif text-lg leading-tight">Capturing the Soul of the Moment</h4>
<p class="text-primary-fixed/80 text-xs italic mt-2">Editorial Guidelines 2024</p>
</div>
</div>
</div>
</div>
</div>
</section>
</main>
</body></html>


