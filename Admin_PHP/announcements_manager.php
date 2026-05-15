<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Announcement Manager - EDPS Studio</title>
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
            <a class="flex items-center gap-4 text-[#F5F5F0] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#2C1A12] transition-colors duration-200 group" href="webedit.php">
                <span class="material-symbols-outlined text-[#C5A059]" data-icon="language">language</span>
                <span class="font-body font-medium">Website CMS</span>
            </a>
        </nav>
        <div class="mt-auto pt-6 border-t border-[#2C1A12] space-y-1">
            <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors rounded-lg" href="settings.php">
                <span class="material-symbols-outlined text-[#C5A059]">settings</span>
                <span class="font-medium">Settings</span>
            </a>
            <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 group" href="#">
                <span class="material-symbols-outlined text-[#C5A059]" data-icon="logout">logout</span>
                <span class="font-body font-medium">Logout</span>
            </a>
        </div>
    </aside>
    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col min-w-0">
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
        <!-- Content Section -->
        <section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full space-y-8">
            <!-- Page Header -->
            <div class="space-y-2">
                <div class="flex items-center gap-4">
                    <button id="backArrowBtn" class="flex items-center justify-center w-12 h-12 rounded-lg hover:bg-[#2C1A12] transition-all text-[#C5A059] hover:text-[#F5F5F0] group" title="Go back to CMS Editor">
                        <span class="material-symbols-outlined text-4xl group-hover:scale-110 transition-transform">arrow_back</span>
                    </button>
                    <h1 class="text-4xl font-bold text-[#E4E0DC]">Announcement Manager</h1>
                </div>
                <p class="text-[#D1CDC7]">View, edit, and manage all posted announcements from this interface.</p>
            </div>

            <!-- Announcements Table -->
            <div class="bg-[#1A1614] rounded-3xl p-8 border border-[#2C1A12]">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-[#2C1A12]">
                                <th class="text-left py-4 px-6 text-xs font-bold uppercase tracking-widest text-[#C5A059]">Category</th>
                                <th class="text-left py-4 px-6 text-xs font-bold uppercase tracking-widest text-[#C5A059]">Title</th>
                                <th class="text-left py-4 px-6 text-xs font-bold uppercase tracking-widest text-[#C5A059]">Date Posted</th>
                                <th class="text-center py-4 px-6 text-xs font-bold uppercase tracking-widest text-[#C5A059]">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="announcementTableBody">
                            <!-- Announcements will be inserted here by JavaScript -->
                        </tbody>
                    </table>
                    <div id="emptyState" class="text-center py-12">
                        <span class="material-symbols-outlined text-5xl text-[#C5A059]/40 mb-4 block">inbox</span>
                        <p class="text-[#D1CDC7] text-sm">No announcements posted yet</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-[#1A1614] rounded-3xl p-8 max-w-md w-full mx-4 border border-[#2C1A12]">
            <div class="flex items-center gap-3 mb-4">
                <span class="material-symbols-outlined text-3xl text-[#ff6b6b]">warning</span>
                <h2 class="text-xl font-bold text-[#F5F5F0]">Delete Announcement?</h2>
            </div>
            <p class="text-[#D1CDC7] mb-6">Are you sure you want to delete this announcement? This action cannot be undone.</p>
            <div class="flex gap-3 justify-end">
                <button id="cancelDeleteBtn" class="px-6 py-2 rounded-lg text-[#D1CDC7] hover:bg-[#2C1A12] transition-colors font-bold text-sm">
                    Cancel
                </button>
                <button id="confirmDeleteBtn" class="px-6 py-2 bg-[#ff6b6b] text-white rounded-lg hover:bg-[#ff5252] transition-colors font-bold text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">delete</span>
                    <span>Delete</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Sample announcements data (in production, this would come from the database)
        const announcements = [
            {
                id: 1,
                category: 'WEDDING FAIR',
                title: 'With you, even silence feels warm',
                description: 'EDPS Studio showcases the warmth and intimacy of genuine moments captured through our lens...',
                datePosted: '2026-04-20',
                image: ''
            },
            {
                id: 2,
                category: 'THE CITY UNION',
                title: 'Urban Stories, Timeless Moments',
                description: 'Celebrating the intersection of architecture and human connection in every frame.',
                datePosted: '2026-04-15',
                image: ''
            },
            {
                id: 3,
                category: 'EXHIBITION',
                title: 'Spring Collection Launch',
                description: 'Join us for an exclusive preview of our latest studio collection.',
                datePosted: '2026-04-10',
                image: ''
            }
        ];

        let deleteTargetId = null;

        // Initialize table
        function loadAnnouncements() {
            const tbody = document.getElementById('announcementTableBody');
            const emptyState = document.getElementById('emptyState');

            if (announcements.length === 0) {
                tbody.innerHTML = '';
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
                tbody.innerHTML = announcements.map(ann => `
                    <tr class="border-b border-[#2C1A12] hover:bg-[#2C1A12]/50 transition-colors">
                        <td class="py-4 px-6 text-[#C5A059] font-bold text-sm">${ann.category}</td>
                        <td class="py-4 px-6 text-[#F5F5F0] font-bold">${ann.title}</td>
                        <td class="py-4 px-6 text-[#D1CDC7] text-sm">${formatDate(ann.datePosted)}</td>
                        <td class="py-4 px-6 text-center space-x-2 flex justify-center">
                            <button class="edit-btn p-2 hover:bg-[#C5A059]/20 rounded-lg transition-colors text-[#C5A059]" data-id="${ann.id}">
                                <span class="material-symbols-outlined text-base">edit</span>
                            </button>
                            <button class="delete-btn p-2 hover:bg-[#ff6b6b]/20 rounded-lg transition-colors text-[#ff6b6b]" data-id="${ann.id}">
                                <span class="material-symbols-outlined text-base">delete</span>
                            </button>
                        </td>
                    </tr>
                `).join('');

                // Attach event listeners
                document.querySelectorAll('.edit-btn').forEach(btn => {
                    btn.addEventListener('click', (e) => handleEdit(parseInt(e.currentTarget.dataset.id)));
                });

                document.querySelectorAll('.delete-btn').forEach(btn => {
                    btn.addEventListener('click', (e) => handleDeleteClick(parseInt(e.currentTarget.dataset.id)));
                });
            }
        }

        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('en-US', options);
        }

        function handleEdit(id) {
            const announcement = announcements.find(a => a.id === id);
            if (announcement) {
                // Store the announcement data in sessionStorage to pass to editor
                sessionStorage.setItem('editAnnouncement', JSON.stringify(announcement));
                // Redirect to webedit.php
                window.location.href = 'webedit.php?edit=' + id;
            }
        }

        function handleDeleteClick(id) {
            deleteTargetId = id;
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('hidden');
        }

        function handleDelete(id) {
            const index = announcements.findIndex(a => a.id === id);
            if (index > -1) {
                announcements.splice(index, 1);
                loadAnnouncements();
            }
        }

        // Modal event listeners
        document.getElementById('cancelDeleteBtn').addEventListener('click', () => {
            document.getElementById('deleteModal').classList.add('hidden');
            deleteTargetId = null;
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
            if (deleteTargetId !== null) {
                handleDelete(deleteTargetId);
                document.getElementById('deleteModal').classList.add('hidden');
                deleteTargetId = null;
                showSuccessNotification('Announcement deleted successfully!');
            }
        });

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('deleteModal')) {
                document.getElementById('deleteModal').classList.add('hidden');
                deleteTargetId = null;
            }
        });

        function showSuccessNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-8 right-8 px-6 py-3 bg-[#C5A059] text-[#12100E] font-bold rounded-lg shadow-2xl shadow-[#C5A059]/40 animate-pulse z-50';
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 2000);
        }

        // Load announcements on page load
        loadAnnouncements();

        // Back arrow button functionality
        document.getElementById('backArrowBtn').addEventListener('click', () => {
            window.location.href = 'webedit.php';
        });

        // Ensure Website CMS sidebar item remains active when on Announcement Manager page
        window.addEventListener('load', () => {
            // The Website CMS sidebar link should already be highlighted in announcements_manager.php
            // since it's a sub-page of the CMS. This is maintained through the HTML structure.
            const editData = sessionStorage.getItem('editAnnouncement');
            if (editData) {
                sessionStorage.removeItem('editAnnouncement');
            }
        });
    </script>
</body>
</html>
