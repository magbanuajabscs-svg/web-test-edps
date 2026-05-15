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
    <title>Staff Management | EDPS Studio</title>
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
    </style>

</head>
<body class="bg-[#12100E] font-body text-[#D1CDC7] antialiased flex min-h-screen">

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
        <a class="flex items-center gap-4 text-[#F5F5F0] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#2C1A12] transition-colors duration-200 group" href="staffmanage.php">
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
<h1 class="text-2xl font-bold tracking-tight text-[#F5F5F0]\">EDPS Studio</h1>
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
<a class="flex items-center gap-4 text-[#F5F5F0] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#2C1A12] transition-colors duration-200" href="staffmanage.php">
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

    <div class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full space-y-12">
        <section class="flex flex-col md:flex-row justify-between items-end gap-6 mb-12">
            <div class="max-w-2xl">
                <h3 class="text-4xl md:text-5xl lg:text-6xl font-headline font-bold text-[#E4E0DC] tracking-tight mb-4 leading-tight">Our Creative Collective.</h3>
                <p class="mt-6 text-lg text-[#D1CDC7] font-body max-w-lg leading-relaxed">Manage and oversee the editorial talent behind EDPS Studio's signature visual narratives.</p>
            </div>
            <button class="flex items-center gap-2 bg-[#C5A059] text-[#1A1614] px-6 py-4 rounded-lg font-bold tracking-wide hover:bg-[#D4A76A] transition-all shadow-sm font-label uppercase text-xs" onclick="window.location.href='staffregister.php'">
                <span class="material-symbols-outlined text-sm">person_add</span>
                Register New Staff
            </button>
        </section>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php if (empty($staffMembers)): ?>
                <div class="col-span-full mt-16 text-center py-20">
                    <div class="flex items-center justify-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-5xl text-[#D1CDC7]/30">group</span>
                    </div>
                    <h3 class="text-3xl font-headline text-[#E4E0DC] mb-3">No Staff Members Yet</h3>
                    <p class="text-[#D1CDC7] mb-8 max-w-md mx-auto font-body">Your creative team is ready to grow. Register your first staff member to build your editorial collective.</p>
                </div>
            <?php else: ?>
                <?php foreach ($staffMembers as $member): 
                    $projectCount = $staff->getWorkload($member['id']); 
                ?>
                <div class="w-full max-w-[240px] bg-[#2a1a12] rounded-lg p-5 hover:bg-[#3a2b20] transition-all border border-[#3a2b20] flex flex-col mx-auto">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-[#C5A059] shadow-sm flex-shrink-0">
                            <img src="<?php echo $member['profile_image'] ?: 'https://via.placeholder.com/150'; ?>" class="w-full h-full object-cover" alt="Profile">
                        </div>
                        <a href="editstaff.php?id=<?php echo $member['id']; ?>" class="text-[#D1CDC7]/60 hover:text-[#C5A059] transition-colors mt-1">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                        </a>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-lg font-headline text-[#C5A059] font-bold leading-tight truncate"><?php echo htmlspecialchars($member['name']); ?></h3>
                        <p class="text-[11px] font-label font-bold text-[#D1CDC7] uppercase tracking-widest mt-1 opacity-70"><?php echo htmlspecialchars($member['role']); ?></p>
                    </div>
                    <div class="mt-auto space-y-2 pt-4 border-t border-[#3a2b20]">
                        <div class="flex items-center gap-2 text-[10px] text-[#D1CDC7]/60 font-label uppercase tracking-widest font-bold">
                            <span class="material-symbols-outlined text-sm">calendar_today</span>
                            Joined <?php echo date('M Y', strtotime($member['join_date'])); ?>
                        </div>
                        <div class="flex items-center gap-2 text-[10px] text-[#D1CDC7]/60 font-label uppercase tracking-widest font-bold">
                            <span class="material-symbols-outlined text-sm">work</span>
                            <?php echo $projectCount; ?> Projects
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <section class="mt-20 border-t border-[#3a2b20] pt-12">
            <div class="flex items-center gap-4 mb-8">
                <span class="h-px flex-1 bg-[#3a2b20]"></span>
                <h4 class="font-label text-xs uppercase tracking-[0.3em] text-[#D1CDC7] px-4">Role Distribution</h4>
                <span class="h-px flex-1 bg-[#3a2b20]"></span>
            </div>
            <div class="flex flex-wrap gap-4 justify-center">
                <?php 
                $stats = $staff->getStats();
                $roleColors = ['OWNER' => 'bg-[#C5A059]', 'ADMIN' => 'bg-[#C5A059]', 'ARTIST' => 'bg-[#6F585F]', 'EDITOR' => 'bg-[#283a25]'];
                foreach ($roleColors as $role => $color): ?>
                <div class="flex items-center gap-2 bg-[#2a1a12] p-4 px-6 rounded-lg border border-[#3a2b20]">
                    <div class="w-2 h-2 rounded-full <?php echo $color; ?>"></div>
                    <span class="text-sm font-label font-bold text-[#C5A059]"><?php echo $role; ?> (<?php echo $stats[strtolower($role).'s'] ?? 0; ?>)</span>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>
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
</script>
</body>
</html>