<?php
require_once 'config.php';
require_once 'Database.php';
require_once 'Project.php';

// Check if admin is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get project ID from URL
$projectId = $_GET['id'] ?? null;

if (!$projectId) {
    header('Location: stafflist.php');
    exit;
}

$db = Database::getInstance();
$projectManager = new Project();

// Fetch project details
$project = $projectManager->getById($projectId);

if (!$project) {
    header('Location: stafflist.php');
    exit;
}

// Fetch assigned staff
$assignedStaff = $projectManager->getAssignedStaff($projectId);

// Handle priority toggle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    if ($_POST['action'] === 'toggle_priority') {
        // Check if it's already marked as high priority (could check notes or add a priority field)
        $currentNotes = $project['notes'] ?? '';
        $isPriority = strpos($currentNotes, '[PRIORITY]') !== false;
        
        if ($isPriority) {
            // Remove priority marker
            $newNotes = str_replace('[PRIORITY] ', '', $currentNotes);
        } else {
            // Add priority marker
            $newNotes = '[PRIORITY] ' . $currentNotes;
        }
        
        $sql = "UPDATE projects SET notes = ? WHERE id = ?";
        $result = $db->update($sql, [$newNotes, $projectId]);
        
        echo json_encode([
            'success' => $result,
            'isPriority' => !$isPriority,
            'message' => $isPriority ? 'Priority removed' : 'Marked as high priority'
        ]);
        exit;
    }
    
    if ($_POST['action'] === 'log_followup') {
        // Add follow-up marker and log it
        $currentNotes = $project['notes'] ?? '';
        $timestamp = date('Y-m-d H:i:s');
        $followupNote = "[FOLLOWUP: $timestamp] Client requested update. ";
        $newNotes = $followupNote . $currentNotes;
        
        $sql = "UPDATE projects SET notes = ?, status = 'in_progress' WHERE id = ?";
        $result = $db->update($sql, [$newNotes, $projectId]);
        
        // Log activity
        $logSql = "INSERT INTO activity_log (user_id, action, description, entity_type, entity_id) VALUES (?, ?, ?, ?, ?)";
        $db->insert($logSql, [
            $_SESSION['user_id'],
            'followup',
            'Client follow-up logged',
            'project',
            $projectId
        ]);
        
        echo json_encode([
            'success' => $result,
            'message' => 'Client follow-up logged successfully'
        ]);
        exit;
    }
}

// Re-fetch project to get updated data if POST was successful
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project = $projectManager->getById($projectId);
}

