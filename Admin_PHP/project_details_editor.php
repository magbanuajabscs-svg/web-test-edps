<?php
require_once 'config.php';
require_once 'Database.php';
require_once 'Project.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$projectId = $_GET['id'] ?? null;
if (!$projectId) {
    header('Location: staff-projects.php');
    exit;
}

$db = Database::getInstance();
$projectManager = new Project();
$project = $projectManager->getById($projectId);
if (!$project) {
    header('Location: staff-projects.php');
    exit;
}

$assignedStaff = $projectManager->getAssignedStaff($projectId);
$isAssigned = false;
foreach ($assignedStaff as $s) {
    if (isset($s['id']) && $s['id'] == $_SESSION['user_id']) { $isAssigned = true; break; }
}

// Handle actions: priority, followup, mark_process, mark_done, report
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');

    if ($_POST['action'] === 'toggle_priority') {
        $currentNotes = $project['notes'] ?? '';
        $isPriority = strpos($currentNotes, '[PRIORITY]') !== false;
        $newNotes = $isPriority ? str_replace('[PRIORITY] ', '', $currentNotes) : '[PRIORITY] ' . $currentNotes;
        $result = $db->update("UPDATE projects SET notes = ? WHERE id = ?", [$newNotes, $projectId]);
        echo json_encode(['success' => (bool)$result, 'isPriority' => !$isPriority, 'message' => $isPriority ? 'Priority removed' : 'Marked as high priority']);
        exit;
    }

    if ($_POST['action'] === 'log_followup') {
        $currentNotes = $project['notes'] ?? '';
        $timestamp = date('Y-m-d H:i:s');
        $followupNote = "[FOLLOWUP: $timestamp] Client requested update. ";
        $newNotes = $followupNote . $currentNotes;
        $result = $db->update("UPDATE projects SET notes = ?, status = 'in_progress' WHERE id = ?", [$newNotes, $projectId]);
        $db->insert("INSERT INTO activity_log (user_id, action, description, entity_type, entity_id) VALUES (?, ?, ?, ?, ?)", [
            $_SESSION['user_id'], 'followup', 'Client follow-up logged', 'project', $projectId
        ]);
        echo json_encode(['success' => (bool)$result, 'message' => 'Client follow-up logged successfully']);
        exit;
    }

    if ($_POST['action'] === 'mark_process') {
        $res = $projectManager->updateStatus($projectId, 'in_progress');
        $db->insert("INSERT INTO activity_log (user_id, action, description, entity_type, entity_id) VALUES (?, ?, ?, ?, ?)", [
            $_SESSION['user_id'], 'mark_process', 'Marked project as On Process', 'project', $projectId
        ]);
        echo json_encode(['success' => (bool)$res, 'message' => $res ? 'Status updated to On Process' : 'Failed to update status']);
        exit;
    }

    if ($_POST['action'] === 'mark_done') {
        $res = $projectManager->updateStatus($projectId, 'completed');
        $db->insert("INSERT INTO activity_log (user_id, action, description, entity_type, entity_id) VALUES (?, ?, ?, ?, ?)", [
            $_SESSION['user_id'], 'mark_done', 'Marked project as Done', 'project', $projectId
        ]);
        echo json_encode(['success' => (bool)$res, 'message' => $res ? 'Project marked as Done' : 'Failed to update status']);
        exit;
    }

    if ($_POST['action'] === 'report') {
        $reason = trim($_POST['reason'] ?? '');
        if (empty($reason)) { echo json_encode(['success'=>false,'message'=>'Please provide a reason for the report.']); exit; }
        try {
            $reportId = $db->insert("INSERT INTO project_reports (project_id, reporter_id, reason, status) VALUES (?, ?, ?, ?)", [$projectId, $_SESSION['user_id'], $reason, 'pending']);
            $db->insert("INSERT INTO activity_log (user_id, action, description, entity_type, entity_id) VALUES (?, ?, ?, ?, ?)", [
                $_SESSION['user_id'], 'report_submitted', 'Project reported to admin (report id: ' . $reportId . ')', 'project', $projectId
            ]);
            echo json_encode(['success' => (bool)$reportId, 'message' => $reportId ? 'Report submitted to admin' : 'Failed to submit report']);
        } catch (Exception $e) {
            echo json_encode(['success'=>false,'message'=>'Failed to submit report: '.$e->getMessage()]);
        }
        exit;
    }
}

