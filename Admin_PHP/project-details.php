<?php
require_once 'config.php';
require_once 'Database.php';
require_once 'Project.php';

$project = null;
$assignedStaff = [];
$projectId = $_GET['id'] ?? null;
if ($projectId) {
    // load DB and assigned staff for this project
    $db = Database::getInstance();
    $assignedStaff = $db->fetchAll("SELECT sa.id, sa.full_name AS name, '' AS profile_image, pa.assigned_role AS role_in_project
        FROM project_assignments pa
        JOIN staff_accounts sa ON pa.staff_id = sa.id
        WHERE pa.project_id = ?", [$projectId]);

    // determine if current session user is assigned to this project
    $sessionUserId = $_SESSION['user_id'] ?? $_SESSION['staff_id'] ?? null;
    $isAssigned = false;
    $project_role = $_SESSION['role'] ?? null;
    if ($sessionUserId) {
        $row = $db->fetch("SELECT * FROM project_assignments WHERE project_id = ? AND staff_id = ? LIMIT 1", [$projectId, $sessionUserId]);
        if ($row) {
            $isAssigned = true;
            $project_role = $row['assigned_role'] ?? $project_role;
        }
    }
    // keep both variable namings used across the template
    $is_assigned = $isAssigned;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo htmlspecialchars($project['name'] ?? 'Project Details'); ?> | EDPS Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&family=Manrope:wght@400;500;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>html:not(.dark) body { background-color: #FFF8F3; color: #2D141D; } html.dark body { background-color: #12100E; color: #D1CDC7; } .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }</style>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        "primary": "#4a2d37",
                        "secondary": "#6f585f",
                        "surface": "#fff8f3",
                        "tertiary": "#283a25",
                        "error": "#ba1a1a",
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
</head>
<body class="bg-[#FFF8F3] dark:bg-[#12100E] font-body text-[#2D141D] dark:text-[#D1CDC7] antialiased flex min-h-screen">
    <aside class="hidden md:flex flex-col h-screen w-64 border-r bg-[#FFF8F3] dark:bg-[#1A1614] dark:border-[#2C1A12] py-8 px-6 sticky top-0 overflow-y-auto transition-colors duration-300">
        <div class="mb-10">
            <h1 class="text-2xl font-bold font-headline text-[#2D141D] dark:text-[#F5F5F0]">EDPS Studio</h1>
            <p class="text-xs text-[#745C63] dark:text-[#D1CDC7] mt-1">Staff Portal</p>
        </div>
        <nav class="flex-1 space-y-2">
            <a class="flex items-center gap-4 text-[#745C63] dark:text-[#D1CDC7] pl-5 py-3 hover:bg-[#F9F2ED] dark:hover:bg-[#2C1A12]" href="staff-dashboard.php">
                <span class="material-symbols-outlined">home</span>
                <span class="font-medium">Home</span>
            </a>
            <a class="flex items-center gap-4 text-[#2D141D] dark:text-[#C5A059] font-bold border-l-4 border-[#D2C3C6] dark:border-[#C5A059] pl-4 py-3 bg-[#F9F2ED] dark:bg-[#2C1A12]" href="staff-projects.php">
                <span class="material-symbols-outlined">check_box</span>
                <span class="font-medium">My Projects</span>
            </a>
        </nav>
        <div class="mt-auto pt-6 border-t border-[#D2C3C6] dark:border-[#2C1A12]">
            <a class="flex items-center gap-4 text-secondary dark:text-[#D1CDC7] pl-5 py-3 hover:bg-[#e8e1dc] dark:hover:bg-[#2C1A12]" href="staff-settings.php">
                <span class="material-symbols-outlined">settings</span>
                <span class="font-medium">Settings</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0">
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

        <section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full">
                <div class="mb-6 flex items-center justify-between">
                <a href="#" onclick="if (document.referrer) { history.back(); } else { window.location.href='staff-dashboard.php'; } return false;" class="text-[#C5A059] flex items-center gap-2" aria-label="Go back">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Back
                </a>
                <div class="hidden sm:flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full bg-[#C5A059] text-[#12100E] text-sm font-bold"><?php echo ucfirst($project['status'] ?? 'On Process'); ?></span>
                </div>
            </div>

            <h1 class="text-4xl font-headline font-bold text-[#2D141D] dark:text-[#F5F5F0] mb-4"><?php echo htmlspecialchars($project['name'] ?? 'The Montgomery Wedding'); ?></h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white dark:bg-[#1A1614] rounded-3xl border border-[#D2C3C6] dark:border-[#2C1A12] p-8">
                        <h2 class="text-lg font-bold mb-4">Creative Brief</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-[10px] tracking-widest uppercase text-[#C5A059]">Project Type</p>
                                <p class="text-[#2D141D] dark:text-[#F5F5F0]"><?php echo htmlspecialchars($project['project_type'] ?? $project['type'] ?? 'Wedding Editorial'); ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] tracking-widest uppercase text-[#C5A059]">Session Date</p>
                                <p class="text-[#2D141D] dark:text-[#F5F5F0]"><?php echo !empty($project['event_date']) ? date('M d, Y', strtotime($project['event_date'])) : 'Dec 15, 2024'; ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] tracking-widest uppercase text-[#C5A059]">Session Time</p>
                                <p class="text-[#2D141D] dark:text-[#F5F5F0]"><?php echo htmlspecialchars($project['event_time'] ?? '10:00 AM - 2:00 PM'); ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] tracking-widest uppercase text-[#C5A059]">Package</p>
                                <p class="text-[#2D141D] dark:text-[#F5F5F0]"><?php echo htmlspecialchars($project['package'] ?? 'Full Day'); ?></p>
                            </div>
                        </div>
                        <h3 class="text-sm uppercase tracking-widest text-[#C5A059] mb-2">Description & Notes</h3>
                        <p class="text-[#745C63] dark:text-[#D1CDC7]">A classic wedding coverage with editorial styling, focusing on portrait storytelling and cinematic lighting.</p>
                    </div>

                    <div class="bg-white dark:bg-[#1A1614] rounded-3xl border border-[#D2C3C6] dark:border-[#2C1A12] p-8">
                        <h2 class="text-lg font-bold mb-4">Client & Venue</h2>
                        <p class="text-[10px] tracking-widest uppercase text-[#C5A059]">Client</p>
                        <p class="text-[#2D141D] dark:text-[#F5F5F0]"><?php echo htmlspecialchars($project['client_name'] ?? 'Not specified'); ?></p>
                        <p class="text-[10px] tracking-widest uppercase text-[#C5A059] mt-4">Venue</p>
                        <p class="text-[#2D141D] dark:text-[#F5F5F0]"><?php echo htmlspecialchars($project['location'] ?? 'Not specified'); ?></p>
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <aside class="bg-white dark:bg-[#1A1614] rounded-3xl border border-[#D2C3C6] dark:border-[#2C1A12] p-8">
                    <h3 class="text-lg font-bold mb-4">Assigned Team</h3>
                    <ul class="space-y-4">
                        <?php if (!empty($assignedStaff)): ?>
                            <?php foreach ($assignedStaff as $staff): ?>
                                <li class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full overflow-hidden bg-primary flex items-center justify-center flex-shrink-0">
                                        <img class="w-full h-full object-cover" src="<?php echo htmlspecialchars($staff['profile_image'] ?? 'assets/images/default-profile.png'); ?>" alt="<?php echo htmlspecialchars($staff['name'] ?? 'Staff'); ?>" />
                                    </div>
                                    <div>
                                        <div class="font-medium text-[#2D141D] dark:text-[#F5F5F0]"><?php echo htmlspecialchars($staff['name']); ?></div>
                                        <div class="text-sm text-[#745C63] dark:text-[#D1CDC7]"><?php echo htmlspecialchars($staff['role_in_project'] ?? $staff['role'] ?? 'Staff'); ?></div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="text-[#D1CDC7]">No staff members assigned to this project yet.</li>
                        <?php endif; ?>
                    </ul>

                    <?php if ($isAssigned): ?>
                                    <div class="mt-6">
                                <h4 class="font-bold mb-2">My Actions</h4>
                                <div class="flex gap-2">
                                    <button id="btnMarkProcess" class="px-4 py-2 md:px-3 md:py-1 md:text-[9px] bg-[#C5A059] rounded-lg font-bold text-xs leading-tight whitespace-nowrap">On Process</button>
                                    <button id="btnMarkDone" class="px-4 py-2 md:px-3 md:py-1 md:text-[9px] bg-[#3E2723] text-[#C5A059] rounded-lg font-bold text-xs leading-tight whitespace-nowrap">Done</button>
                                    <button id="btnOpenReport" class="px-4 py-2 md:px-3 md:py-1 md:text-[9px] border border-[#C5A059] rounded-lg font-bold text-xs leading-tight whitespace-nowrap">Report</button>
                                </div>
                            </div>
                    <?php endif; ?>
                    </aside>

                    <div class="mt-8">
                        <p class="text-[10px] uppercase tracking-widest text-[#C5A059] font-bold mb-3">Update Project Status</p>
                        <div class="flex flex-row flex-wrap items-center justify-start gap-2 w-full">
                            <?php $current_staff_role = $_SESSION['role'] ?? 'Staff'; ?>
                            <?php switch ($current_staff_role):
                                case 'Artist':
                                    ?>
                                    <button id="btnForApprovalWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#C5A059] text-[#12100E] border border-[#C5A059] hover:shadow-[0_0_16px_rgba(197,160,89,0.5)]">For Approval</button>
                                    <button id="btnForEditWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#C5A059] text-[#12100E] border border-[#C5A059] hover:shadow-[0_0_16px_rgba(197,160,89,0.5)]">For Edit</button>
                                    <button id="btnMarkProcessWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#C5A059] text-[#12100E] border border-[#C5A059] hover:shadow-[0_0_16px_rgba(197,160,89,0.5)]">On Process</button>
                                    <button id="btnForPrintingWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#C5A059] text-[#12100E] border border-[#C5A059] hover:shadow-[0_0_16px_rgba(197,160,89,0.5)]">For Printing</button>
                                    <button id="btnMarkDoneWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#C5A059] text-[#12100E] border border-[#C5A059] hover:shadow-[0_0_16px_rgba(197,160,89,0.5)]">Done</button>
                                    <?php
                                    break;

                                case 'Editor':
                                    ?>
                                    <button id="btnOpenReportWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#ba1a1a] text-[#ffffff] border border-[#ba1a1a] hover:bg-[#93000a] dark:bg-[#ba1a1a]/80 dark:hover:bg-[#ba1a1a]">On Hold</button>
                                    <button id="btnMarkProcessWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#C5A059] text-[#12100E] border border-[#C5A059] hover:shadow-[0_0_16px_rgba(197,160,89,0.5)]">On Process</button>
                                    <button id="btnMarkDoneWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#C5A059] text-[#12100E] border border-[#C5A059] hover:shadow-[0_0_16px_rgba(197,160,89,0.5)]">Done</button>
                                    <?php
                                    break;

                                case 'Bindery':
                                    ?>
                                    <button id="btnMarkProcessWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#C5A059] text-[#12100E] border border-[#C5A059] hover:shadow-[0_0_16px_rgba(197,160,89,0.5)]">On Process</button>
                                    <button id="btnLackInfoWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#ba1a1a] text-[#ffffff] border border-[#ba1a1a] hover:bg-[#93000a] dark:bg-[#ba1a1a]/80 dark:hover:bg-[#ba1a1a]">Lack of info / material</button>
                                    <button id="btnMarkDoneWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#C5A059] text-[#12100E] border border-[#C5A059] hover:shadow-[0_0_16px_rgba(197,160,89,0.5)]">Done</button>
                                    <?php
                                    break;

                                case 'Acrylic':
                                    ?>
                                    <button id="btnOpenReportWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#ba1a1a] text-[#ffffff] border border-[#ba1a1a] hover:bg-[#93000a] dark:bg-[#ba1a1a]/80 dark:hover:bg-[#ba1a1a]">On Hold</button>
                                    <button id="btnMarkProcessWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#C5A059] text-[#12100E] border border-[#C5A059] hover:shadow-[0_0_16px_rgba(197,160,89,0.5)]">On Process</button>
                                    <button id="btnMarkDoneWide" class="flex-grow min-w-[100px] py-3 px-2 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-widest text-center whitespace-nowrap overflow-hidden transition-all duration-200 active:scale-90 hover:-translate-y-0.5 cursor-pointer shadow-[0_0_12px_rgba(0,0,0,0.15)] bg-[#C5A059] text-[#12100E] border border-[#C5A059] hover:shadow-[0_0_16px_rgba(197,160,89,0.5)]">Done</button>
                                    <?php
                                    break;

                                default:
                                    // no buttons
                                    break;
                            endswitch; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Modal -->
            <div id="reportModal" class="hidden fixed inset-0 bg-black/60 z-50 items-center justify-center">
                <div class="bg-white dark:bg-[#1A1614] rounded-2xl p-6 w-full max-w-md mx-auto">
                    <h3 class="font-headline text-lg font-bold text-[#2D141D] dark:text-[#F5F5F0] mb-3">Report Issue to Admin</h3>
                    <textarea id="reportReason" class="w-full h-36 p-3 rounded-lg bg-[#F4EDE8] dark:bg-[#2C1A12] border border-[#D2C3C6] dark:border-[#3E2723] text-[#2D141D] dark:text-[#F5F5F0] text-sm" placeholder="Describe the issue..."></textarea>
                    <div class="mt-4 flex justify-end gap-2">
                        <button id="reportCancel" class="px-3 py-2 rounded-lg border border-[#D2C3C6] text-[#745C63]">Cancel</button>
                        <button id="reportSubmit" class="px-3 py-2 rounded-lg bg-[#C5A059] text-[#12100E]">Submit to Admin</button>
                    </div>
                </div>
            </div>

            <!-- Lack Info / Material Modal (Bindery) -->
            <div id="lackModal" class="hidden fixed inset-0 bg-black/60 z-50 items-center justify-center">
                <div class="bg-white dark:bg-[#1A1614] rounded-2xl p-6 w-full max-w-md mx-auto">
                    <h3 class="font-headline text-lg font-bold text-[#2D141D] dark:text-[#F5F5F0] mb-3">Report Missing Info / Materials</h3>
                    <p class="text-sm text-[#745C63] dark:text-[#D1CDC7] mb-3">List the materials or information that are missing for this project. One per line.</p>
                    <textarea id="lackItems" class="w-full h-40 p-3 rounded-lg bg-[#F4EDE8] dark:bg-[#2C1A12] border border-[#D2C3C6] dark:border-[#3E2723] text-[#2D141D] dark:text-[#F5F5F0] text-sm" placeholder="e.g. 1) Client contact number\n2) Extra fabric swatches\n3) Venue dimensions"></textarea>
                    <div class="mt-4 flex justify-end gap-2">
                        <button id="lackCancel" class="px-3 py-2 rounded-lg border border-[#D2C3C6] text-[#745C63]">Cancel</button>
                        <button id="lackSubmit" class="px-3 py-2 rounded-lg bg-[#ba1a1a] text-white">Submit</button>
                    </div>
                </div>
            </div>

        </section>
    </main>
    <script>
        function showToast(msg) { alert(msg); }

        // Sync theme with staff portal preference
        (function(){
            try {
                const html = document.documentElement;
                const savedTheme = localStorage.getItem('staffPortalTheme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (savedTheme === 'dark' || (savedTheme === null && prefersDark)) html.classList.add('dark');
                else html.classList.remove('dark');
            } catch(e) { /* ignore */ }
        })();

        // Actions: mark process / mark done
        document.getElementById('btnMarkProcess')?.addEventListener('click', function(){
            const fd = new FormData(); fd.append('action','mark_process');
            fetch('project-details.php?id=<?php echo $projectId; ?>',{method:'POST', body: fd}).then(r=>r.json()).then(d=>{ showToast(d.message); if(d.success) setTimeout(()=>location.reload(),400); }).catch(()=>showToast('Error'));
        });

        document.getElementById('btnMarkDone')?.addEventListener('click', function(){
            const fd = new FormData(); fd.append('action','mark_done');
            fetch('project-details.php?id=<?php echo $projectId; ?>',{method:'POST', body: fd}).then(r=>r.json()).then(d=>{ showToast(d.message); if(d.success) setTimeout(()=>location.reload(),400); }).catch(()=>showToast('Error'));
        });

        // Report modal handlers
        const modal = document.getElementById('reportModal');
        document.getElementById('btnOpenReport')?.addEventListener('click', ()=>{ if(modal) { modal.classList.remove('hidden'); modal.classList.add('flex'); } });

        // Wide buttons: hook the large buttons to the same actions
        document.getElementById('btnMarkProcessWide')?.addEventListener('click', function(){
            const fd = new FormData(); fd.append('action','mark_process');
            fetch('project-details.php?id=<?php echo $projectId; ?>',{method:'POST', body: fd}).then(r=>r.json()).then(d=>{ showToast(d.message); if(d.success) setTimeout(()=>location.reload(),400); }).catch(()=>showToast('Error'));
        });

        document.getElementById('btnMarkDoneWide')?.addEventListener('click', function(){
            const fd = new FormData(); fd.append('action','mark_done');
            fetch('project-details.php?id=<?php echo $projectId; ?>',{method:'POST', body: fd}).then(r=>r.json()).then(d=>{ showToast(d.message); if(d.success) setTimeout(()=>location.reload(),400); }).catch(()=>showToast('Error'));
        });

        document.getElementById('btnOpenReportWide')?.addEventListener('click', ()=>{ if(modal) { modal.classList.remove('hidden'); modal.classList.add('flex'); } });
        document.getElementById('reportCancel')?.addEventListener('click', ()=>{ if(modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); } });
        document.getElementById('reportSubmit')?.addEventListener('click', ()=>{
            const reason = document.getElementById('reportReason')?.value?.trim() || '';
            if(!reason) { showToast('Please enter a reason'); return; }
            const fd = new FormData(); fd.append('action','report'); fd.append('reason', reason);
            fetch('project-details.php?id=<?php echo $projectId; ?>',{method:'POST', body: fd}).then(r=>r.json()).then(d=>{ showToast(d.message); if(d.success){ if(modal){ modal.classList.add('hidden'); modal.classList.remove('flex'); } setTimeout(()=>location.reload(),400); } }).catch(()=>showToast('Error'));
        });

        // Lack info/modal handlers (Bindery)
        const lackModal = document.getElementById('lackModal');
        document.getElementById('btnLackInfoWide')?.addEventListener('click', ()=>{ if(lackModal){ lackModal.classList.remove('hidden'); lackModal.classList.add('flex'); } });
        document.getElementById('lackCancel')?.addEventListener('click', ()=>{ if(lackModal){ lackModal.classList.add('hidden'); lackModal.classList.remove('flex'); } });
        document.getElementById('lackSubmit')?.addEventListener('click', ()=>{
            const items = document.getElementById('lackItems')?.value?.trim() || '';
            if(!items) { showToast('Please list at least one missing item or info'); return; }
            const fd = new FormData(); fd.append('action','lack_info'); fd.append('items', items);
            fetch('project-details.php?id=<?php echo $projectId; ?>',{method:'POST', body: fd}).then(r=>r.json()).then(d=>{ showToast(d.message); if(d.success){ if(lackModal){ lackModal.classList.add('hidden'); lackModal.classList.remove('flex'); } setTimeout(()=>location.reload(),400); } }).catch(()=>showToast('Error'));
        });

        // Notification button behavior (header bell) + badge updater
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
        if (notifBtn) {
            notifBtn.addEventListener('click', function(e){ e.preventDefault(); window.location.href = 'notifications.php'; });
        }
    </script>
</body>
</html>
