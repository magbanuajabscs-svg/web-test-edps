<?php
require_once 'config.php';
require_once 'Database.php';
require_once 'Project.php';

// Require user to be logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$projectId = $_GET['id'] ?? null;
if (!$projectId) {
    // redirect back to projects list
    header('Location: staff-projects.php');
    exit;
}

$projectManager = new Project();
$project = $projectManager->getById($projectId);
if (!$project) {
    // not found
    http_response_code(404);
    echo "<p style=\"padding:24px;\">Project not found.</p>";
    exit;
}
// Ensure current staff is assigned to this project
$staffId = $_SESSION['user_id'];
$assigned = false;
if (!empty($project['assigned_staff']) && is_array($project['assigned_staff'])) {
    foreach ($project['assigned_staff'] as $s) {
        if ((isset($s['id']) && intval($s['id']) === intval($staffId)) || (isset($s['staff_id']) && intval($s['staff_id']) === intval($staffId))) {
            $assigned = true; break;
        }
    }
}
if (!$assigned) {
    // not assigned - redirect back
    header('Location: staff-projects.php');
    exit;
}

// Simple profile fallback for header
$staffUsername = $_SESSION['username'] ?? '';
$initial = $staffUsername ? strtoupper(substr($staffUsername,0,1)) : 'S';
$svg = '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"><rect width="40" height="40" fill="#3E2723"/><text x="50%" y="50%" font-size="20" fill="#C5A059" text-anchor="middle" dominant-baseline="middle">'.htmlspecialchars($initial).'</text></svg>';
$defaultAvatar = 'data:image/svg+xml;utf8,'.rawurlencode($svg);
$profileImage = $_SESSION['profile_image'] ?? $defaultAvatar;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title><?php echo htmlspecialchars($project['name']); ?> — EDPS Studio</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@700&family=Manrope:wght@400;700&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-surface dark:bg-[#12100E] text-[#D1CDC7] font-body antialiased min-h-screen">
    <header class="sticky top-0 z-40 bg-[#1A1614]/80 backdrop-blur-md border-b border-[#2C1A12] p-4 flex justify-between items-center">
        <a href="staff-projects.php" class="text-sm px-3 py-2 rounded-md bg-transparent hover:bg-[#2C1A12]">← Back to Projects</a>
        <div class="flex items-center gap-3">
            <div class="text-right">
                <div class="text-xs text-[#D1CDC7]"><?php echo htmlspecialchars($staffUsername); ?></div>
            </div>
            <div class="w-9 h-9 rounded-full overflow-hidden bg-primary flex items-center justify-center">
                <img src="<?php echo $profileImage; ?>" class="w-full h-full object-cover" alt="profile"/>
            </div>
        </div>
    </header>

    <main class="max-w-5xl mx-auto p-6">
        <div class="bg-white dark:bg-[#1A1614] rounded-2xl p-6 border border-gray-100 dark:border-[#2C1A12]">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="font-headline text-2xl font-bold text-primary dark:text-[#F5F5F0]"><?php echo htmlspecialchars($project['name']); ?></h1>
                    <p class="text-sm text-secondary dark:text-[#D1CDC7] mt-2"><?php echo htmlspecialchars($project['client_name'] ?? ''); ?> — <?php echo htmlspecialchars($project['location'] ?? ''); ?></p>
                </div>
                    <div class="text-right">
                        <div class="text-xs text-secondary dark:text-[#D1CDC7]">Status</div>
                        <div class="mt-2 px-3 py-1 rounded-full bg-[#C5A059] text-[#12100E] text-sm font-bold"><?php echo htmlspecialchars($project['status']); ?></div>
                        <div class="mt-3 flex items-center gap-2 justify-end">
                            <button id="btnOnProcess" class="px-3 py-1 rounded-lg bg-[#C5A059] text-[#12100E] text-sm font-bold">On Process</button>
                            <button id="btnDone" class="px-3 py-1 rounded-lg bg-green-600 text-white text-sm font-bold">Done</button>
                            <button id="btnReport" class="px-3 py-1 rounded-lg bg-gray-200 dark:bg-[#2C1A12] text-[#2D141D] dark:text-[#D1CDC7] text-sm font-bold">Report</button>
                        </div>
                    </div>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <h3 class="text-sm font-bold text-secondary dark:text-[#D1CDC7]">Description</h3>
                    <p class="mt-2 text-sm text-[#D1CDC7]"><?php echo nl2br(htmlspecialchars($project['description'] ?? 'No description available.')); ?></p>

                    <h3 class="text-sm font-bold text-secondary dark:text-[#D1CDC7] mt-4">Notes</h3>
                    <p class="mt-2 text-sm text-[#D1CDC7]"><?php echo nl2br(htmlspecialchars($project['notes'] ?? '—')); ?></p>
                </div>

                <aside class="bg-[#fff8f3] dark:bg-[#161312] p-4 rounded-lg border border-gray-100 dark:border-[#2C1A12]">
                    <p class="text-sm text-secondary dark:text-[#D1CDC7]"><strong>Event Date:</strong><br/><?php echo $project['event_date'] ? date('M d, Y', strtotime($project['event_date'])) : 'TBD'; ?></p>
                    <p class="text-sm text-secondary dark:text-[#D1CDC7] mt-3"><strong>Client:</strong><br/><?php echo htmlspecialchars($project['client_name'] ?? '—'); ?></p>
                    <div class="mt-4">
                        <h4 class="text-sm font-bold text-secondary dark:text-[#D1CDC7]">Assigned Staff</h4>
                        <ul class="mt-2 text-sm text-[#D1CDC7] space-y-2">
                        <?php foreach ($project['assigned_staff'] as $s): ?>
                            <li class="flex items-center justify-between">
                                <span><?php echo htmlspecialchars($s['name']); ?> <span class="text-xs text-secondary">(<?php echo htmlspecialchars($s['role_in_project']); ?>)</span></span>
                            </li>
                        <?php endforeach; ?>
                        <?php if (empty($project['assigned_staff'])): ?>
                            <li class="text-sm text-secondary">No staff assigned.</li>
                        <?php endif; ?>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </main>
    
    <!-- Report Modal -->
    <div id="reportModal" class="hidden fixed inset-0 bg-black/60 z-50 items-center justify-center">
        <div class="bg-white dark:bg-[#1A1614] rounded-2xl p-6 w-full max-w-lg">
            <h3 class="font-headline font-bold text-lg mb-3">Report Issue</h3>
            <textarea id="reportReason" class="w-full p-3 rounded-lg border border-[#D2C3C6] dark:border-[#2C1A12] bg-[#F4EDE8] dark:bg-[#2C1A12] text-[#2D141D] dark:text-[#F5F5F0]" rows="6" placeholder="Describe the problem..."></textarea>
            <div class="mt-4 flex justify-end gap-2">
                <button id="reportCancel" class="px-3 py-2 rounded-lg border border-[#D2C3C6]">Cancel</button>
                <button id="reportSubmit" class="px-3 py-2 rounded-lg bg-[#C5A059] text-[#12100E] font-bold">Submit Report</button>
            </div>
        </div>
    </div>

<script>
    (function(){
        const staffId = <?php echo intval($_SESSION['user_id']); ?>;
        const projectId = <?php echo intval($projectId); ?>;

        document.getElementById('btnOnProcess').addEventListener('click', function(){ updateAssignment('in_progress'); });
        document.getElementById('btnDone').addEventListener('click', function(){ updateAssignment('completed'); });
        document.getElementById('btnReport').addEventListener('click', function(){ document.getElementById('reportModal').classList.remove('hidden'); document.getElementById('reportModal').classList.add('flex'); });
        document.getElementById('reportCancel').addEventListener('click', function(){ document.getElementById('reportModal').classList.add('hidden'); document.getElementById('reportModal').classList.remove('flex'); });
        document.getElementById('reportSubmit').addEventListener('click', function(){
            const reason = document.getElementById('reportReason').value.trim();
            if (!reason) { alert('Please provide a reason.'); return; }
            fetch('api/staff.php?action=report_project', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ staff_id: staffId, project_id: projectId, reason: reason }) })
                .then(r=>r.json()).then(resp=>{ if (resp.success) { alert('Report submitted. Admin will be notified.'); document.getElementById('reportModal').classList.add('hidden'); document.getElementById('reportModal').classList.remove('flex'); } else { alert('Failed to submit report: ' + (resp.message || 'Unknown error')); } }).catch(err=>{ alert('Network error'); console.error(err); });
        });

        function updateAssignment(status) {
            fetch('api/staff.php?action=update_assignment_status', { method: 'PUT', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ staff_id: staffId, project_id: projectId, status: status }) })
                .then(r=>r.json()).then(resp=>{ if (resp.success) { alert('Status updated'); location.reload(); } else { alert('Failed to update status: ' + (resp.message || 'Unknown')); } }).catch(err=>{ alert('Network error'); console.error(err); });
        }
    })();
</script>
</body>
</html>
