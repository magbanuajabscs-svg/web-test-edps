<?php
require_once 'config.php';
require_once 'Database.php';

// Ensure staff id from session is available (config.php starts the session)
$staffId = $_SESSION['user_id'] ?? null;

// Ensure assignments variable is always defined
// Fetch assignments for the logged-in staff so links point to real projects
$myAssignments = [];
if (!empty($staffId)) {
    try {
        $db = Database::getInstance();
        $myAssignments = $db->fetchAll(
            "SELECT p.*, pa.role_in_project FROM projects p JOIN project_assignments pa ON p.id = pa.project_id WHERE pa.staff_id = ? AND pa.status = 'assigned' ORDER BY p.event_date DESC",
            [$staffId]
        );
    } catch (Exception $e) {
        // Keep $myAssignments empty on error; avoid breaking the page
        $myAssignments = [];
    }
}

// Profile image fallback
$staffUsername = $_SESSION['username'] ?? '';
$staffProfileImage = $_SESSION['profile_image'] ?? '';
$initial = !empty($staffUsername) ? strtoupper(substr($staffUsername, 0, 1)) : 'S';
$svg = '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"><rect width="40" height="40" fill="#3E2723"/><text x="50%" y="50%" font-size="20" fill="#C5A059" text-anchor="middle" dominant-baseline="middle">'.htmlspecialchars($initial).'</text></svg>';
$defaultAvatar = 'data:image/svg+xml;utf8,'.rawurlencode($svg);
$profileImageSrc = !empty($staffProfileImage) ? htmlspecialchars($staffProfileImage) : $defaultAvatar;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>My Assignments | EDPS Studio</title>
    <style>html:not(.dark), html:not(.dark) body { background-color: #FFF8F3; color: #2D141D; } html.dark, html.dark body { background-color: #12100E; color: #D1CDC7; }</style>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@700&family=Manrope:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        "primary": "#4a2d37",
                        "secondary": "#6f585f",
                        "surface": "#fff8f3",
                        "gold": "#C5A059",
                        "ivory": "#F5F5F0"
                    },
                    fontFamily: {
                        "headline": ["Noto Serif"],
                        "body": ["Manrope"],
                        "label": ["Manrope"]
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeIn { animation: fadeIn 0.4s ease-out both; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        @media (max-width: 640px) {
            h1, h2, h3, h4, h5, h6 { font-size: calc(1em * 0.8); }
            body { font-size: 14px; }
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
        .dark .skeleton {
            background: linear-gradient(90deg, rgba(100,100,100,0.2) 25%, rgba(100,100,100,0.3) 50%, rgba(100,100,100,0.2) 75%);
            background-size: 1000px 100%;
            animation: skeleton-loading 2s infinite;
        }
        /* Prevent white flash on page load and transitions */
        html {
            background: #FFF8F3;
            color: #2D141D;
        }
        html.dark {
            background: #12100E;
            color: #D1CDC7;
        }
        body {
            transition: background-color 0.3s ease, color 0.3s ease, opacity 0.3s ease;
        }
    </style>
</head>
<body class="bg-[#FFF8F3] dark:bg-[#12100E] font-body text-[#2D141D] dark:text-[#D1CDC7] antialiased flex min-h-screen transition-colors duration-300">
    <?php $cur = basename($_SERVER['PHP_SELF']); ?>
    <aside class="hidden md:flex flex-col h-screen w-64 md:w-72 border-r bg-[#FFF8F3] dark:bg-[#1A1614] dark:border-[#2C1A12] py-8 px-6 sticky top-0 overflow-y-auto transition-colors duration-300">
        <div class="mb-6">
            <h1 class="text-2xl font-bold font-headline text-[#2D141D] dark:text-[#F5F5F0]">EDPS Studio</h1>
            <p class="text-xs text-[#745C63] dark:text-[#D1CDC7] mt-1">Staff Portal</p>
        </div>
        <!-- Profile panel removed from sidebar on Projects page per request -->
        <nav class="flex-1 space-y-2">
                <a href="staff-dashboard.php" class="<?php echo $cur=='staff-dashboard.php' ? 'flex items-center gap-4 text-[#2D141D] dark:text-[#C5A059] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#F9F2ED] dark:bg-[#2C1A12]' : 'flex items-center gap-4 text-[#745C63] dark:text-[#D1CDC7] pl-5 py-3 hover:bg-[#F9F2ED] dark:hover:bg-[#2C1A12]'; ?>">
                <span class="material-symbols-outlined">home</span><span class="font-medium">Home</span>
            </a>
                <a href="staff-projects.php" class="<?php echo $cur=='staff-projects.php' ? 'flex items-center gap-4 text-[#2D141D] dark:text-[#C5A059] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#F9F2ED] dark:bg-[#2C1A12]' : 'flex items-center gap-4 text-[#745C63] dark:text-[#D1CDC7] pl-5 py-3 hover:bg-[#F9F2ED] dark:hover:bg-[#2C1A12]'; ?>">
                <span class="material-symbols-outlined">check_box</span><span class="font-medium">My Projects</span>
            </a>
        </nav>
        <div class="mt-auto pt-6 border-t border-[#D2C3C6] dark:border-[#2C1A12]">
            <a class="flex items-center gap-4 text-[#745C63] dark:text-[#D1CDC7] pl-5 py-3 hover:bg-[#F9F2ED] dark:hover:bg-[#2C1A12]" href="staff-settings.php"><span class="material-symbols-outlined">settings</span><span class="font-medium">Settings</span></a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col animate-fadeIn">
        <header class="sticky top-0 z-40 flex justify-between items-center w-full px-4 sm:px-8 md:px-8 py-4 bg-[#FFF8F3]/90 dark:bg-[#1A1614]/80 backdrop-blur-md border-b border-[#D2C3C6] dark:border-[#2C1A12]">
            <div class="md:hidden flex flex-col justify-center">
                <p class="text-sm font-headline font-bold text-[#2D141D] dark:text-[#F5F5F0]">EDPS Studio</p>
                <p class="text-[10px] text-[#745C63] dark:text-[#D1CDC7]">Staff Portal</p>
            </div>
            <div class="flex items-center gap-1 md:ml-auto">
                <button id="notifBtn" class="relative h-10 w-10 flex items-center justify-center rounded-full text-[#745C63] dark:text-[#D1CDC7] hover:text-[#C5A059] transition-colors" aria-label="Notifications">
                    <span class="material-symbols-outlined text-2xl">notifications</span>
                    <span id="notifBadge" class="absolute -top-1 -right-1 min-w-[18px] h-5 rounded-full bg-red-500 text-white text-[11px] font-bold flex items-center justify-center px-1 hidden">0</span>
                </button>

                <a href="staff-settings.php#account-info" class="flex items-center rounded-full overflow-hidden" aria-label="Account settings">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full overflow-hidden bg-primary dark:bg-[#C5A059] flex items-center justify-center flex-shrink-0">
                        <img class="w-full h-full object-cover" src="<?php echo $profileImageSrc; ?>" alt="Profile"/>
                    </div>
                </a>
            </div>
        </header>

        <section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full pb-24 md:pb-0">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <main class="lg:col-span-2">
                    <h2 class="text-2xl sm:text-3xl font-headline font-bold text-[#2D141D] dark:text-[#F5F5F0] mb-4">My Project Assignments</h2>

                    <!-- Submenu Tabs -->
                    <div class="mb-4 overflow-x-auto">
                        <div class="inline-flex gap-2 px-1 whitespace-nowrap">
                            <button data-filter="all" class="tab-btn rounded-full px-3 py-1 text-[11px] sm:text-[12px] bg-[#C5A059] text-[#12100E] border border-[#C5A059] shadow-[0_0_15px_rgba(197,160,89,0.5)] font-bold active:scale-95 transition-all duration-200">Total Projects</button>
                            <button data-filter="process" class="tab-btn rounded-full px-3 py-1 text-[11px] sm:text-[12px] bg-transparent border border-[#D2C3C6] dark:border-[#2C1A12] text-[#D1CDC7] hover:text-[#F5F5F0] shadow-none font-medium active:scale-95 transition-all duration-200">On Process</button>
                            <button data-filter="hold" class="tab-btn rounded-full px-3 py-1 text-[11px] sm:text-[12px] bg-transparent border border-[#D2C3C6] dark:border-[#2C1A12] text-[#D1CDC7] hover:text-[#F5F5F0] shadow-none font-medium active:scale-95 transition-all duration-200">On Hold</button>
                            <button data-filter="finished" class="tab-btn rounded-full px-3 py-1 text-[11px] sm:text-[12px] bg-transparent border border-[#D2C3C6] dark:border-[#2C1A12] text-[#D1CDC7] hover:text-[#F5F5F0] shadow-none font-medium active:scale-95 transition-all duration-200">Finished</button>
                        </div>
                    </div>

                    <div class="space-y-4 md:space-y-0 md:grid md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 md:gap-6 lg:gap-6">
                        <!-- Standardized test project cards -->
                        <a href="project-details.php" class="block group h-full flex flex-col bg-white dark:bg-[#1A1614] rounded-3xl border border-[#D2C3C6] dark:border-[#2C1A12] p-3 md:p-6 mb-3 md:mb-4 transition-all hover:border-[#C5A059] shadow-sm" data-status="process">
                            <div class="flex flex-col gap-2 md:gap-4 h-full">
                                <div>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#745C63] dark:text-[#D1CDC7] font-label">Lead Artist</span>
                                    <h3 class="text-lg md:text-xl font-serif text-[#2D141D] dark:text-[#F5F5F0] mt-2 font-bold">The Montgomery Wedding</h3>
                                    <p class="text-xs md:text-sm text-[#745C63] dark:text-[#D1CDC7] mt-2">Role: Lead Photographer | Assigned: Maria, Jonas</p>
                                </div>
                                <div class="mt-auto flex justify-between items-center">
                                    <span class="text-[9px] md:text-[10px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit bg-[#C5A059]/10 dark:bg-[#C5A059]/20 text-[#967335] dark:text-[#E5C78B] border-[#C5A059]/40 dark:border-[#C5A059]/50">On Process</span>
                                    <span class="text-[12px] text-[#745C63] dark:text-[#D1CDC7]">Deadline: Jan 10, 2025</span>
                                </div>
                            </div>
                        </a>

                        <a href="project-details.php" class="block group h-full flex flex-col bg-white dark:bg-[#1A1614] rounded-3xl border border-[#D2C3C6] dark:border-[#2C1A12] p-3 md:p-6 mb-3 md:mb-4 transition-all hover:border-[#C5A059] shadow-sm" data-status="hold">
                            <div class="flex flex-col gap-2 md:gap-4 h-full">
                                <div>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#745C63] dark:text-[#D1CDC7] font-label">Editor</span>
                                    <h3 class="text-lg md:text-xl font-serif text-[#2D141D] dark:text-[#F5F5F0] mt-2 font-bold">Portfolio Edits Vol. II</h3>
                                    <p class="text-xs md:text-sm text-[#745C63] dark:text-[#D1CDC7] mt-2">Role: Editor | Assigned: Ramon, Bea</p>
                                </div>
                                <div class="mt-auto flex justify-between items-center">
                                    <span class="text-[9px] md:text-[10px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit bg-[#ba1a1a]/10 dark:bg-[#ba1a1a]/20 text-[#93000a] dark:text-[#ffdad6] border-[#ba1a1a]/30 dark:border-[#ba1a1a]/50">On Hold</span>
                                    <span class="text-[12px] text-[#745C63] dark:text-[#D1CDC7]">Deadline: Mar 12, 2025</span>
                                </div>
                            </div>
                        </a>

                        <a href="project-details.php" class="block group h-full flex flex-col bg-white dark:bg-[#1A1614] rounded-3xl border border-[#D2C3C6] dark:border-[#2C1A12] p-3 md:p-6 mb-3 md:mb-4 transition-all hover:border-[#C5A059] shadow-sm" data-status="finished">
                            <div class="flex flex-col gap-2 md:gap-4 h-full">
                                <div>
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#745C63] dark:text-[#D1CDC7] font-label">Editor</span>
                                    <h3 class="text-lg md:text-xl font-serif text-[#2D141D] dark:text-[#F5F5F0] mt-2 font-bold">Vogue Cover Retouching</h3>
                                    <p class="text-xs md:text-sm text-[#745C63] dark:text-[#D1CDC7] mt-2">Role: Lead Editor | Assigned: Elena Rossi</p>
                                </div>
                                <div class="mt-auto flex justify-between items-center">
                                    <span class="text-[9px] md:text-[10px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit bg-[#3e513a]/10 dark:bg-[#3e513a]/30 text-[#21361a] dark:text-[#d3e9ca] border-[#3e513a]/30 dark:border-[#3e513a]/50">Finished</span>
                                    <span class="text-[12px] text-[#745C63] dark:text-[#D1CDC7]">Deadline: Dec 01, 2024</span>
                                </div>
                            </div>
                        </a>

                        <?php foreach ($myAssignments as $proj): ?>
                            <a href="project-details.php?id=<?php echo htmlspecialchars($proj['id']); ?>" class="block h-full">
                            <div class="bg-white dark:bg-[#1A1614] p-3 md:p-6 rounded-3xl shadow-sm border border-[#D2C3C6] dark:border-[#2C1A12] flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 md:gap-4 hover:shadow-md transition-all duration-300 md:h-full">
                                <div>
                                    <span class="text-[8px] sm:text-[10px] font-bold uppercase tracking-widest text-[#C5A059] bg-[#F9F2ED] dark:bg-[#C5A059]/20 text-[9px] px-2 py-1 md:text-[10px] md:px-3 md:py-1 rounded-full font-label">Role: <?php echo htmlspecialchars($proj['role_in_project']); ?></span>
                                    <h3 class="font-bold font-headline text-lg md:text-xl mt-3 text-[#2D141D] dark:text-[#F5F5F0]"><?php echo htmlspecialchars($proj['name']); ?></h3>
                                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 md:gap-4 mt-2 text-xs md:text-sm">
                                        <span class="text-[#745C63] dark:text-[#D1CDC7]">
                                            <span class="text-[8px] sm:text-[10px] font-bold uppercase tracking-widest text-[#C5A059] font-label">Client:</span><br/>
                                            <?php echo htmlspecialchars($proj['client_name']); ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-2 md:mt-0 flex items-center gap-2">
                                    <?php
                                    $badgeText = $proj['status'] ?? '';
                                    $st = strtolower($badgeText);
                                    if (strpos($st, 'process') !== false || $st === 'in_progress') {
                                        $badgeClass = 'text-[9px] md:text-[10px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit bg-[#C5A059]/10 dark:bg-[#C5A059]/20 text-[#967335] dark:text-[#E5C78B] border-[#C5A059]/40 dark:border-[#C5A059]/50';
                                    } elseif (strpos($st, 'hold') !== false || strpos($st, 'approval') !== false || $st === 'planning') {
                                        $badgeClass = 'text-[9px] md:text-[10px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit bg-[#ba1a1a]/10 dark:bg-[#ba1a1a]/20 text-[#93000a] dark:text-[#ffdad6] border-[#ba1a1a]/30 dark:border-[#ba1a1a]/50';
                                    } elseif (strpos($st, 'finish') !== false || strpos($st, 'completed') !== false) {
                                        $badgeClass = 'text-[9px] md:text-[10px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit bg-[#3e513a]/10 dark:bg-[#3e513a]/30 text-[#21361a] dark:text-[#d3e9ca] border-[#3e513a]/30 dark:border-[#3e513a]/50';
                                    } else {
                                        $badgeClass = 'text-[9px] md:text-[10px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit bg-transparent dark:bg-transparent text-[#2D141D] dark:text-[#D1CDC7] border-[#D2C3C6] dark:border-[#2C1A12]';
                                    }
                                    ?>
                                    <span class="<?php echo $badgeClass; ?>"><?php echo htmlspecialchars($badgeText); ?></span>
                                </div>
                            </div>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-transparent">&nbsp;</span>
                                <span class="text-[12px] text-[#745C63] dark:text-[#D1CDC7]"><?php echo !empty($proj['event_date']) ? date('M d, Y', strtotime($proj['event_date'])) : 'TBD'; ?></span>
                            </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </main>

                <!-- aside removed: staff account panel intentionally omitted on Projects page for compact mobile viewport -->
            </div>
        </section>
    </main>

    <!-- Mobile Bottom Navigation -->
    <nav class="fixed md:hidden bottom-0 w-full z-50 bg-[#FFF8F3]/90 dark:bg-[#1A1614]/80 backdrop-blur-md border-t border-[#D2C3C6] dark:border-[#2C1A12] flex items-center py-3 pb-[calc(0.75rem+env(safe-area-inset-bottom)))]">
        <a href="staff-dashboard.php" class="flex-1 flex flex-col items-center justify-center text-[#745C63] dark:text-[#D1CDC7] hover:text-[#C5A059] transition-colors active:scale-95 duration-200">
            <span class="material-symbols-outlined text-2xl">home</span>
        </a>
        <a href="staff-projects.php" class="flex-1 flex flex-col items-center justify-center text-[#745C63] dark:text-[#D1CDC7] hover:text-[#C5A059] transition-colors active:scale-95 duration-200">
            <span class="material-symbols-outlined text-2xl">check_box</span>
        </a>
        <a href="staff-settings.php#account-info" class="flex-1 flex flex-col items-center justify-center text-[#745C63] dark:text-[#D1CDC7] hover:text-[#C5A059] transition-colors active:scale-95 duration-200">
            <span class="material-symbols-outlined text-2xl">settings</span>
        </a>
    </nav>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const html = document.documentElement;
        const savedTheme = localStorage.getItem('staffPortalTheme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedTheme === 'dark' || (savedTheme === null && prefersDark)) {
            html.classList.add('dark');
        }

        const currentPage = window.location.pathname.split('/').pop() || 'staff-dashboard.php';
        const mobileNavLinks = document.querySelectorAll('nav.fixed a');

        mobileNavLinks.forEach(link => {
            const href = link.getAttribute('href');
            const linkPage = href.split('/').pop();
            if (linkPage && linkPage.split('#')[0] === currentPage) {
                link.classList.add('text-[#C5A059]');
            }
        });

        // Tabs / filter pills behavior — filter visible project cards by data-status
        const tabButtons = document.querySelectorAll('.tab-btn');
        const projectCards = Array.from(document.querySelectorAll('[data-status]'));
        function applyFilter(filter) {
            projectCards.forEach(card => {
                const status = card.getAttribute('data-status') || '';
                if (filter === 'all' || !filter) card.closest('a')?.parentElement ? card.closest('a').style.display = '' : card.style.display = '';
                if (filter !== 'all' && filter) {
                    const el = card.closest('a') || card;
                    if (status === filter) el.style.display = '';
                    else el.style.display = 'none';
                }
            });
        }

        if (tabButtons.length) {
            const ACTIVE = ['bg-[#C5A059]','text-[#12100E]','border-[#C5A059]','shadow-[0_0_15px_rgba(197,160,89,0.5)]','font-bold'];
            const INACTIVE = ['bg-transparent','border-[#D2C3C6]','dark:border-[#2C1A12]','shadow-none','font-medium','text-[#D1CDC7]','hover:text-[#F5F5F0]'];
            tabButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    tabButtons.forEach(b => {
                        ACTIVE.forEach(c => b.classList.remove(c));
                        INACTIVE.forEach(c => b.classList.add(c));
                    });
                    INACTIVE.forEach(c => this.classList.remove(c));
                    ACTIVE.forEach(c => this.classList.add(c));
                    const filter = this.getAttribute('data-filter') || 'all';
                    applyFilter(filter);
                });
            });
            // set first tab active and show all
            INACTIVE.forEach(c => tabButtons[0].classList.remove(c));
            ACTIVE.forEach(c => tabButtons[0].classList.add(c));
            applyFilter('all');
        }

        // Report modal behavior
        const modal = document.createElement('div');
        modal.id = 'reportModal';
        modal.className = 'hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 items-center justify-center';
        modal.innerHTML = `
            <div class="bg-white dark:bg-[#1A1614] border border-[#D2C3C6] dark:border-[#2C1A12] rounded-2xl p-6 w-full max-w-md relative">
                <h3 class="font-headline text-lg font-bold text-[#2D141D] dark:text-[#F5F5F0] mb-3">Submit Project Report</h3>
                <textarea id="reportText" class="w-full h-40 p-3 rounded-lg bg-[#F4EDE8] dark:bg-[#2C1A12] border border-[#D2C3C6] dark:border-[#3E2723] text-[#2D141D] dark:text-[#F5F5F0] text-sm" placeholder="Describe the issue or report..." ></textarea>
                <div class="mt-4 flex justify-end gap-2">
                    <button id="reportCancel" class="px-3 py-2 rounded-lg border border-[#D2C3C6] text-[#745C63] dark:text-[#D1CDC7]">Cancel</button>
                    <button id="reportSubmit" class="px-3 py-2 rounded-lg bg-[#C5A059] text-[#12100E]">Submit to Admin</button>
                </div>
                <button id="reportClose" class="absolute top-3 right-3 text-[#745C63] dark:text-[#D1CDC7]">✕</button>
            </div>
        `;
        document.body.appendChild(modal);

        function openReportModal() { modal.classList.remove('hidden'); modal.classList.add('flex'); }
        function closeReportModal() { modal.classList.add('hidden'); modal.classList.remove('flex'); }

        document.querySelectorAll('.report-open').forEach(btn => btn.addEventListener('click', openReportModal));
        document.getElementById('reportCancel')?.addEventListener('click', closeReportModal);
        document.getElementById('reportClose')?.addEventListener('click', closeReportModal);
        document.getElementById('reportSubmit')?.addEventListener('click', function() { closeReportModal(); alert('Report submitted (UI only)'); });

        // Ensure project-card anchors always navigate when clicked (works around cases
        // where other handlers or overlays may interfere). Only force navigation when
        // the click wasn't on an inner interactive control (button, link, input, etc.).
        const projectAnchors = document.querySelectorAll('.space-y-4 > a.block, .space-y-4 > a.block.group');
        projectAnchors.forEach(a => {
            a.addEventListener('click', function(e) {
                const innerInteractive = e.target.closest('button, input, textarea, select, label, a');
                if (innerInteractive && innerInteractive !== a) return; // let inner controls behave
                const href = a.getAttribute('href');
                if (!href) return;
                // If default was prevented by another listener, force navigation anyway
                document.body.style.transition = 'opacity 0.3s ease';
                document.body.style.opacity = '0';
                setTimeout(() => {
                    window.location.href = href;
                }, 300);
            });
        });

        // Page transition handler for other navigation links
        document.querySelectorAll('a:not([data-no-transition])').forEach(link => {
            const href = link.getAttribute('href');
            if (href && !href.startsWith('#') && !href.startsWith('javascript:') && !link.closest('.space-y-4')) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.body.style.transition = 'opacity 0.3s ease';
                    document.body.style.opacity = '0';
                    setTimeout(() => {
                        window.location.href = href;
                    }, 300);
                });
            }
        });

        // Notification bell behavior + unread count updater
        const notifBtn = document.getElementById('notifBtn');
        const notifBadge = document.getElementById('notifBadge');
        async function refreshNotifBadge(){
            try{
                const res = await fetch('api/notifications.php?action=unread_count');
                const j = await res.json();
                if(j.success){
                    const n = Number(j.unread || 0);
                    if(n > 0){ notifBadge.textContent = n>99? '99+': String(n); notifBadge.classList.remove('hidden'); }
                    else { notifBadge.classList.add('hidden'); }
                }
            }catch(e){ console.error('notif count error', e); }
        }
        refreshNotifBadge();
        setInterval(refreshNotifBadge, 30000);
        if (notifBtn) notifBtn.addEventListener('click', function(e){ e.preventDefault(); window.location.href = 'notifications.php'; });
    });
</script>
</html>