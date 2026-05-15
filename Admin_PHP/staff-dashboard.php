<?php
require_once 'config.php';
require_once 'Database.php';

// Check kung Staff ang naka-login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$db = Database::getInstance();
$staffId = $_SESSION['user_id'];

// Profile image fallback: use first letter SVG when no profile image set
$staffUsername = $_SESSION['username'] ?? '';
$staffProfileImage = $_SESSION['profile_image'] ?? '';
$initial = !empty($staffUsername) ? strtoupper(substr($staffUsername, 0, 1)) : 'S';
$svg = '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"><rect width="100%" height="100%" fill="#3E2723"/><text x="50%" y="50%" font-size="20" fill="#C5A059" text-anchor="middle" dominant-baseline="middle">'.htmlspecialchars($initial).'</text></svg>';
$defaultAvatar = 'data:image/svg+xml;utf8,'.rawurlencode($svg);
$profileImageSrc = !empty($staffProfileImage) ? htmlspecialchars($staffProfileImage) : $defaultAvatar;

// Kukuha ng stats na specific sa staff na ito base sa status ng projects
$statsSql = "SELECT 
    COUNT(*) as total,
    COUNT(CASE WHEN p.status = 'in_progress' THEN 1 END) as on_process,
    COUNT(CASE WHEN p.status = 'planning' THEN 1 END) as on_hold,
    COUNT(CASE WHEN p.status = 'completed' THEN 1 END) as finished
    FROM project_assignments pa
    JOIN projects p ON pa.project_id = p.id
    WHERE pa.staff_id = ? AND pa.status = 'assigned'";

$stats = [];
try {
    $stats = $db->fetch($statsSql, [$staffId]);
} catch (Exception $e) {
    error_log('Database error in staff-dashboard stats: ' . $e->getMessage());
    $stats = ['total' => 0, 'on_process' => 0, 'on_hold' => 0, 'finished' => 0];
}

