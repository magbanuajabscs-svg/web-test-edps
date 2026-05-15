<?php
require_once 'config.php';
require_once 'Database.php';

// Check if admin is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Get assignment ID from URL
$assignmentId = $_GET['assignment_id'] ?? null;

if (!$assignmentId) {
    header('Location: stafflist.php');
    exit;
}

$db = Database::getInstance();

// Fetch assignment with staff and project details
$sql = "SELECT 
            pa.id,
            pa.project_id,
            pa.staff_id,
            pa.role_in_project,
            pa.assigned_date,
            pa.status,
            pa.progress_notes,
            pa.internal_status,
            pa.task_status,
            pa.admin_feedback,
            s.name as staff_name,
            s.email as staff_email,
            s.role as staff_role,
            p.name as project_name,
            p.description as project_description,
            p.status as project_status
        FROM project_assignments pa
        JOIN staff s ON pa.staff_id = s.id
        JOIN projects p ON pa.project_id = p.id
        WHERE pa.id = ?";

$assignment = $db->fetch($sql, [$assignmentId]);

if (!$assignment) {
    header('Location: stafflist.php');
    exit;
}

// Handle admin actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    if ($_POST['action'] === 'approve_task') {
        $updateSql = "UPDATE project_assignments SET internal_status = 'completed', task_status = 'completed' WHERE id = ?";
        $result = $db->update($updateSql, [$assignmentId]);
        
        // Log activity
        $logSql = "INSERT INTO activity_log (user_id, action, description, entity_type, entity_id) VALUES (?, ?, ?, ?, ?)";
        $db->insert($logSql, [
            $_SESSION['user_id'],
            'task_approved',
            'Task approved for staff assignment',
            'assignment',
            $assignmentId
        ]);
        
        echo json_encode([
            'success' => $result,
            'message' => 'Task approved successfully'
        ]);
        exit;
    }
    
    if ($_POST['action'] === 'lack_of_info') {
        $feedback = $_POST['feedback'] ?? '';
        $updateSql = "UPDATE project_assignments SET task_status = 'lack_of_info', admin_feedback = ? WHERE id = ?";
        $result = $db->update($updateSql, [$feedback, $assignmentId]);
        
        // Log activity
        $logSql = "INSERT INTO activity_log (user_id, action, description, entity_type, entity_id) VALUES (?, ?, ?, ?, ?)";
        $db->insert($logSql, [
            $_SESSION['user_id'],
            'lack_of_info',
            'Marked as lack of information: ' . $feedback,
            'assignment',
            $assignmentId
        ]);
        
        echo json_encode([
            'success' => $result,
            'message' => 'Feedback sent to staff member'
        ]);
        exit;
    }
}

// Re-fetch assignment to get updated data if POST was successful
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assignment = $db->fetch($sql, [$assignmentId]);
}