$isPriority = strpos($project['notes'] ?? '', '[PRIORITY]') !== false;
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo htmlspecialchars($project['name']); ?> - EDPS Studio</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&family=Manrope:wght@400;500;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
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
                    borderRadius: { "DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem", "3xl": "1.5rem" },
                    keyframes: {
                        pulse: {
                            '0%, 100%': { opacity: '1' },
                            '50%': { opacity: '.5' },
                        }
                    },
                    animation: {
                        pulse: 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .glass-nav { background: rgba(255, 248, 243, 0.8); backdrop-filter: blur(12px); }
        .pulse-border {
            animation: pulse-border 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse-border {
            0%, 100% {
                border-color: #C5A059;
                box-shadow: 0 0 0 0 rgba(197, 160, 89, 0.7);
            }
            50% {
                border-color: #D4B876;
                box-shadow: 0 0 0 4px rgba(197, 160, 89, 0.2);
            }
        }
    </style>
</head>
<body class="bg-[#12100E] font-body text-[#D1CDC7] antialiased flex min-h-screen">
    <!-- Sidebar -->
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
            <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 group border-l-4 border-[#C5A059] bg-[#2C1A12]" href="stafflist.php">
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
        <!-- Top AppBar -->
        <header class="sticky top-0 z-40 flex justify-between items-center w-full px-8 py-4 bg-[#1A1614]/80 backdrop-blur-md text-[#F5F5F0] font-['Manrope'] font-medium border-b border-[#2C1A12]">
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-2xl text-[#C5A059]" data-icon="menu">menu</span>
                <h2 class="text-lg font-bold text-[#F5F5F0]">Project Details</h2>
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
        <section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full overflow-y-auto">
            <!-- Back Link -->
            <div class="mb-10">
                <a class="inline-flex items-center text-[#D1CDC7] hover:text-[#C5A059] transition-colors font-body text-sm font-bold group" href="stafflist.php">
                    <span class="material-symbols-outlined text-[18px] mr-2 transition-transform group-hover:-translate-x-1" data-icon="arrow_back">arrow_back</span>
                    Back to Projects
                </a>
            </div>

            <!-- Project Header -->
            <div class="mb-16 flex items-end justify-between">
                <div>
                    <h1 class="font-headline text-5xl font-bold text-[#F5F5F0] tracking-tight leading-none mb-4">
                        <?php echo htmlspecialchars($project['name']); ?>
                    </h1>
                    <div class="flex items-center gap-3 flex-wrap">
                        <span class="px-4 py-2 bg-[#3E2723] text-[#C5A059] text-xs font-bold uppercase tracking-widest rounded-full">
                            <?php echo ucfirst($project['status']); ?>
                        </span>
                        <?php if ($isPriority): ?>
                        <span class="px-4 py-2 bg-[#C5A059] text-[#1A1614] text-xs font-bold uppercase tracking-widest rounded-full animate-pulse">
                            🎯 PRIORITY
                        </span>
                        <?php endif; ?>
                        <span class="text-[#D1CDC7] text-sm font-medium">Event: <?php echo date('M d, Y', strtotime($project['event_date'] ?? 'now')); ?></span>
                    </div>
                </div>
            </div>

            <!-- Client Overview Card -->
            <div class="mb-16 bg-[#1A1614] rounded-3xl p-8 border border-[#2C1A12]">
                <h3 class="font-headline text-xl text-[#F5F5F0] font-bold mb-6 italic border-b border-[#C5A059]/20 pb-4">
                    Client Overview
                </h3>
                <div class="grid md:grid-cols-3 gap-8">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="material-symbols-outlined text-[#C5A059]">person</span>
                            <span class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider">Client Name</span>
                        </div>
                        <p class="text-[#F5F5F0] text-lg font-headline">
                            <?php echo htmlspecialchars($project['client_name'] ?? 'Not specified'); ?>
                        </p>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="material-symbols-outlined text-[#C5A059]">mail</span>
                            <span class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider">Email</span>
                        </div>
                        <p class="text-[#F5F5F0] text-lg break-all">
                            <?php echo htmlspecialchars($project['client_email'] ?? 'Not specified'); ?>
                        </p>
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="material-symbols-outlined text-[#C5A059]">phone</span>
                            <span class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider">Phone</span>
                        </div>
                        <p class="text-[#F5F5F0] text-lg">
                            <?php echo htmlspecialchars($project['client_phone'] ?? 'Not specified'); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Venue & Logistics Section -->
            <div class="mb-16 bg-[#1A1614] rounded-3xl overflow-hidden border-2 border-[#C5A059]/40">
                <div class="p-8">
                    <h3 class="font-headline text-xl text-[#F5F5F0] font-bold mb-6 italic border-b border-[#C5A059]/20 pb-4">
                        Venue & Logistics
                    </h3>
                    
                    <?php 
                    $location = $project['location'] ?? '';
                    $hasLocation = !empty($location);
                    $locationEncoded = urlencode($location);
                    ?>
                    
                    <!-- Map Container -->
                    <div class="mb-6 rounded-2xl overflow-hidden bg-[#2C1A12] h-80">
                        <?php if ($hasLocation): ?>
                        <iframe 
                            class="w-full h-full"
                            style="filter: grayscale(1) invert(0.9) contrast(1.2); border: none;"
                            src="https://www.google.com/maps?q=<?php echo $locationEncoded; ?>&output=embed"
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                        <?php else: ?>
                        <div class="w-full h-full flex flex-col items-center justify-center">
                            <span class="material-symbols-outlined text-6xl text-[#C5A059]/40 mb-4">location_on</span>
                            <p class="text-[#D1CDC7] font-body text-lg">Venue location not set for this project.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Location Details -->
                    <?php if ($hasLocation): ?>
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                        <div>
                            <p class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider mb-2">Full Address</p>
                            <p class="text-[#F5F5F0] text-lg font-headline">
                                <?php echo htmlspecialchars($location); ?>
                            </p>
                        </div>
                        <a 
                            href="https://www.google.com/maps/search/?api=1&query=<?php echo $locationEncoded; ?>" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-[#3E2723] text-[#C5A059] border border-[#C5A059]/30 rounded-2xl font-body font-bold uppercase tracking-widest hover:bg-[#4A3229] hover:border-[#C5A059]/60 transition-all duration-300 whitespace-nowrap"
                        >
                            <span class="material-symbols-outlined text-lg">directions</span>
                            Get Directions
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="flex items-center justify-between">
                        <p class="text-[#D1CDC7] text-sm italic">No location data available for this project.</p>
                        <a 
                            href="javascript:void(0)" 
                            class="inline-flex items-center gap-2 px-6 py-3 bg-[#3E2723] text-[#C5A059] border border-[#C5A059]/30 rounded-2xl font-body font-bold uppercase tracking-widest opacity-50 cursor-not-allowed"
                        >
                            <span class="material-symbols-outlined text-lg">directions</span>
                            Get Directions
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Project Description -->
            <div class="mb-16">
                <h3 class="font-headline text-xl text-[#F5F5F0] font-bold mb-4 italic border-b border-[#C5A059]/20 pb-4">
                    Project Description
                </h3>
                <p class="text-[#D1CDC7] leading-relaxed">
                    <?php echo nl2br(htmlspecialchars($project['description'] ?? 'No description provided')); ?>
                </p>
            </div>

            <!-- Production Team Section -->
            <div class="mb-16">
                <h3 class="font-headline text-xl text-[#F5F5F0] font-bold mb-6 italic border-b border-[#C5A059]/20 pb-4">
                    Production Team
                </h3>
                <?php if (!empty($assignedStaff)): ?>
                <div class="grid md:grid-cols-2 gap-6">
                    <?php foreach ($assignedStaff as $staff): ?>
                    <div class="bg-[#1A1614] rounded-3xl p-6 border border-[#2C1A12] hover:border-[#C5A059]/30 transition-all">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h4 class="font-headline text-lg text-[#F5F5F0] font-bold">
                                    <?php echo htmlspecialchars($staff['name']); ?>
                                </h4>
                                <p class="text-[#C5A059] text-sm font-bold uppercase tracking-widest mt-1">
                                    <?php echo htmlspecialchars($staff['role_in_project'] ?? ucfirst($staff['role'])); ?>
                                </p>
                            </div>
                            <span class="px-3 py-1 bg-[#3E2723] text-[#C5A059] text-xs font-bold uppercase rounded-full">
                                <?php echo ucfirst($staff['role']); ?>
                            </span>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-[#D1CDC7] text-sm">
                                <span class="material-symbols-outlined text-[18px] text-[#C5A059]">mail</span>
                                <span><?php echo htmlspecialchars($staff['email']); ?></span>
                            </div>
                            <div class="flex items-center gap-2 text-[#D1CDC7] text-sm">
                                <span class="material-symbols-outlined text-[18px] text-[#C5A059]">phone</span>
                                <span><?php echo htmlspecialchars($staff['phone'] ?? 'N/A'); ?></span>
                            </div>
                            <div class="flex items-center gap-2 text-[#D1CDC7] text-sm">
                                <span class="material-symbols-outlined text-[18px] text-[#C5A059]">calendar_today</span>
                                <span>Assigned: <?php echo date('M d, Y', strtotime($staff['assigned_date'])); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="bg-[#1A1614] rounded-3xl p-8 border border-[#2C1A12] text-center">
                    <span class="material-symbols-outlined text-5xl text-[#C5A059]/30 block mb-4">group</span>
                    <p class="text-[#D1CDC7]">No staff members assigned to this project yet.</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Project Actions Panel -->
            <div class="mb-16 bg-[#1A1614] rounded-3xl p-8 border border-[#2C1A12]">
                <h3 class="font-headline text-xl text-[#F5F5F0] font-bold mb-6 italic border-b border-[#C5A059]/20 pb-4">
                    Project Actions
                </h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Priority Toggle Button -->
                    <button onclick="togglePriority()" class="<?php echo $isPriority ? 'pulse-border border-2' : 'border border-[#C5A059]/30'; ?> bg-[#3E2723] text-[#C5A059] px-6 py-4 rounded-3xl font-body font-bold uppercase tracking-widest hover:bg-[#4A3229] transition-all duration-300 flex items-center justify-center gap-3 group">
                        <span class="material-symbols-outlined text-2xl">
                            <?php echo $isPriority ? 'star' : 'star_outline'; ?>
                        </span>
                        <span><?php echo $isPriority ? 'Remove Priority' : 'Mark as High Priority'; ?></span>
                    </button>

                    <!-- Follow-up Button -->
                    <button onclick="logFollowup()" class="border border-[#C5A059]/30 bg-[#3E2723] text-[#C5A059] px-6 py-4 rounded-3xl font-body font-bold uppercase tracking-widest hover:bg-[#4A3229] transition-all duration-300 flex items-center justify-center gap-3 group">
                        <span class="material-symbols-outlined text-2xl">
                            edit_note
                        </span>
                        <span>Log Client Follow-up</span>
                    </button>
                </div>
            </div>

            <!-- Project Details Grid -->
            <div class="mb-16 grid md:grid-cols-3 gap-6">
                <!-- Budget -->
                <div class="bg-[#1A1614] rounded-3xl p-6 border border-[#2C1A12]">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-[#C5A059]">attach_money</span>
                        <span class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider">Budget</span>
                    </div>
                    <p class="text-[#F5F5F0] text-2xl font-bold font-headline">
                        <?php echo $project['budget'] ? '$' . number_format($project['budget'], 2) : 'N/A'; ?>
                    </p>
                </div>

                <!-- Location -->
                <div class="bg-[#1A1614] rounded-3xl p-6 border border-[#2C1A12]">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-[#C5A059]">location_on</span>
                        <span class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider">Location</span>
                    </div>
                    <p class="text-[#F5F5F0] text-lg font-headline">
                        <?php echo htmlspecialchars($project['location'] ?? 'Not specified'); ?>
                    </p>
                </div>

                <!-- Event Date -->
                <div class="bg-[#1A1614] rounded-3xl p-6 border border-[#2C1A12]">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-[#C5A059]">calendar_today</span>
                        <span class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider">Event Date</span>
                    </div>
                    <p class="text-[#F5F5F0] text-lg font-headline">
                        <?php echo date('M d, Y', strtotime($project['event_date'] ?? 'now')); ?>
                    </p>
                </div>
            </div>

            <!-- Notes Section -->
            <div class="mb-16">
                <h3 class="font-headline text-xl text-[#F5F5F0] font-bold mb-4 italic border-b border-[#C5A059]/20 pb-4">
                    Project Notes
                </h3>
                <div class="bg-[#1A1614] rounded-3xl p-6 border border-[#2C1A12]">
                    <p class="text-[#D1CDC7] leading-relaxed">
                        <?php 
                            $notesDisplay = $project['notes'] ?? 'No notes yet';
                            $notesDisplay = preg_replace('/\[PRIORITY\]\s*/', '', $notesDisplay);
                            $notesDisplay = preg_replace('/\[FOLLOWUP:\s*[\d\-\s:]*\]\s*/', '', $notesDisplay);
                            echo nl2br(htmlspecialchars(trim($notesDisplay) ?: 'No additional notes'));
                        ?>
                    </p>
                </div>
            </div>

            <div class="mb-16 text-center text-[#D1CDC7] text-sm">
                <p>Last updated: <?php echo date('M d, Y \a\t g:i A', strtotime($project['updated_at'])); ?></p>
            </div>
        </section>
    </main>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-8 right-8 bg-[#C5A059] text-[#1A1614] px-6 py-4 rounded-full font-bold hidden z-50 shadow-lg max-w-sm">
        <span id="toastMessage"></span>
    </div>

    <script>
        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }

        function togglePriority() {
            const formData = new FormData();
            formData.append('action', 'toggle_priority');

            fetch('projectdetails.php?id=<?php echo $projectId; ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message);
                    // Reload to show updated UI
                    setTimeout(() => location.reload(), 500);
                } else {
                    showToast('Error updating priority');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error updating priority');
            });
        }

        function logFollowup() {
            const formData = new FormData();
            formData.append('action', 'log_followup');

            fetch('projectdetails.php?id=<?php echo $projectId; ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message);
                    // Reload to show updated UI
                    setTimeout(() => location.reload(), 500);
                } else {
                    showToast('Error logging follow-up');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error logging follow-up');
            });
        }
    </script>
</body>
</html>