$totalProjects = $stats['total'] ?? 0;
$onProcess = $stats['on_process'] ?? 0;
$onHold = $stats['on_hold'] ?? 0;
$finished = $stats['finished'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Staff Dashboard | EDPS Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&family=Manrope:wght@400;500;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
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
<body class="bg-[#FFF8F3] dark:bg-[#12100E] font-body text-[#745C63] dark:text-[#D1CDC7] antialiased flex min-h-screen transition-colors duration-300">
    <?php $cur = basename($_SERVER['PHP_SELF']); ?>
    <aside class="hidden md:flex flex-col h-screen w-64 md:w-72 border-r bg-[#FFF8F3] dark:bg-[#1A1614] dark:border-[#2C1A12] py-8 px-6 sticky top-0 overflow-y-auto transition-colors duration-300">
        <div class="mb-10">
            <h1 class="text-2xl font-bold font-headline text-[#2D141D] dark:text-[#F5F5F0]">EDPS Studio</h1>
            <p class="text-xs text-[#745C63] dark:text-[#D1CDC7] mt-1">Staff Portal</p>
        </div>
        <nav class="flex-1 space-y-2">
            <a href="staff-dashboard.php" class="<?php echo $cur=='staff-dashboard.php' ? 'flex items-center gap-4 text-[#2D141D] dark:text-[#C5A059] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#F9F2ED] dark:bg-[#2C1A12]' : 'flex items-center gap-4 text-[#745C63] dark:text-[#D1CDC7] pl-5 py-3 hover:bg-[#F9F2ED] dark:hover:bg-[#2C1A12]'; ?>">
                <span class="material-symbols-outlined">home</span>
                <span class="font-medium">Home</span>
            </a>
            <a href="staff-projects.php" class="<?php echo $cur=='staff-projects.php' ? 'flex items-center gap-4 text-[#2D141D] dark:text-[#C5A059] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#F9F2ED] dark:bg-[#2C1A12]' : 'flex items-center gap-4 text-[#745C63] dark:text-[#D1CDC7] pl-5 py-3 hover:bg-[#F9F2ED] dark:hover:bg-[#2C1A12]'; ?>">
                <span class="material-symbols-outlined">check_box</span>
                <span class="font-medium">My Projects</span>
            </a>
        </nav>
        <div class="mt-auto pt-6 border-t border-[#D2C3C6] dark:border-[#2C1A12]">
            <a href="staff-settings.php" class="<?php echo $cur=='staff-settings.php' ? 'flex items-center gap-4 text-[#2D141D] dark:text-[#C5A059] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#F9F2ED] dark:bg-[#2C1A12]' : 'flex items-center gap-4 text-secondary dark:text-[#D1CDC7] pl-5 py-3 hover:bg-[#F9F2ED] dark:hover:bg-[#2C1A12]'; ?>">
                <span class="material-symbols-outlined">settings</span>
                <span class="font-medium">Settings</span>
            </a>
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

        <section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full space-y-8 pb-24 md:pb-0">
            <div class="grid grid-cols-1 gap-6">
                <main class="space-y-8">
                    <h2 class="text-2xl sm:text-3xl font-headline font-bold text-[#2D141D] dark:text-[#F5F5F0]">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

                    <!-- Mobile: Announcements at top -->
                    <div class="lg:hidden mb-6">
                        <div class="bg-white dark:bg-[#1A1614] rounded-xl p-4 border border-[#EDE0D7]/60 dark:border-[#2A2A2A]">
                            <div class="flex items-center justify-between">
                                <h3 class="font-medium text-sm text-[#2D141D] dark:text-[#F5F5F0]">Latest Announcements</h3>
                            </div>
                            <?php foreach ($announcements as $a): ?>
                                <div class="mt-3 p-3 rounded-md bg-[#FFF8F3]/60 dark:bg-[#111] flex items-start justify-between">
                                    <div>
                                        <strong class="block text-sm text-[#2D141D] dark:text-[#F5F5F0]"><?php echo htmlentities($a['title']); ?></strong>
                                        <div class="text-xs opacity-80 text-[#745C63] dark:text-[#D1CDC7]"><?php echo htmlentities($a['summary']); ?></div>
                                    </div>
                                    <span class="material-symbols-outlined text-[#C5A059]">campaign</span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div id="stat-cards" class="flex flex-nowrap overflow-x-auto hide-scrollbar whitespace-nowrap w-full pb-2 gap-3 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6 lg:gap-6 mb-8">
                        <div data-filter="all" class="status-pill shrink-0 w-28 md:w-full h-32 sm:w-32 sm:h-36 bg-white dark:bg-[#1A1614] rounded-xl p-2 text-center cursor-pointer transition-all duration-200 flex flex-col font-bold border-2 border-[#C5A059] shadow-[0_0_15px_rgba(197,160,89,0.5)]">
                            <div class="h-10 sm:h-12">
                                <div class="flex justify-end">
                                    <div class="text-[#C5A059] material-symbols-outlined">folder_shared</div>
                                </div>
                                <div class="flex justify-start mt-1">
                                    <div class="text-[8px] sm:text-[9px] uppercase tracking-widest text-[#745C63] dark:text-[#D1CDC7] whitespace-nowrap">Total Projects</div>
                                </div>
                            </div>
                            <div class="flex-1 flex items-center justify-center">
                                <p class="text-2xl sm:text-3xl font-headline font-bold text-[#2D141D] dark:text-[#F5F5F0]"><?php echo $totalProjects; ?></p>
                            </div>
                        </div>

                        <div data-filter="process" class="status-pill shrink-0 w-28 md:w-full h-32 sm:w-32 sm:h-36 bg-transparent dark:bg-transparent rounded-xl border border-[#D2C3C6] dark:border-[#2C1A12] p-2 text-center shadow-none cursor-pointer transition-all duration-200 flex flex-col font-medium text-[#D1CDC7] hover:text-[#F5F5F0]">
                            <div class="h-10 sm:h-12">
                                <div class="flex justify-end">
                                    <div class="text-[#C5A059] material-symbols-outlined">pending_actions</div>
                                </div>
                                <div class="flex justify-start mt-1">
                                    <div class="text-[8px] sm:text-[9px] uppercase tracking-widest text-[#745C63] dark:text-[#D1CDC7] whitespace-nowrap">On Process</div>
                                </div>
                            </div>
                            <div class="flex-1 flex items-center justify-center">
                                <p class="text-2xl sm:text-3xl font-headline font-bold text-[#2D141D] dark:text-[#F5F5F0]"><?php echo $onProcess; ?></p>
                            </div>
                        </div>

                        <div data-filter="hold" class="status-pill shrink-0 w-28 md:w-full h-32 sm:w-32 sm:h-36 bg-transparent dark:bg-transparent rounded-xl border border-[#D2C3C6] dark:border-[#2C1A12] p-2 text-center shadow-none cursor-pointer transition-all duration-200 flex flex-col font-medium text-[#D1CDC7] hover:text-[#F5F5F0]">
                            <div class="h-10 sm:h-12">
                                <div class="flex justify-end">
                                    <div class="text-[#C5A059] material-symbols-outlined">pause_circle</div>
                                </div>
                                <div class="flex justify-start mt-1">
                                    <div class="text-[8px] sm:text-[9px] uppercase tracking-widest text-[#745C63] dark:text-[#D1CDC7] whitespace-nowrap">On Hold</div>
                                </div>
                            </div>
                            <div class="flex-1 flex items-center justify-center">
                                <p class="text-2xl sm:text-3xl font-headline font-bold text-[#745C63] dark:text-[#F5F5F0]"><?php echo $onHold; ?></p>
                            </div>
                        </div>

                        <div data-filter="finished" class="status-pill shrink-0 w-28 md:w-full h-32 sm:w-32 sm:h-36 bg-transparent dark:bg-transparent rounded-xl border border-[#D2C3C6] dark:border-[#2C1A12] p-2 text-center shadow-none cursor-pointer transition-all duration-200 flex flex-col font-medium text-[#D1CDC7] hover:text-[#F5F5F0]">
                            <div class="h-10 sm:h-12">
                                <div class="flex justify-end">
                                    <div class="text-[#C5A059] material-symbols-outlined">task_alt</div>
                                </div>
                                <div class="flex justify-start mt-1">
                                    <div class="text-[8px] sm:text-[9px] uppercase tracking-widest text-[#745C63] dark:text-[#D1CDC7] whitespace-nowrap">Finished</div>
                                </div>
                            </div>
                            <div class="flex-1 flex items-center justify-center">
                                <p class="text-2xl sm:text-3xl font-headline font-bold text-tertiary dark:text-[#F5F5F0]"><?php echo $finished; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Studio Directory & Projects -->
                    <div>
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 gap-4">
                            <h3 class="font-headline text-lg sm:text-xl font-bold text-[#2D141D] dark:text-[#F5F5F0]">Projects</h3>
                            <div class="flex justify-end items-center gap-2 ml-auto w-full md:w-auto">
                                <input id="studioSearch" type="search" placeholder="Search projects, staff, or role..." class="px-3 py-2 rounded-lg border border-[#2C1A12] bg-transparent text-sm w-48 sm:w-64 focus:outline-none focus:ring-2 focus:ring-[#C5A059] active:scale-95 transition-all duration-200" />
                                <div class="relative">
                                    <button id="roleFilter" data-value="all" aria-haspopup="true" class="w-10 h-10 flex items-center justify-center rounded-lg border border-[#2C1A12] bg-transparent text-sm focus:outline-none transition-colors hover:bg-[#F9F2ED] dark:hover:bg-[#2C1A12]">
                                        <span class="material-symbols-outlined">filter_list</span>
                                    </button>
                                    <div id="roleMenu" class="hidden absolute right-0 mt-2 bg-white dark:bg-[#1A1614] border border-gray-100 dark:border-[#2C1A12] rounded-lg shadow-lg z-50 min-w-[140px] overflow-hidden">
                                        <button class="w-full text-left px-3 py-2 text-sm font-label role-option" data-value="all">All Roles</button>
                                        <button class="w-full text-left px-3 py-2 text-sm font-label role-option" data-value="Artist">Artist</button>
                                        <button class="w-full text-left px-3 py-2 text-sm font-label role-option" data-value="Editor">Editor</button>
                                        <button class="w-full text-left px-3 py-2 text-sm font-label role-option" data-value="Stylist">Stylist</button>
                                        <button class="w-full text-left px-3 py-2 text-sm font-label role-option" data-value="Bindery">Bindery</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="studioGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php
                            $projSql = "SELECT p.* FROM project_assignments pa JOIN projects p ON pa.project_id = p.id WHERE pa.staff_id = ? AND pa.status = 'assigned' ORDER BY p.created_at DESC LIMIT 6";
                            $assignedProjects = $db->fetchAll($projSql, [$staffId]);

                            // If the staff has no assigned projects, show latest global projects so seeded/demo projects are visible
                            if (empty($assignedProjects)) {
                                $assignedProjects = $db->fetchAll("SELECT * FROM projects ORDER BY created_at DESC LIMIT 6");
                            }

                            if (!empty($assignedProjects)):
                                foreach ($assignedProjects as $p):
                                    $pid = $p['id'];
                                    $status = $p['status'] ?? 'planning';
                                    $dataStatus = ($status === 'in_progress') ? 'process' : (($status === 'completed') ? 'finished' : 'hold');
                                    $statusLabel = ($status === 'in_progress') ? 'On Process' : (($status === 'completed') ? 'Completed' : 'For Approval');
                            ?>
                            <a href="project-details.php?id=<?php echo $pid; ?>" class="block group h-full">
                                <div data-role="" data-status="<?php echo $dataStatus; ?>" class="h-full flex flex-col bg-white dark:bg-[#1A1614] rounded-3xl border border-[#D2C3C6] dark:border-[#2C1A12] p-3 md:p-6 mb-3 md:mb-4 transition-all hover:border-[#C5A059] active:scale-95">
                                    <div>
                                        <h4 class="font-headline text-lg md:text-xl font-bold text-[#2D141D] dark:text-[#F5F5F0]"><?php echo htmlspecialchars($p['name'] ?? 'Project'); ?></h4>
                                            <p class="text-xs md:text-sm text-[#745C63] dark:text-[#D1CDC7] mt-2">Client: <?php echo htmlspecialchars($p['client_name'] ?? '—'); ?></p>
                                            <p class="text-xs md:text-sm text-[#745C63] dark:text-[#D1CDC7] mt-1">Deadline: <?php echo !empty($p['event_date']) ? date('M d, Y', strtotime($p['event_date'])) : 'TBD'; ?></p>
                                    </div>
                                    <div class="mt-4 flex items-center justify-between">
                                            <?php
                                            $badgeText = $statusLabel;
                                            $statRaw = strtolower($status);
                                            if (strpos($statRaw, 'in_progress') !== false || strpos($statRaw, 'process') !== false) {
                                                $badgeClass = 'text-[8px] md:text-[9px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit whitespace-nowrap leading-tight bg-[#C5A059]/10 dark:bg-[#C5A059]/20 text-[#967335] dark:text-[#E5C78B] border-[#C5A059]/40 dark:border-[#C5A059]/50';
                                            } elseif (strpos($statRaw, 'completed') !== false || strpos($statRaw, 'finish') !== false) {
                                                $badgeClass = 'text-[8px] md:text-[9px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit whitespace-nowrap leading-tight bg-[#3e513a]/10 dark:bg-[#3e513a]/30 text-[#21361a] dark:text-[#d3e9ca] border-[#3e513a]/30 dark:border-[#3e513a]/50';
                                            } else {
                                                $badgeClass = 'text-[8px] md:text-[9px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit whitespace-nowrap leading-tight bg-[#ba1a1a]/10 dark:bg-[#ba1a1a]/20 text-[#93000a] dark:text-[#ffdad6] border-[#ba1a1a]/30 dark:border-[#ba1a1a]/50';
                                            }
                                            ?>
                                            <span class="<?php echo $badgeClass; ?>"><?php echo htmlspecialchars($badgeText); ?></span>
                                        <span class="text-[12px] text-secondary dark:text-[#D1CDC7]"><?php echo htmlspecialchars($p['location'] ?? ''); ?></span>
                                    </div>
                                </div>
                            </a>
                            <?php
                                endforeach;
                            else:
                            // fallback: render standardized test project cards
                            ?>
                            <a href="project-details.php" class="block group h-full flex flex-col bg-white dark:bg-[#1A1614] rounded-3xl border border-[#D2C3C6] dark:border-[#2C1A12] p-3 md:p-6 mb-3 md:mb-4 transition-all hover:border-[#C5A059] shadow-sm" data-status="process">
                                <div class="flex flex-col gap-2 md:gap-4 h-full">
                                    <div>
                                        <h4 class="text-lg md:text-xl font-serif text-[#2D141D] dark:text-[#F5F5F0]">The Montgomery Wedding</h4>
                                        <p class="text-xs md:text-sm text-[#745C63] dark:text-[#D1CDC7] mt-2">Role: Lead Photographer | Assigned: Maria, Jonas</p>
                                    </div>
                                    <div class="mt-auto flex justify-between items-center">
                                        <span class="text-[8px] md:text-[9px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit whitespace-nowrap leading-tight bg-[#C5A059]/10 dark:bg-[#C5A059]/20 text-[#967335] dark:text-[#E5C78B] border-[#C5A059]/40 dark:border-[#C5A059]/50">On Process</span>
                                        <span class="text-[12px] text-[#745C63] dark:text-[#D1CDC7]">Deadline: Jan 10, 2025</span>
                                    </div>
                                </div>
                            </a>

                            <a href="project-details.php" class="block group h-full flex flex-col bg-white dark:bg-[#1A1614] rounded-3xl border border-[#D2C3C6] dark:border-[#2C1A12] p-3 md:p-6 mb-3 md:mb-4 transition-all hover:border-[#C5A059] shadow-sm" data-status="hold">
                                <div class="flex flex-col gap-2 md:gap-4 h-full">
                                    <div>
                                        <h4 class="text-lg md:text-xl font-serif text-[#2D141D] dark:text-[#F5F5F0]">Portfolio Edits Vol. II</h4>
                                        <p class="text-xs md:text-sm text-[#745C63] dark:text-[#D1CDC7] mt-2">Role: Editor | Assigned: Ramon, Bea</p>
                                    </div>
                                    <div class="mt-auto flex justify-between items-center">
                                        <span class="text-[8px] md:text-[9px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit whitespace-nowrap leading-tight bg-[#ba1a1a]/10 dark:bg-[#ba1a1a]/20 text-[#93000a] dark:text-[#ffdad6] border-[#ba1a1a]/30 dark:border-[#ba1a1a]/50">On Hold</span>
                                        <span class="text-[12px] text-[#745C63] dark:text-[#D1CDC7]">Deadline: Mar 12, 2025</span>
                                    </div>
                                </div>
                            </a>

                            <a href="project-details.php" class="block group h-full flex flex-col bg-white dark:bg-[#1A1614] rounded-3xl border border-[#D2C3C6] dark:border-[#2C1A12] p-3 md:p-6 mb-3 md:mb-4 transition-all hover:border-[#C5A059] shadow-sm" data-status="finished">
                                <div class="flex flex-col gap-2 md:gap-4 h-full">
                                    <div>
                                        <h4 class="text-lg md:text-xl font-serif text-[#2D141D] dark:text-[#F5F5F0]">Vogue Cover Retouching</h4>
                                        <p class="text-xs md:text-sm text-[#745C63] dark:text-[#D1CDC7] mt-2">Role: Lead Editor | Assigned: Elena Rossi</p>
                                    </div>
                                    <div class="mt-auto flex justify-between items-center">
                                        <span class="text-[8px] md:text-[9px] px-2 py-1 md:px-3 rounded-full uppercase tracking-widest font-bold border flex items-center justify-center w-fit whitespace-nowrap leading-tight bg-[#3e513a]/10 dark:bg-[#3e513a]/30 text-[#21361a] dark:text-[#d3e9ca] border-[#3e513a]/30 dark:border-[#3e513a]/50">Finished</span>
                                        <span class="text-[12px] text-[#745C63] dark:text-[#D1CDC7]">Deadline: Dec 01, 2024</span>
                                    </div>
                                </div>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </main>

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
            // Normalize comparison to file name + optional hash
            const linkPage = href.split('/').pop();
            if (linkPage && (linkPage.split('#')[0] === currentPage || (currentPage === '' && linkPage.split('#')[0] === 'staff-dashboard.php'))) {
                link.classList.add('text-[#C5A059]');
            }
        });
    });

        // Simple search & filter for Projects (UI-only)
        (function() {
            const search = document.getElementById('studioSearch');
            const filterBtn = document.getElementById('roleFilter');
            const roleMenu = document.getElementById('roleMenu');
            const grid = document.getElementById('studioGrid');
            if (!grid) return;

            function getRoleValue() {
                if (!filterBtn) return 'all';
                return (filterBtn.tagName === 'SELECT') ? (filterBtn.value || 'all') : (filterBtn.getAttribute('data-value') || 'all');
            }

            function applyFilters() {
                const q = (search?.value || '').toLowerCase().trim();
                const role = getRoleValue();
                Array.from(grid.children).forEach(card => {
                    const text = card.innerText.toLowerCase();
                    const cardRole = (card.getAttribute('data-role') || '').toLowerCase();
                    const matchesQuery = q === '' || text.indexOf(q) !== -1;
                    const matchesRole = role === 'all' || cardRole === role.toLowerCase();
                    card.style.display = (matchesQuery && matchesRole) ? '' : 'none';
                });
            }

            // Search input
            search?.addEventListener('input', applyFilters);

            // Role filter button + menu behaviour
            if (filterBtn && roleMenu) {
                filterBtn.addEventListener('click', function(e){
                    e.stopPropagation();
                    roleMenu.classList.toggle('hidden');
                });

                document.addEventListener('click', function(e){
                    if (!filterBtn.contains(e.target) && !roleMenu.contains(e.target)) {
                        roleMenu.classList.add('hidden');
                    }
                });

                const opts = Array.from(roleMenu.querySelectorAll('.role-option'));
                opts.forEach(opt => {
                    opt.addEventListener('click', function(){
                        const v = this.getAttribute('data-value') || 'all';
                        filterBtn.setAttribute('data-value', v);
                        roleMenu.classList.add('hidden');
                        applyFilters();
                    });
                });
            }
        })();

        // Status pill filtering (data-status)
        (function(){
            const pills = document.querySelectorAll('.status-pill');
            const cards = document.querySelectorAll('#studioGrid [data-status]');
            if (!pills.length) return;
            const ACTIVE = ['border-2','border-[#C5A059]','shadow-[0_0_15px_rgba(197,160,89,0.5)]'];
            const INACTIVE = ['border','border-[#D2C3C6]','dark:border-[#2C1A12]','shadow-none'];
            function setActive(pill){
                pills.forEach(p=>{
                    // remove any active classes and ensure inactive border/shadow
                    ACTIVE.forEach(c => p.classList.remove(c));
                    INACTIVE.forEach(c => p.classList.add(c));
                });
                // apply active classes to selected pill
                INACTIVE.forEach(c => pill.classList.remove(c));
                ACTIVE.forEach(c => pill.classList.add(c));
            }
            pills.forEach(p=>{
                p.addEventListener('click', function(){
                    setActive(this);
                    const f = this.getAttribute('data-filter');
                    cards.forEach(c=>{
                        const s = c.getAttribute('data-status');
                        c.style.display = (f === 'all' || s === f) ? '' : 'none';
                    });
                });
            });
            // init
            setActive(pills[0]);
        })();
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statCards = Array.from(document.querySelectorAll('#stat-cards [data-filter]'));
    const projectCards = Array.from(document.querySelectorAll('#studioGrid [data-status]'));

    function setActive(card) {
        const ACTIVE = ['border-2','border-[#C5A059]','shadow-[0_0_15px_rgba(197,160,89,0.5)]'];
        const INACTIVE = ['border','border-[#D2C3C6]','dark:border-[#2C1A12]','shadow-none'];
        statCards.forEach(c => {
            ACTIVE.forEach(cls => c.classList.remove(cls));
            INACTIVE.forEach(cls => c.classList.add(cls));
        });
        INACTIVE.forEach(cls => card.classList.remove(cls));
        ACTIVE.forEach(cls => card.classList.add(cls));
    }

    function applyFilter(filter) {
        projectCards.forEach(pc => {
            const status = pc.getAttribute('data-status') || '';
            const wrapper = pc.closest('a') || pc;
            if (filter === 'all' || !filter) wrapper.classList.remove('hidden');
            else if (status === filter) wrapper.classList.remove('hidden');
            else wrapper.classList.add('hidden');
        });
    }

    statCards.forEach(card => {
        card.addEventListener('click', function() {
            setActive(this);
            const f = this.getAttribute('data-filter') || 'all';
            applyFilter(f);
        });
    });

    // initialize default
    const defaultCard = document.querySelector('#stat-cards [data-filter="all"]');
    if (defaultCard) setActive(defaultCard);

    // Page transition handler to smooth navigation and prevent white flash
    document.querySelectorAll('a:not([data-no-transition])').forEach(link => {
        const href = link.getAttribute('href');
        if (href && !href.startsWith('#') && !href.startsWith('javascript:')) {
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
</script>
</html>