$taskStatus = $assignment['task_status'] ?? 'for_approval';
$internalStatus = $assignment['internal_status'] ?? 'assigned';
$showAdminActions = in_array($taskStatus, ['for_approval', 'on_process']);
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo htmlspecialchars($assignment['staff_name']); ?> - Task Monitoring - EDPS Studio</title>
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
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .glass-nav { background: rgba(255, 248, 243, 0.8); backdrop-filter: blur(12px); }
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
            <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 group" href="stafflist.php">
                <span class="material-symbols-outlined text-[#C5A059]" data-icon="photo_library">photo_library</span>
                <span class="font-body font-medium">Projects</span>
            </a>
            <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 group border-l-4 border-[#C5A059] bg-[#2C1A12]" href="staffmanage.php">
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
                <h2 class="text-lg font-bold text-[#F5F5F0]">Task Monitoring</h2>
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
                <a class="inline-flex items-center text-[#D1CDC7] hover:text-[#C5A059] transition-colors font-body text-sm font-bold group" href="staffmanage.php">
                    <span class="material-symbols-outlined text-[18px] mr-2 transition-transform group-hover:-translate-x-1" data-icon="arrow_back">arrow_back</span>
                    Back to Staff Management
                </a>
            </div>

            <!-- Dual Heading: Staff Name & Project Name -->
            <div class="mb-16">
                <div class="flex flex-col md:flex-row md:items-baseline md:gap-4 mb-4">
                    <h1 class="font-headline text-5xl font-bold text-[#F5F5F0] tracking-tight leading-none">
                        <?php echo htmlspecialchars($assignment['staff_name']); ?>
                    </h1>
                    <p class="text-[#C5A059] text-xl font-headline italic mt-2 md:mt-0">
                        on <?php echo htmlspecialchars($assignment['project_name']); ?>
                    </p>
                </div>
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="px-4 py-2 bg-[#3E2723] text-[#C5A059] text-xs font-bold uppercase tracking-widest rounded-full">
                        <?php echo htmlspecialchars($assignment['role_in_project'] ?? ucfirst($assignment['staff_role'])); ?>
                    </span>
                    <span class="px-4 py-2 bg-[#3E2723] text-[#F5F5F0] text-xs font-bold uppercase tracking-widest rounded-full">
                        Project: <?php echo ucfirst($assignment['project_status']); ?>
                    </span>
                </div>
            </div>

            <!-- Staff Progress Notes Section -->
            <div class="mb-16 bg-[#1A1614] rounded-3xl p-8 border border-[#2C1A12]">
                <h3 class="font-headline text-xl text-[#F5F5F0] font-bold mb-6 italic border-b border-[#C5A059]/20 pb-4">
                    Staff Progress Notes
                </h3>
                <div class="space-y-6">
                    <!-- Status Indicator -->
                    <div class="flex items-center gap-4 p-4 bg-[#2C1A12] rounded-2xl border border-[#C5A059]/20">
                        <span class="material-symbols-outlined text-2xl text-[#C5A059]">info</span>
                        <div>
                            <p class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider mb-1">Task Status</p>
                            <p class="text-[#F5F5F0] text-lg font-bold">
                                <?php 
                                    $statusColors = [
                                        'on_hold' => '#C5A059',
                                        'on_process' => '#C5A059',
                                        'for_approval' => '#C5A059',
                                        'lack_of_info' => '#ba1a1a',
                                        'completed' => '#283a25'
                                    ];
                                    $statusDisplay = ucfirst(str_replace('_', ' ', $taskStatus));
                                    $statusColor = $statusColors[$taskStatus] ?? '#C5A059';
                                ?>
                                <span style="color: <?php echo $statusColor; ?>">●</span> <?php echo $statusDisplay; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Progress Notes -->
                    <div>
                        <p class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider mb-3">Progress Notes</p>
                        <div class="bg-[#2C1A12] rounded-2xl p-6 border border-[#C5A059]/10">
                            <p class="text-[#D1CDC7] leading-relaxed">
                                <?php echo $assignment['progress_notes'] ? nl2br(htmlspecialchars($assignment['progress_notes'])) : '<em>No progress notes yet.</em>'; ?>
                            </p>
                        </div>
                    </div>

                    <!-- Delay Reason (if applicable) -->
                    <?php if (in_array($taskStatus, ['on_hold', 'on_process', 'lack_of_info'])): ?>
                    <div>
                        <p class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider mb-3">Status Details</p>
                        <div class="bg-[#2C1A12] rounded-2xl p-6 border-l-4" style="border-color: <?php echo $statusColor; ?>">
                            <p class="text-[#C5A059] font-bold mb-2">
                                <?php if ($taskStatus === 'lack_of_info'): ?>
                                    ⚠️ Awaiting Information
                                <?php elseif ($taskStatus === 'on_hold'): ?>
                                    ⏸ On Hold
                                <?php else: ?>
                                    ⏳ In Progress
                                <?php endif; ?>
                            </p>
                            <p class="text-[#D1CDC7]">
                                <?php echo $assignment['admin_feedback'] ? nl2br(htmlspecialchars($assignment['admin_feedback'])) : 'No specific details provided.'; ?>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Admin Action Center (Conditional) -->
            <?php if ($showAdminActions): ?>
            <div class="mb-16 bg-[#1A1614] rounded-3xl p-8 border-2 border-[#C5A059]/40">
                <h3 class="font-headline text-xl text-[#F5F5F0] font-bold mb-6 italic border-b border-[#C5A059]/20 pb-4">
                    Admin Action Center
                </h3>
                
                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <!-- Approve Task Button -->
                    <button onclick="approveTask()" class="flex items-center justify-center gap-3 px-6 py-4 bg-[#C5A059] text-[#1A1614] rounded-3xl font-body font-bold uppercase tracking-widest hover:bg-[#D4B876] transition-all duration-300 group">
                        <span class="material-symbols-outlined text-2xl">check_circle</span>
                        <span>Approve Task</span>
                    </button>

                    <!-- Lack of Info Button -->
                    <button onclick="toggleFeedbackForm()" class="flex items-center justify-center gap-3 px-6 py-4 bg-[#3E2723] text-[#C5A059] border border-[#C5A059]/30 rounded-3xl font-body font-bold uppercase tracking-widest hover:bg-[#4A3229] hover:border-[#C5A059]/60 transition-all duration-300 group">
                        <span class="material-symbols-outlined text-2xl">info</span>
                        <span>Request More Info</span>
                    </button>
                </div>

                <!-- Feedback Form (Hidden by default) -->
                <div id="feedbackForm" class="hidden mb-6 p-6 bg-[#2C1A12] rounded-2xl border border-[#C5A059]/20">
                    <label class="block mb-4">
                        <p class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider mb-3">Admin Feedback</p>
                        <textarea 
                            id="feedbackText"
                            placeholder="Enter instructions or information requests for the staff member..."
                            class="w-full bg-[#1A1614] border border-[#C5A059]/30 rounded-2xl p-4 text-[#D1CDC7] placeholder:text-[#D1CDC7]/50 focus:ring-1 focus:ring-[#C5A059]/50 focus:border-[#C5A059]/50"
                            rows="5"
                        ></textarea>
                    </label>
                    <div class="flex gap-3 justify-end">
                        <button onclick="toggleFeedbackForm()" class="px-6 py-3 bg-[#2C1A12] text-[#D1CDC7] border border-[#C5A059]/30 rounded-2xl font-body font-bold uppercase tracking-widest hover:bg-[#3a2b20] transition-all">
                            Cancel
                        </button>
                        <button onclick="submitLackOfInfo()" class="px-6 py-3 bg-[#C5A059] text-[#1A1614] rounded-2xl font-body font-bold uppercase tracking-widest hover:bg-[#D4B876] transition-all">
                            Send Feedback
                        </button>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Task Assignment Info -->
            <div class="mb-16 grid md:grid-cols-3 gap-6">
                <!-- Role -->
                <div class="bg-[#1A1614] rounded-3xl p-6 border border-[#2C1A12]">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-[#C5A059]">badge</span>
                        <span class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider">Role in Project</span>
                    </div>
                    <p class="text-[#F5F5F0] text-lg font-headline">
                        <?php echo htmlspecialchars($assignment['role_in_project'] ?? ucfirst($assignment['staff_role'])); ?>
                    </p>
                </div>

                <!-- Staff Email -->
                <div class="bg-[#1A1614] rounded-3xl p-6 border border-[#2C1A12]">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-[#C5A059]">mail</span>
                        <span class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider">Email</span>
                    </div>
                    <p class="text-[#F5F5F0] text-lg break-all">
                        <?php echo htmlspecialchars($assignment['staff_email']); ?>
                    </p>
                </div>

                <!-- Assigned Date -->
                <div class="bg-[#1A1614] rounded-3xl p-6 border border-[#2C1A12]">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-[#C5A059]">calendar_today</span>
                        <span class="text-[#D1CDC7] text-xs font-bold uppercase tracking-wider">Assigned Date</span>
                    </div>
                    <p class="text-[#F5F5F0] text-lg font-headline">
                        <?php echo date('M d, Y', strtotime($assignment['assigned_date'])); ?>
                    </p>
                </div>
            </div>

            <div class="text-center text-[#D1CDC7] text-sm mb-8">
                <p>Assignment ID: <?php echo htmlspecialchars($assignmentId); ?></p>
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

        function toggleFeedbackForm() {
            const form = document.getElementById('feedbackForm');
            form.classList.toggle('hidden');
        }

        function approveTask() {
            const formData = new FormData();
            formData.append('action', 'approve_task');

            fetch('taskmonitoring.php?assignment_id=<?php echo $assignmentId; ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message);
                    setTimeout(() => location.reload(), 500);
                } else {
                    showToast('Error approving task');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error approving task');
            });
        }

        function submitLackOfInfo() {
            const feedback = document.getElementById('feedbackText').value;
            if (!feedback.trim()) {
                showToast('Please enter feedback');
                return;
            }

            const formData = new FormData();
            formData.append('action', 'lack_of_info');
            formData.append('feedback', feedback);

            fetch('taskmonitoring.php?assignment_id=<?php echo $assignmentId; ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message);
                    setTimeout(() => location.reload(), 500);
                } else {
                    showToast('Error sending feedback');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Error sending feedback');
            });
        }
    </script>
</body>
</html>