// Refresh project after any POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project = $projectManager->getById($projectId);
}

$isPriority = strpos($project['notes'] ?? '', '[PRIORITY]') !== false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo htmlspecialchars($project['name']); ?> — Editor | EDPS Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&family=Manrope:wght@400;500;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>html:not(.dark) body { background-color: #FFF8F3; color: #2D141D; } html.dark body { background-color: #12100E; color: #D1CDC7; } .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }</style>
</head>
<body class="bg-[#FFF8F3] dark:bg-[#12100E] font-body text-[#2D141D] dark:text-[#D1CDC7] antialiased flex min-h-screen">
    <aside class="hidden md:flex flex-col h-screen w-64 border-r bg-[#FFF8F3] dark:bg-[#1A1614] dark:border-[#2C1A12] py-8 px-6 sticky top-0 overflow-y-auto transition-colors duration-300">
        <div class="mb-10">
            <h1 class="text-2xl font-bold font-headline text-[#2D141D] dark:text-[#F5F5F0]">EDPS Studio</h1>
            <p class="text-xs text-[#745C63] dark:text-[#D1CDC7] mt-1">Staff Editor</p>
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
    </aside>

    <main class="flex-1 flex flex-col min-w-0">
        <header class="sticky top-0 z-40 flex justify-between items-center w-full px-4 sm:px-8 py-4 bg-[#FFF8F3]/90 dark:bg-[#1A1614]/80 backdrop-blur-md border-b border-[#D2C3C6] dark:border-[#2C1A12] transition-colors duration-300">
            <div></div>
            <a href="staff-settings.php#account-info" class="flex items-center gap-2 sm:gap-3 hover:opacity-80 transition-opacity cursor-pointer">
                <div class="text-right">
                    <p class="text-xs sm:text-sm font-medium text-[#745C63] dark:text-[#D1CDC7]"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                </div>
            </a>
        </header>

        <section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full">
            <div class="mb-6 flex items-center justify-between">
                <button onclick="history.back()" class="text-[#C5A059] flex items-center gap-2"><span class="material-symbols-outlined">arrow_back</span>Back to List</button>
            </div>

            <h1 class="text-4xl font-headline font-bold text-[#2D141D] dark:text-[#F5F5F0] mb-4"><?php echo htmlspecialchars($project['name']); ?></h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white dark:bg-[#1A1614] rounded-3xl border border-[#D2C3C6] dark:border-[#2C1A12] p-8">
                        <h2 class="text-lg font-bold mb-4">Creative Brief</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-[10px] tracking-widest uppercase text-[#C5A059]">Project Type</p>
                                <p class="text-[#2D141D] dark:text-[#F5F5F0]"><?php echo htmlspecialchars($project['type'] ?? '—'); ?></p>
                            </div>
                            <div>
                                <p class="text-[10px] tracking-widest uppercase text-[#C5A059]">Session Date</p>
                                <p class="text-[#2D141D] dark:text-[#F5F5F0]"><?php echo !empty($project['event_date']) ? date('M d, Y', strtotime($project['event_date'])) : 'TBD'; ?></p>
                            </div>
                        </div>
                        <h3 class="text-sm uppercase tracking-widest text-[#C5A059] mb-2">Description & Notes</h3>
                        <p class="text-[#745C63] dark:text-[#D1CDC7]"><?php echo nl2br(htmlspecialchars($project['description'] ?? 'No description provided')); ?></p>
                    </div>
                </div>

                <aside class="bg-white dark:bg-[#1A1614] rounded-3xl border border-[#D2C3C6] dark:border-[#2C1A12] p-8 sticky top-28">
                    <h3 class="text-lg font-bold mb-4">Assigned Team</h3>
                    <ul class="space-y-4">
                        <?php foreach ($assignedStaff as $staff): ?>
                        <li class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full overflow-hidden bg-primary flex items-center justify-center text-[#2D141D] dark:text-[#F5F5F0] font-bold"><?php echo strtoupper(substr($staff['name'] ?? 'S',0,1)); ?></div>
                            <div>
                                <div class="font-medium text-[#2D141D] dark:text-[#F5F5F0]"><?php echo htmlspecialchars($staff['name']); ?></div>
                                <div class="text-sm text-[#745C63] dark:text-[#D1CDC7]"><?php echo htmlspecialchars($staff['role_in_project'] ?? $staff['role'] ?? 'Staff'); ?></div>
                            </div>
                        </li>
                        <?php endforeach; ?>

                        <?php if (empty($assignedStaff)): ?>
                        <li class="text-[#D1CDC7]">No staff assigned yet.</li>
                        <?php endif; ?>
                    </ul>

                    <?php if ($isAssigned): ?>
                    <div class="mt-6">
                        <h4 class="font-bold mb-2">My Actions</h4>
                        <div class="flex gap-2">
                            <button id="btnMarkProcess" class="px-4 py-2 bg-[#C5A059] rounded-lg font-bold">On Process</button>
                            <button id="btnMarkDone" class="px-4 py-2 bg-[#3E2723] text-[#C5A059] rounded-lg font-bold">Done</button>
                            <button id="btnOpenReport" class="px-4 py-2 border border-[#C5A059] rounded-lg font-bold">Report</button>
                        </div>
                    </div>
                    <?php endif; ?>
                </aside>
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

        </section>
    </main>

    <script>
        function showToast(msg) { alert(msg); }

        document.getElementById('btnMarkProcess')?.addEventListener('click', function(){
            const fd = new FormData(); fd.append('action','mark_process');
            fetch('project_details_editor.php?id=<?php echo $projectId; ?>',{method:'POST', body: fd}).then(r=>r.json()).then(d=>{ showToast(d.message); if(d.success) setTimeout(()=>location.reload(),400); }).catch(()=>showToast('Error'));
        });

        document.getElementById('btnMarkDone')?.addEventListener('click', function(){
            const fd = new FormData(); fd.append('action','mark_done');
            fetch('project_details_editor.php?id=<?php echo $projectId; ?>',{method:'POST', body: fd}).then(r=>r.json()).then(d=>{ showToast(d.message); if(d.success) setTimeout(()=>location.reload(),400); }).catch(()=>showToast('Error'));
        });

        const modal = document.getElementById('reportModal');
        document.getElementById('btnOpenReport')?.addEventListener('click', ()=>{ if(modal) { modal.classList.remove('hidden'); modal.classList.add('flex'); } });
        document.getElementById('reportCancel')?.addEventListener('click', ()=>{ if(modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); } });
        document.getElementById('reportSubmit')?.addEventListener('click', ()=>{
            const reason = document.getElementById('reportReason')?.value?.trim() || '';
            if(!reason) { showToast('Please enter a reason'); return; }
            const fd = new FormData(); fd.append('action','report'); fd.append('reason', reason);
            fetch('project_details_editor.php?id=<?php echo $projectId; ?>',{method:'POST', body: fd}).then(r=>r.json()).then(d=>{ showToast(d.message); if(d.success){ if(modal){ modal.classList.add('hidden'); modal.classList.remove('flex'); } setTimeout(()=>location.reload(),400); } }).catch(()=>showToast('Error'));
        });
    </script>
</body>
</html>
