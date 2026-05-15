<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Package Details - EDPS Studio</title>
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
            <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors duration-200 group" href="login.php">
                <span class="material-symbols-outlined text-[#C5A059]" data-icon="logout">logout</span>
                <span class="font-body font-medium">Logout</span>
            </a>
        </div>
    </aside>

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

        <!-- Content Canvas -->
        <section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full">
            <!-- Page Header with Back Navigation -->
            <div class="flex items-center gap-4 mb-12">
                <button id="backButton" class="flex items-center justify-center p-2 hover:bg-[#2C1A12] rounded-lg transition-colors" title="Back to Website CMS">
                    <span class="material-symbols-outlined text-2xl text-[#C5A059]">arrow_back</span>
                </button>
                <div>
                    <h1 class="font-serif text-4xl text-[#F5F5F0]">Manage Package Details</h1>
                    <p class="text-sm text-[#D1CDC7] mt-2" id="packageNameDisplay">Package: <span id="packageNameSpan" class="text-[#C5A059] font-bold">Loading...</span></p>
                </div>
            </div>

            <!-- Main Content -->
            <div class="space-y-12">
                <!-- Pricing Section -->
                <section class="bg-[#1A1614] p-8 rounded-3xl hover:shadow-lg hover:shadow-[#C5A059]/20 transition-all duration-300">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <div class="flex items-center space-x-2 text-[#C5A059] text-xs font-bold uppercase tracking-widest mb-2">
                                <span class="material-symbols-outlined text-base" data-icon="payments">payments</span>
                                <span>Pricing</span>
                            </div>
                            <h2 class="font-serif text-2xl text-[#F5F5F0]">Package Pricing</h2>
                        </div>
                        <button id="pricingSaveBtn" class="flex items-center space-x-1 px-4 py-2 bg-[#C5A059] rounded-lg text-sm font-bold text-[#12100E] hover:shadow-md transition-all">
                            <span class="material-symbols-outlined text-sm" data-icon="save">save</span>
                            <span>Save Pricing</span>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-3">Base Price</label>
                            <input id="basePrice" class="w-full bg-[#2d2825]/50 border border-[#C5A059]/20 focus:border-[#C5A059] focus:ring-1 focus:ring-[#C5A059]/30 p-4 rounded-lg text-[#F5F5F0] placeholder-[#D1CDC7]/40 transition-colors text-lg font-serif" type="text" placeholder="e.g., 49,999" onchange="document.body.setAttribute('data-pricing-unsaved', 'true')"/>
                            <p class="text-[10px] text-[#D1CDC7]/60 mt-2">Enter the base price without currency symbol</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-3">Unit (e.g., "/shoot", "/hour")</label>
                            <input id="priceUnit" class="w-full bg-[#2d2825]/50 border border-[#C5A059]/20 focus:border-[#C5A059] focus:ring-1 focus:ring-[#C5A059]/30 p-4 rounded-lg text-[#F5F5F0] placeholder-[#D1CDC7]/40 transition-colors text-lg" type="text" placeholder="e.g., /shoot" onchange="document.body.setAttribute('data-pricing-unsaved', 'true')"/>
                            <p class="text-[10px] text-[#D1CDC7]/60 mt-2">Define the pricing unit or interval</p>
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-[#2d2825]/50 rounded-lg border border-[#C5A059]/20">
                        <p class="text-sm text-[#D1CDC7]">
                            <span class="text-[#C5A059] font-bold">Preview:</span> 
                            <span id="pricePreview" class="font-serif">—</span>
                        </p>
                    </div>
                </section>

                <!-- Checklist Section -->
                <section class="bg-[#1A1614] p-8 rounded-3xl hover:shadow-lg hover:shadow-[#C5A059]/20 transition-all duration-300">
                    <div class="flex justify-between items-start mb-8">
                        <div>
                            <div class="flex items-center space-x-2 text-[#C5A059] text-xs font-bold uppercase tracking-widest mb-2">
                                <span class="material-symbols-outlined text-base" data-icon="checklist">checklist</span>
                                <span>Package Inclusions</span>
                            </div>
                            <h2 class="font-serif text-2xl text-[#F5F5F0]">Manage Checklist Items</h2>
                        </div>
                        <button id="checklistSaveBtn" class="flex items-center space-x-1 px-4 py-2 bg-[#C5A059] rounded-lg text-sm font-bold text-[#12100E] hover:shadow-md transition-all">
                            <span class="material-symbols-outlined text-sm" data-icon="save">save</span>
                            <span>Save Checklist</span>
                        </button>
                    </div>

                    <!-- Checklist Items Container -->
                    <div id="checklistContainer" class="space-y-4 mb-6">
                        <!-- Checklist items will be inserted here -->
                    </div>

                    <!-- Add New Item Button -->
                    <button id="addChecklistItemBtn" class="w-full py-4 border-2 border-dashed border-[#C5A059]/30 rounded-lg text-sm font-bold text-[#D1CDC7] hover:border-[#C5A059]/50 hover:text-[#C5A059] transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-lg" data-icon="add_circle">add_circle</span>
                        <span>Add Inclusion Item</span>
                    </button>
                </section>

                <!-- Global Save Section -->
                <div class="flex gap-3 justify-end">
                    <button id="globalCancelBtn" class="flex items-center space-x-1 px-6 py-3 border border-[#C5A059]/30 rounded-lg text-sm font-bold text-[#C5A059] hover:bg-[#C5A059]/5 transition-colors">
                        <span>Cancel</span>
                    </button>
                    <button id="globalSaveBtn" class="hidden flex items-center space-x-1 px-6 py-3 bg-[#C5A059] rounded-lg text-sm font-bold text-[#12100E] hover:shadow-md transition-all">
                        <span class="material-symbols-outlined text-sm" data-icon="save">save</span>
                        <span>Save All Changes</span>
                    </button>
                </div>
            </div>
        </section>
    </main>

    <script>
        // ====== PACKAGE DATA MANAGEMENT ======
        let currentPackageId = null;
        let currentPackageName = '';
        let checklistItems = [];

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', () => {
            // Get package ID from URL parameter
            const params = new URLSearchParams(window.location.search);
            currentPackageId = params.get('id');
            currentPackageName = params.get('name') || 'Unnamed Package';

            if (!currentPackageId) {
                console.error('No package ID provided');
                document.getElementById('packageNameSpan').textContent = 'Error: No package selected';
                return;
            }

            // Update page title
            document.getElementById('packageNameSpan').textContent = decodeURIComponent(currentPackageName);

            // Load package data
            loadPackageData();

            // Setup event listeners
            setupEventListeners();
        });

        // Load package data from localStorage
        function loadPackageData() {
            const packages = JSON.parse(localStorage.getItem('tailoredPackages')) || [];
            const package_ = packages.find(p => p.id === parseInt(currentPackageId));

            if (package_) {
                document.getElementById('basePrice').value = package_.basePrice || '';
                document.getElementById('priceUnit').value = package_.priceUnit || '';
                checklistItems = package_.checklist ? JSON.parse(package_.checklist) : [];
            }

            renderChecklistItems();
            updatePricePreview();
        }

        // Setup event listeners
        function setupEventListeners() {
            // Back button
            document.getElementById('backButton').addEventListener('click', () => {
                window.location.href = 'webedit.php';
            });

            // Cancel button
            document.getElementById('globalCancelBtn').addEventListener('click', () => {
                window.location.href = 'webedit.php';
            });

            // Price inputs
            document.getElementById('basePrice').addEventListener('input', updatePricePreview);
            document.getElementById('priceUnit').addEventListener('input', updatePricePreview);

            // Add checklist item button
            document.getElementById('addChecklistItemBtn').addEventListener('click', addChecklistItem);

            // Save buttons
            document.getElementById('pricingSaveBtn').addEventListener('click', savePricing);
            document.getElementById('checklistSaveBtn').addEventListener('click', saveChecklist);
            document.getElementById('globalSaveBtn').addEventListener('click', saveAll);

            // Global save button visibility
            const observer = new MutationObserver(() => {
                const hasUnsaved = 
                    document.body.getAttribute('data-pricing-unsaved') === 'true' ||
                    document.body.getAttribute('data-checklist-unsaved') === 'true';
                
                if (hasUnsaved) {
                    document.getElementById('globalSaveBtn').classList.remove('hidden');
                } else {
                    document.getElementById('globalSaveBtn').classList.add('hidden');
                }
            });

            observer.observe(document.body, { 
                attributes: true, 
                attributeFilter: ['data-pricing-unsaved', 'data-checklist-unsaved'] 
            });
        }

        // Update price preview
        function updatePricePreview() {
            const basePrice = document.getElementById('basePrice').value;
            const priceUnit = document.getElementById('priceUnit').value;
            const preview = basePrice && priceUnit ? `Php. ${basePrice} ${priceUnit}` : (basePrice ? `Php. ${basePrice}` : '—');
            document.getElementById('pricePreview').textContent = preview;
            document.body.setAttribute('data-pricing-unsaved', 'true');
        }

        // Render checklist items
        function renderChecklistItems() {
            const container = document.getElementById('checklistContainer');
            container.innerHTML = checklistItems.map((item, index) => `
                <div class="flex items-center gap-3 p-4 bg-[#2d2825]/50 rounded-lg border border-[#C5A059]/20 hover:border-[#C5A059]/40 transition-all">
                    <span class="flex-shrink-0 text-[#C5A059] font-bold text-lg">${index + 1}.</span>
                    <input 
                        type="text" 
                        value="${item.text}" 
                        data-index="${index}"
                        class="flex-1 bg-transparent border-none text-[#F5F5F0] outline-none placeholder-[#D1CDC7]/40" 
                        placeholder="Enter inclusion item..."
                        onchange="updateChecklistItem(${index}, this.value); document.body.setAttribute('data-checklist-unsaved', 'true');"
                    />
                    <div class="flex items-center gap-1">
                        <button 
                            class="p-2 text-[#D1CDC7] hover:text-[#C5A059] hover:bg-[#C5A059]/10 rounded-lg transition-colors" 
                            title="Move up"
                            ${index === 0 ? 'disabled style="opacity: 0.5; cursor: not-allowed;"' : ''}
                            onclick="moveChecklistItem(${index}, -1); document.body.setAttribute('data-checklist-unsaved', 'true');"
                        >
                            <span class="material-symbols-outlined text-lg">arrow_upward</span>
                        </button>
                        <button 
                            class="p-2 text-[#D1CDC7] hover:text-[#C5A059] hover:bg-[#C5A059]/10 rounded-lg transition-colors" 
                            title="Move down"
                            ${index === checklistItems.length - 1 ? 'disabled style="opacity: 0.5; cursor: not-allowed;"' : ''}
                            onclick="moveChecklistItem(${index}, 1); document.body.setAttribute('data-checklist-unsaved', 'true');"
                        >
                            <span class="material-symbols-outlined text-lg">arrow_downward</span>
                        </button>
                        <button 
                            class="p-2 text-[#D1CDC7] hover:text-[#ff6b6b] hover:bg-[#ff6b6b]/10 rounded-lg transition-colors" 
                            title="Delete"
                            onclick="deleteChecklistItem(${index}); document.body.setAttribute('data-checklist-unsaved', 'true');"
                        >
                            <span class="material-symbols-outlined text-lg">delete</span>
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // Add new checklist item
        function addChecklistItem() {
            checklistItems.push({ text: '' });
            renderChecklistItems();
            document.body.setAttribute('data-checklist-unsaved', 'true');
            // Focus on the new input
            setTimeout(() => {
                const lastInput = document.querySelector(`input[data-index="${checklistItems.length - 1}"]`);
                if (lastInput) lastInput.focus();
            }, 0);
        }

        // Update checklist item
        function updateChecklistItem(index, value) {
            if (checklistItems[index]) {
                checklistItems[index].text = value;
            }
        }

        // Delete checklist item
        function deleteChecklistItem(index) {
            if (confirm('Are you sure you want to delete this item?')) {
                checklistItems.splice(index, 1);
                renderChecklistItems();
            }
        }

        // Move checklist item
        function moveChecklistItem(index, direction) {
            const newIndex = index + direction;
            if (newIndex >= 0 && newIndex < checklistItems.length) {
                [checklistItems[index], checklistItems[newIndex]] = [checklistItems[newIndex], checklistItems[index]];
                renderChecklistItems();
            }
        }

        // Save pricing
        function savePricing() {
            const basePrice = document.getElementById('basePrice').value;
            const priceUnit = document.getElementById('priceUnit').value;

            const packages = JSON.parse(localStorage.getItem('tailoredPackages')) || [];
            const package_ = packages.find(p => p.id === parseInt(currentPackageId));

            if (package_) {
                package_.basePrice = basePrice;
                package_.priceUnit = priceUnit;
                localStorage.setItem('tailoredPackages', JSON.stringify(packages));
                document.body.setAttribute('data-pricing-unsaved', 'false');
                showSuccessNotification('Pricing saved successfully!');
            }
        }

        // Save checklist
        function saveChecklist() {
            const packages = JSON.parse(localStorage.getItem('tailoredPackages')) || [];
            const package_ = packages.find(p => p.id === parseInt(currentPackageId));

            if (package_) {
                package_.checklist = JSON.stringify(checklistItems);
                localStorage.setItem('tailoredPackages', JSON.stringify(packages));
                document.body.setAttribute('data-checklist-unsaved', 'false');
                showSuccessNotification('Checklist saved successfully!');
            }
        }

        // Save all
        function saveAll() {
            savePricing();
            saveChecklist();
            document.getElementById('globalSaveBtn').classList.add('hidden');
        }

        // Success notification
        function showSuccessNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-8 right-8 px-6 py-3 bg-[#C5A059] text-[#12100E] font-bold rounded-lg shadow-2xl shadow-[#C5A059]/40 animate-pulse z-50';
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 2000);
        }
    </script>
</body>
</html>
