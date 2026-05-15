<?php
require_once 'config.php';
require_once 'Database.php';

// Sample notifications (UI-only placeholders)
$sampleNotifications = [
    [ 'id' => 1, 'title' => 'Project "Portfolio Edits Vol. II" placed On Hold', 'message' => 'Admin updated status to On Hold. Please review client notes and confirm availability.', 'project_id' => 2, 'type' => 'project_update', 'status' => 'unread', 'date' => '2025-03-12 09:14' ],
    [ 'id' => 2, 'title' => 'Project "Vogue Cover Retouching" review completed', 'message' => 'Admin: Review completed and approved. You can mark as done when ready.', 'project_id' => 3, 'type' => 'project_update', 'status' => 'read', 'date' => '2024-12-05 14:22' ],
    [ 'id' => 3, 'title' => 'New comment on "The Montgomery Wedding"', 'message' => 'Admin: Please check the shot list updates and confirm timings.', 'project_id' => 1, 'type' => 'comment', 'status' => 'unread', 'date' => '2025-01-08 11:03' ],
];

// Profile fallback
$staffUsername = $_SESSION['username'] ?? '';
$staffProfileImage = $_SESSION['profile_image'] ?? '';
$initial = !empty($staffUsername) ? strtoupper(substr($staffUsername, 0, 1)) : 'S';
$svg = '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"><rect width="100%" height="100%" fill="#3E2723"/><text x="50%" y="50%" font-size="20" fill="#C5A059" text-anchor="middle" dominant-baseline="middle">'.htmlspecialchars($initial).'</text></svg>';
$defaultAvatar = 'data:image/svg+xml;utf8,'.rawurlencode($svg);
$profileImageSrc = !empty($staffProfileImage) ? htmlspecialchars($staffProfileImage) : $defaultAvatar;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Notifications | EDPS Studio</title>
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
            @keyframes buttonPulseGold { 0% { transform: scale(1); } 50% { transform: scale(1.08); background: #ffe9b3; } 100% { transform: scale(1); } }
            .btn-animate-pulse-gold { animation: buttonPulseGold 0.45s cubic-bezier(.4,2,.6,1) 1; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fadeIn { animation: fadeIn 0.4s ease-out both; }
        @keyframes buttonPulse { 0% { transform: scale(1); } 50% { transform: scale(1.08); background: #ffe9b3; } 100% { transform: scale(1); } }
        .btn-animate-pulse { animation: buttonPulse 0.35s cubic-bezier(.4,2,.6,1) 1; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        @media (max-width: 640px) {
            h1, h2, h3, h4, h5, h6 { font-size: calc(1em * 0.8); }
            body { font-size: 14px; }
        }
        /* Prevent white flash on page load and transitions */
        html { background: #FFF8F3; color: #2D141D; }
        html.dark { background: #12100E; color: #D1CDC7; }
        body { transition: background-color 0.3s ease, color 0.3s ease, opacity 0.3s ease; }
        /* Notifications swipe-action layout using scroll-snap */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; scroll-behavior: smooth; }

        /* Ensure snap stays open once user swipes past threshold */
        .notif-content, .notif-action-container, .action-mark-read, .action-delete { scroll-snap-stop: always; }

        .notif-actions { display: flex; align-items: center; gap: 8px; padding-right: 8px; }
        .notif-actions .action-mark-read { background: #C5A059; color: #12100E; border-radius: 6px; font-weight: 700; }
        .notif-actions .action-delete { background: #ba1a1a; color: #fff; border-radius: 6px; font-weight: 700; }

        .notif-content { transition: none; }

        /* Mobile: shorten notification text length */
        .notif-title { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
        .notif-message { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; max-width:100%; }
        @media (max-width: 640px) {
            .notif-content { padding: 0.75rem; }
            .notif-message { font-size: 11px; }
            /* Ensure truncation on mobile: title single-line ellipsis, message two-line clamp */
            .notif-title { display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
            .notif-message { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        }

        /* Desktop-only: toggle button to reveal action buttons */
        @media (min-width: 768px) {
            .notif-wrap { position: relative; }
            .notif-content { transition: none; }
            /* Desktop: show action buttons by default and ensure they touch content */
            .notif-wrap .notif-action-container { opacity: 1; pointer-events: auto; transform: none; }
            .notif-wrap .notif-content { transform: none; }
            /* Hide any toggle UI on desktop since actions are always visible */
            .notif-toggle { display: none !important; }
        }
    </style>
</head>
<?php $cur = basename($_SERVER['PHP_SELF']); ?>
<body class="bg-[#FFF8F3] dark:bg-[#12100E] font-body text-[#745C63] dark:text-[#D1CDC7] antialiased flex min-h-screen transition-colors duration-300">
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
            <!-- Notifications link intentionally removed for desktop sidebar per request -->
        </nav>
        <div class="mt-auto pt-6 border-t border-[#D2C3C6] dark:border-[#2C1A12]">
            <a href="staff-settings.php" class="<?php echo $cur=='staff-settings.php' ? 'flex items-center gap-4 text-[#2D141D] dark:text-[#C5A059] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#F9F2ED] dark:bg-[#2C1A12]' : 'flex items-center gap-4 text-secondary dark:text-[#D1CDC7] pl-5 py-3 hover:bg-[#F9F2ED] dark:hover:bg-[#2C1A12]'; ?>">
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
                <!-- Username removed from header for desktop notifications per request -->

                <a href="staff-settings.php#account-info" class="flex items-center rounded-full overflow-hidden ml-3" aria-label="Account settings">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full overflow-hidden bg-primary dark:bg-[#C5A059] flex items-center justify-center flex-shrink-0">
                        <img class="w-full h-full object-cover" src="<?php echo $profileImageSrc; ?>" alt="Profile"/>
                    </div>
                </a>
            </div>
        </header>

        <section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full">
                <div class="mb-6 grid grid-cols-2 gap-y-2 items-start">
                <h1 class="col-start-1 row-start-1 text-2xl font-headline font-bold text-[#2D141D] dark:text-[#F5F5F0]">Notifications</h1>
                <div class="col-start-2 row-start-2 justify-self-end">
                    <button id="markAllRead" class="px-3 py-1.5 rounded-lg bg-[#C5A059] text-[#12100E] dark:text-[#12100E] font-bold text-[10px]">Mark all as read</button>
                </div>
            </div>

            <div id="notificationsList" class="space-y-4"></div>
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

    <script>
        async function refreshHeaderBadges(){
            try{ const r = await fetch('api/notifications.php?action=unread_count'); const j=await r.json(); if(j.success){ const n = Number(j.unread||0); document.querySelectorAll('#notifBadge').forEach(b=>{ if(n>0){ b.textContent = n>99? '99+':String(n); b.classList.remove('hidden'); } else b.classList.add('hidden'); }); } }catch(e){console.error(e);}    
        }

        // Mark all read: mark via API and update card borders/status
        document.getElementById('markAllRead')?.addEventListener('click', async function(){
            try{
                // Animate the button itself
                const btn = document.getElementById('markAllRead');
                if(btn){
                    btn.classList.add('btn-animate-pulse-gold');
                    setTimeout(()=>btn.classList.remove('btn-animate-pulse-gold'), 500);
                }
                const res = await fetch('api/notifications.php?action=mark_all_read',{ method: 'PUT' });
                const j = await res.json();
                if(j.success){
                    document.querySelectorAll('.notif-wrap').forEach(wrap => {
                        wrap.dataset.status = 'read';
                        wrap.classList.remove('border-[#C5A059]');
                        wrap.classList.add('border-[#D2C3C6]','dark:border-[#2C1A12]');
                        const article = wrap.querySelector('.notif-content'); if(article){ article.classList.remove('shadow-md'); article.classList.add('opacity-80'); }
                        // Update mark button to unread state and animate
                        const markBtn = wrap.querySelector('.action-mark-read');
                        if(markBtn){
                            markBtn.textContent = 'Mark as unread';
                            markBtn.classList.remove('bg-[#C5A059]','text-white','dark:text-white');
                            markBtn.classList.add('bg-[#D2C3C6]','dark:bg-[#2C1A12]','text-[#12100E]','dark:text-white','btn-animate-pulse');
                            setTimeout(()=>markBtn.classList.remove('btn-animate-pulse'), 400);
                        }
                    });
                    await refreshHeaderBadges();
                }
            }catch(e){ console.error(e); }
        });

        // Delegated handler for swipe action buttons (mark/unmark/delete)
        document.addEventListener('click', async function(e){
            const markBtn = e.target.closest('.action-mark-read');
            const delBtn = e.target.closest('.action-delete');
            if (markBtn) {
                e.preventDefault(); e.stopPropagation();
                const id = Number(markBtn.getAttribute('data-id'));
                const wrap = markBtn.closest('.notif-wrap');
                const article = wrap?.querySelector('.notif-content');
                const currentlyUnread = wrap?.dataset.status === 'unread';
                const action = currentlyUnread ? 'mark_read' : 'mark_unread';
                try {
                    try{ const dbg=document.getElementById('notifDebug'); if(dbg) dbg.textContent = 'Sending '+action+' id='+id; }catch(e){}
                    const res = await fetch('api/notifications.php?action=' + action, { method: 'PUT', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ id }) });
                    let j = null;
                    try{
                        j = await res.json();
                    }catch(parseErr){
                        try{
                            const raw = await res.text();
                            j = { success: false, parseError: String(parseErr), raw: raw };
                        }catch(e){ j = { success: false, parseError: String(parseErr) }; }
                    }
                    try{ const dbg=document.getElementById('notifDebug'); if(dbg) dbg.textContent = 'Resp '+res.status+': '+(j && j.success? 'OK': (j && j.error? j.error : (j.parseError? j.parseError : JSON.stringify(j)))); console.log('API response', j); }catch(e){}
                    if (j.success) {
                        wrap.dataset.status = currentlyUnread ? 'read' : 'unread';
                        wrap.classList.remove('border-[#C5A059]','border-[#D2C3C6]','dark:border-[#2C1A12]');
                        if (wrap.dataset.status === 'unread') {
                            wrap.classList.add('border-[#C5A059]');
                            markBtn.textContent = 'Mark as read';
                            markBtn.classList.remove('bg-[#D2C3C6]','dark:bg-[#2C1A12]');
                            markBtn.classList.add('bg-[#C5A059]');
                            markBtn.classList.remove('text-[#12100E]','dark:text-[#D1CDC7]');
                            markBtn.classList.add('text-white','dark:text-white');
                            if (article) { article.classList.remove('opacity-80'); article.classList.add('shadow-md'); }
                        } else {
                            wrap.classList.add('border-[#D2C3C6]','dark:border-[#2C1A12]');
                            markBtn.textContent = 'Mark as unread';
                            markBtn.classList.remove('bg-[#C5A059]');
                            markBtn.classList.add('bg-[#D2C3C6]','dark:bg-[#2C1A12]');
                            markBtn.classList.remove('text-white','dark:text-white');
                            markBtn.classList.add('text-[#12100E]','dark:text-white');
                            if (article) { article.classList.remove('shadow-md'); article.classList.add('opacity-80'); }
                        }
                        markBtn.classList.add('btn-animate-pulse');
                        setTimeout(()=>markBtn.classList.remove('btn-animate-pulse'), 400);
                        await refreshHeaderBadges();
                    }
                } catch (err) { console.error(err); }
            } else if (delBtn) {
                e.preventDefault(); e.stopPropagation();
                const id = Number(delBtn.getAttribute('data-id'));
                const wrap = delBtn.closest('.notif-wrap');
                try {
                    try{ const dbg=document.getElementById('notifDebug'); if(dbg) dbg.textContent = 'Sending delete id='+id; }catch(e){}
                    const res = await fetch('api/notifications.php?action=delete', { method: 'DELETE', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ id }) });
                    let j = null;
                    try{
                        j = await res.json();
                    }catch(parseErr){
                        try{
                            const raw = await res.text();
                            j = { success: false, parseError: String(parseErr), raw: raw };
                        }catch(e){ j = { success: false, parseError: String(parseErr) }; }
                    }
                    try{ const dbg=document.getElementById('notifDebug'); if(dbg) dbg.textContent = 'Resp '+res.status+': '+(j && j.success? 'OK': (j && j.error? j.error : (j.parseError? j.parseError : JSON.stringify(j)))); console.log('API response', j); }catch(e){}
                    if (j.success) {
                        wrap.style.transition = 'height 0.18s ease, opacity 0.18s ease, margin 0.18s ease';
                        wrap.style.opacity = '0';
                        wrap.style.height = '0px';
                        wrap.style.margin = '0px';
                        setTimeout(()=>{ wrap.remove(); refreshHeaderBadges(); }, 220);
                    }
                } catch (err) { console.error(err); }
            }
        });

        // mark a single notification as unread (exposed for future UI hooks)
        async function markUnread(id){
            if(!id) return;
            try{
                await fetch('api/notifications.php?action=mark_unread', { method: 'PUT', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ id }) });
            }catch(e){ console.error(e); }
            // update DOM
            const card = document.querySelector(`.notif-card[data-id=\"${id}\"]`);
            if(card){
                card.dataset.status = 'unread';
                card.classList.remove('border-[#D2C3C6]','dark:border-[#2C1A12]');
                card.classList.add('border-[#C5A059]');
                // remove read badge if present
                const badge = card.querySelector('.read-badge'); if(badge) badge.remove();
            }
            await refreshHeaderBadges();
        }
        window.markUnread = markUnread;

        // refresh badge on page open and poll
        refreshHeaderBadges();
        setInterval(refreshHeaderBadges, 30000);

        // Desktop: actions are visible by default (no toggle needed)

        // Theme + mobile nav active state (copied from staff-dashboard behavior)
        document.addEventListener('DOMContentLoaded', function() {
            const html = document.documentElement;
            const savedTheme = localStorage.getItem('staffPortalTheme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme === 'dark' || (savedTheme === null && prefersDark)) {
                html.classList.add('dark');
            }

            const currentPage = window.location.pathname.split('/').pop() || 'notifications.php';
            const mobileNavLinks = document.querySelectorAll('nav.fixed a');

            mobileNavLinks.forEach(link => {
                const href = link.getAttribute('href');
                const linkPage = href.split('/').pop();
                if (linkPage && (linkPage.split('#')[0] === currentPage || (currentPage === '' && linkPage.split('#')[0] === 'notifications.php'))) {
                    link.classList.add('text-[#C5A059]');
                }
            });

            // Load notifications from API and render; fall back to PHP sample data
            async function loadNotifications() {
                const container = document.getElementById('notificationsList');
                if (!container) return;
                let notes = null;
                try {
                    const res = await fetch('api/notifications.php?action=list');
                    const j = await res.json();
                    if (j.success && Array.isArray(j.notifications)) notes = j.notifications;
                } catch (err) { /* ignore */ }

                if (!notes) {
                    // fallback to server-rendered sample notifications
                    notes = <?php echo json_encode($sampleNotifications, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_AMP|JSON_HEX_QUOT); ?>;
                }

                // debug: indicate load result
                // Removed debug status from bottom right

                function createNotifElement(n) {
                    const isUnread = (n.status === 'unread');
                    const outerBorder = isUnread ? 'border-[#C5A059]' : 'border-[#D2C3C6] dark:border-[#2C1A12]';

                    const wrap = document.createElement('div');
                    wrap.className = `flex w-full overflow-x-auto snap-x snap-mandatory scroll-smooth hide-scrollbar rounded-2xl border-2 mb-3 notif-wrap ${outerBorder}`;
                    wrap.dataset.status = n.status || 'read';

                    const inner = document.createElement('div');
                    inner.className = 'flex min-w-[calc(100%+96px)] snap-start items-stretch w-full';

                    const content = document.createElement('div');
                    content.className = 'min-w-full flex-shrink-0 flex items-center justify-between p-3 md:p-4 bg-white dark:bg-[#1A1614] notif-content';

                    const left = document.createElement('div');
                    left.className = 'flex items-start gap-4 flex-1 pr-3';

                    const avatarWrap = document.createElement('div');
                    avatarWrap.className = 'flex-shrink-0';
                    const avatar = document.createElement('div');
                    avatar.className = 'w-12 h-12 rounded-full bg-[#F4EDE8] dark:bg-[#2C1A12] flex items-center justify-center text-[#C5A059]';
                    const icon = document.createElement('span');
                    icon.className = 'material-symbols-outlined';
                    icon.textContent = 'campaign';
                    avatar.appendChild(icon);
                    avatarWrap.appendChild(avatar);

                    const textCol = document.createElement('div');
                    textCol.className = 'flex-1';
                    const a = document.createElement('a');
                    a.href = 'project-details.php?id=' + (n.project_id ? parseInt(n.project_id) : '');
                    a.className = 'notif-title font-bold text-[#2D141D] dark:text-[#F5F5F0] hover:underline truncate line-clamp-1';
                    a.textContent = n.title || '';
                    // Mark as read when opened
                    a.addEventListener('click', async function(e) {
                        if (n.status === 'unread') {
                            try {
                                await fetch('api/notifications.php?action=mark_read', { method: 'PUT', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ id: n.id }) });
                                // update DOM immediately
                                const wrap = a.closest('.notif-wrap');
                                if (wrap) {
                                    wrap.dataset.status = 'read';
                                    wrap.classList.remove('border-[#C5A059]');
                                    wrap.classList.add('border-[#D2C3C6]','dark:border-[#2C1A12]');
                                    const markBtn = wrap.querySelector('.action-mark-read');
                                    if(markBtn){
                                        markBtn.textContent = 'Mark as unread';
                                        markBtn.classList.remove('bg-[#C5A059]','text-white','dark:text-white');
                                        markBtn.classList.add('bg-[#D2C3C6]','dark:bg-[#2C1A12]','text-[#12100E]','dark:text-white','btn-animate-pulse');
                                        setTimeout(()=>markBtn.classList.remove('btn-animate-pulse'), 400);
                                    }
                                }
                            } catch (err) { /* ignore */ }
                        }
                    });
                    const p = document.createElement('p');
                    p.className = 'notif-message text-[#745C63] dark:text-[#D1CDC7] mt-1 max-w-full line-clamp-1 md:line-clamp-2 text-[11px] md:text-[14px]';
                    p.textContent = n.message || '';
                    const meta = document.createElement('div');
                    meta.className = 'mt-3 flex items-center justify-between';
                    const time = document.createElement('time');
                    time.className = 'text-xs text-[#745C63] dark:text-[#D1CDC7]';
                    time.textContent = n.date || '';
                    meta.appendChild(time);
                    // Removed status text from bottom right

                    textCol.appendChild(a);
                    textCol.appendChild(p);
                    textCol.appendChild(meta);

                    left.appendChild(avatarWrap);
                    left.appendChild(textCol);

                    content.appendChild(left);
                    // No arrow toggle on desktop; actions will be visible

                    const actions = document.createElement('div');
                    actions.className = 'flex flex-shrink-0 h-full snap-end notif-action-container';

                    const markBtn = document.createElement('button');
                    markBtn.className = isUnread ? 'action-mark-read h-full w-12 flex-shrink-0 flex items-center justify-center font-bold text-[10px] uppercase tracking-wider rounded-none bg-[#C5A059] text-white cursor-pointer' : 'action-mark-read h-full w-12 flex-shrink-0 flex items-center justify-center font-bold text-[10px] uppercase tracking-wider rounded-none bg-[#D2C3C6] dark:bg-[#2C1A12] text-[#12100E] dark:text-white cursor-pointer';
                    markBtn.setAttribute('data-id', n.id);
                    markBtn.textContent = isUnread ? 'Mark as read' : 'Mark as unread';

                    const delBtn = document.createElement('button');
                    delBtn.className = 'action-delete h-full w-12 flex-shrink-0 flex items-center justify-center font-bold text-[10px] uppercase tracking-wider rounded-r-2xl rounded-l-none bg-[#ba1a1a] text-white cursor-pointer';
                    delBtn.setAttribute('data-id', n.id);
                    delBtn.textContent = 'Delete';

                    actions.appendChild(markBtn);
                    actions.appendChild(delBtn);

                    inner.appendChild(content);
                    inner.appendChild(actions);
                    wrap.appendChild(inner);
                    return wrap;
                }

                // render
                container.innerHTML = '';
                if (!notes || notes.length === 0) {
                    const emptyMsg = document.createElement('div');
                    emptyMsg.className = 'text-center text-[#745C63] dark:text-[#D1CDC7] text-lg py-12';
                    emptyMsg.textContent = 'No notifications';
                    container.appendChild(emptyMsg);
                } else {
                    notes.forEach(n => {
                        const el = createNotifElement(n);
                        container.appendChild(el);
                    });
                }
            }

            // Mobile-only: truncate notification title/message to 5 words and shrink main container width
            function truncateWords(str, num) {
                if (!str) return '';
                const parts = str.trim().split(/\s+/);
                if (parts.length <= num) return str;
                return parts.slice(0, num).join(' ') + '…';
            }

            function applyMobileTruncation() {
                const isMobile = window.innerWidth <= 640;
                document.querySelectorAll('.notif-wrap').forEach(wrap => {
                    const titleEl = wrap.querySelector('.notif-title');
                    const msgEl = wrap.querySelector('.notif-message');
                    const contentEl = wrap.querySelector('.notif-content');
                    if (!contentEl) return;

                    // store original full text once
                    if (titleEl && !titleEl.dataset.fullText) titleEl.dataset.fullText = titleEl.textContent.trim();
                    if (msgEl && !msgEl.dataset.fullText) msgEl.dataset.fullText = msgEl.textContent.trim();

                    if (isMobile) {
                        if (titleEl) titleEl.textContent = truncateWords(titleEl.dataset.fullText || titleEl.textContent, 10);
                        if (msgEl) msgEl.textContent = truncateWords(msgEl.dataset.fullText || msgEl.textContent, 10);

                        // shrink content width to fit truncated text (allow small padding)
                        contentEl.style.width = 'auto';
                        const natural = Math.ceil(contentEl.scrollWidth);
                        contentEl.style.minWidth = (natural + 8) + 'px';
                        contentEl.style.display = 'inline-block';
                    } else {
                        // restore originals
                        if (titleEl && titleEl.dataset.fullText) titleEl.textContent = titleEl.dataset.fullText;
                        if (msgEl && msgEl.dataset.fullText) msgEl.textContent = msgEl.dataset.fullText;
                        contentEl.style.minWidth = '';
                        contentEl.style.width = '';
                        contentEl.style.display = '';
                    }
                });
            }

            let truncationTimer = null;
            // load notifications then apply truncation
            loadNotifications().then(() => applyMobileTruncation());
            window.addEventListener('resize', function(){ clearTimeout(truncationTimer); truncationTimer = setTimeout(applyMobileTruncation, 120); });
            window.addEventListener('orientationchange', function(){ setTimeout(applyMobileTruncation, 200); });
        });
    </script>
</body>
</html>
