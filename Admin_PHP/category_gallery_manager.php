<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Category Gallery Manager - EDPS Studio</title>
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
                    <h1 class="text-4xl font-bold text-[#E4E0DC]" id="categoryTitle">Weddings Gallery</h1>
                </div>
                <p class="text-[#D1CDC7]">Upload, manage, and organize photos for this collection category.</p>
            </div>

            <!-- Multi-Image Upload Section -->
            <div class="bg-[#1A1614] p-8 rounded-3xl border border-[#2C1A12]">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-[#F5F5F0] mb-2">Upload Gallery Images</h2>
                    <p class="text-sm text-[#D1CDC7]">Add high-resolution photos to this collection.</p>
                </div>
                
                <!-- Upload Dropzone -->
                <div id="uploadZone" class="border-2 border-dashed border-[#C5A059]/40 rounded-lg p-12 text-center hover:border-[#C5A059]/60 hover:bg-[#2C1A12]/30 transition-all cursor-pointer bg-[#2C1A12]/10">
                    <div class="flex flex-col items-center justify-center">
                        <span class="material-symbols-outlined text-5xl text-[#C5A059] mb-3">cloud_upload</span>
                        <p class="text-[#F5F5F0] font-bold mb-1">Drag & drop images here</p>
                        <p class="text-sm text-[#D1CDC7]/60">or click to select files</p>
                        <p class="text-xs text-[#D1CDC7]/40 mt-3">Recommended: High-resolution JPG or PNG · Max 10MB each</p>
                    </div>
                    <input type="file" id="multiImageInput" accept="image/*" multiple class="hidden" onchange="handleMultipleImageUpload(event)"/>
                </div>

                <!-- Upload Progress -->
                <div id="uploadProgress" class="hidden mt-6 space-y-3">
                    <div id="progressList"></div>
                </div>
            </div>

            <!-- Gallery Management Section -->
            <div class="bg-[#1A1614] p-8 rounded-3xl border border-[#2C1A12]">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-[#F5F5F0] mb-2">Gallery Images</h2>
                    <p class="text-sm text-[#D1CDC7]">Select a thumbnail image for this category that will display on the landing page.</p>
                </div>

                <!-- Images Grid -->
                <div id="imageGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Images will be inserted here by JavaScript -->
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="text-center py-12">
                    <span class="material-symbols-outlined text-5xl text-[#C5A059]/40 mb-4 block">image</span>
                    <p class="text-[#D1CDC7] text-sm">No images uploaded yet</p>
                </div>
            </div>

            <!-- Thumbnail Preview Section -->
            <div class="bg-[#1A1614] p-8 rounded-3xl border border-[#C5A059]/30">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-[#F5F5F0] mb-2">Category Thumbnail Preview</h2>
                    <p class="text-sm text-[#D1CDC7]">This image will be displayed as the category cover on the landing page.</p>
                </div>

                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="w-full md:w-64 h-64 rounded-2xl border-3 border-[#C5A059] overflow-hidden bg-[#2C1A12] flex items-center justify-center flex-shrink-0">
                        <div id="thumbnailPreview" class="w-full h-full flex items-center justify-center text-center">
                            <div class="flex flex-col items-center">
                                <span class="material-symbols-outlined text-5xl text-[#C5A059]/40 mb-2">image_not_supported</span>
                                <p class="text-[#D1CDC7]/60 text-sm">No thumbnail selected</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059] mb-2">Selected Thumbnail</label>
                            <div id="selectedThumbnailInfo" class="bg-[#2C1A12] p-4 rounded-lg border border-[#C5A059]/20 text-[#D1CDC7]">
                                <p class="text-sm">No image selected</p>
                            </div>
                        </div>
                        <button id="clearThumbnailBtn" class="w-full px-4 py-3 bg-[#2C1A12] border border-[#C5A059]/30 rounded-lg text-[#C5A059] hover:bg-[#C5A059]/10 transition-all font-bold text-sm hidden">
                            <span class="material-symbols-outlined text-base align-middle mr-2">close</span>
                            Clear Thumbnail Selection
                        </button>
                        <button id="saveThumbnailBtn" class="w-full px-4 py-3 bg-[#C5A059] text-[#12100E] rounded-lg hover:shadow-md transition-all font-bold text-sm disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            <span class="material-symbols-outlined text-base align-middle mr-2">save</span>
                            Save Thumbnail
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Get category from URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const categoryId = urlParams.get('category');
        const categoryName = urlParams.get('name') || 'Gallery';
        
        // Update page title
        document.getElementById('categoryTitle').textContent = `← ${categoryName} Gallery`;

        // Sample gallery data (in production, this would come from the database)
        let galleryImages = [
            {
                id: 1,
                src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBRH57CvbM3V0nk7LI5Pmhb48kPrB9o7tHIcaOjEmcSJd1gE5OeDey2WTMZoro8FatD_cNSzqK9C2PdAQNrbNSl9WGky9ZFZMXNUsAdQLx46T4FcHsPuVDVv98jsQdnAtyVgMdRpYJ1RzvZRm33mbUMD2hHxC9UtpTAHQ6l_qeBg-zzJ2kCf641yDTdjbw4vk3hWrslw7bVPkrGUM4MufLLjlQoSWi29HASutasGcYd1oWcCnMv__B7pM8tkoK1o-IWwScLLIrGVg',
                isThumbnail: true,
                uploadDate: '2026-04-20'
            },
            {
                id: 2,
                src: 'https://lh3.googleusercontent.com/aida-public/AB6AXuBcrRg24L0DdHl4F3QmjM4gL32ctSJW04FL6REkcmp-cjbqX5ycl9m4jsDf1h9xDafmQwiwWDjfKra69MuzVp96CR8gG8Vyf_Nmig6Fuvb2rmHTLzt3-f9QSsZ8uKmdsSWiUk9FJ4VUdwEOwyX85ywYPGbug_-iQx152Arhpztqglyp1WbBmlaA_iqYUPFRiEcQmyVuTlEg9Y3yPQYyNNGvncOdHnkpeMKbVafSKXEcVHwX5RhGEr69nvNRK3Jar_kdsG0Lst1pCA',
                isThumbnail: false,
                uploadDate: '2026-04-18'
            }
        ];

        let selectedThumbnailId = galleryImages.find(img => img.isThumbnail)?.id || null;

        // Upload Zone Click Handler
        document.getElementById('uploadZone').addEventListener('click', () => {
            document.getElementById('multiImageInput').click();
        });

        // Drag and Drop
        const uploadZone = document.getElementById('uploadZone');
        
        uploadZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadZone.classList.add('border-[#C5A059]', 'bg-[#2C1A12]/50');
        });

        uploadZone.addEventListener('dragleave', () => {
            uploadZone.classList.remove('border-[#C5A059]', 'bg-[#2C1A12]/50');
        });

        uploadZone.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadZone.classList.remove('border-[#C5A059]', 'bg-[#2C1A12]/50');
            const files = e.dataTransfer.files;
            handleImageFiles(files);
        });

        // Handle Multiple Image Upload
        function handleMultipleImageUpload(event) {
            const files = event.target.files;
            handleImageFiles(files);
        }

        function handleImageFiles(files) {
            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const newImage = {
                            id: Date.now() + index,
                            src: e.target.result,
                            isThumbnail: false,
                            uploadDate: new Date().toISOString().split('T')[0]
                        };
                        galleryImages.push(newImage);
                        renderGallery();
                        showSuccessNotification(`Image ${index + 1} uploaded successfully!`);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Render Gallery
        function renderGallery() {
            const grid = document.getElementById('imageGrid');
            const emptyState = document.getElementById('emptyState');

            if (galleryImages.length === 0) {
                grid.innerHTML = '';
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
                grid.innerHTML = galleryImages.map(img => `
                    <div class="relative group bg-[#2C1A12] rounded-lg overflow-hidden border border-[#C5A059]/20 hover:border-[#C5A059]/50 transition-all">
                        <div class="aspect-square overflow-hidden">
                            <img src="${img.src}" alt="Gallery image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                        </div>
                        
                        <!-- Overlay on Hover -->
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-3">
                            <button class="thumbnail-btn px-4 py-2 bg-[#C5A059] text-[#12100E] rounded-lg font-bold text-sm hover:shadow-md transition-all" data-id="${img.id}">
                                ${img.isThumbnail ? '<span class="material-symbols-outlined text-base align-middle mr-2">check_circle</span>Selected' : '<span class="material-symbols-outlined text-base align-middle mr-2">radio_button_unchecked</span>Select'}
                            </button>
                            <button class="delete-btn px-4 py-2 bg-[#ff6b6b] text-white rounded-lg font-bold text-sm hover:bg-[#ff5252] transition-all" data-id="${img.id}">
                                <span class="material-symbols-outlined text-base align-middle mr-2">delete</span>Delete
                            </button>
                        </div>

                        <!-- Thumbnail Badge -->
                        ${img.isThumbnail ? `
                            <div class="absolute top-2 right-2 bg-[#C5A059] text-[#12100E] px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1">
                                <span class="material-symbols-outlined text-base">check_circle</span>
                                Thumbnail
                            </div>
                        ` : ''}

                        <div class="p-3 text-xs text-[#D1CDC7] bg-[#2C1A12]/50">
                            <p>Uploaded: ${img.uploadDate}</p>
                        </div>
                    </div>
                `).join('');

                // Attach event listeners
                document.querySelectorAll('.thumbnail-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const id = parseInt(btn.dataset.id);
                        selectThumbnail(id);
                    });
                });

                document.querySelectorAll('.delete-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const id = parseInt(btn.dataset.id);
                        deleteImage(id);
                    });
                });
            }
        }

        // Select Thumbnail
        function selectThumbnail(id) {
            galleryImages.forEach(img => img.isThumbnail = false);
            const selected = galleryImages.find(img => img.id === id);
            if (selected) {
                selected.isThumbnail = true;
                selectedThumbnailId = id;
                updateThumbnailPreview();
                renderGallery();
            }
        }

        // Update Thumbnail Preview
        function updateThumbnailPreview() {
            const preview = document.getElementById('thumbnailPreview');
            const info = document.getElementById('selectedThumbnailInfo');
            const clearBtn = document.getElementById('clearThumbnailBtn');
            const saveBtn = document.getElementById('saveThumbnailBtn');

            const selected = galleryImages.find(img => img.isThumbnail);
            if (selected) {
                preview.innerHTML = `<img src="${selected.src}" alt="Thumbnail" class="w-full h-full object-cover"/>`;
                info.innerHTML = `<p class="text-sm text-[#C5A059] font-bold">✓ Selected (Uploaded: ${selected.uploadDate})</p>`;
                clearBtn.classList.remove('hidden');
                saveBtn.disabled = false;
            } else {
                preview.innerHTML = `
                    <div class="flex flex-col items-center">
                        <span class="material-symbols-outlined text-5xl text-[#C5A059]/40 mb-2">image_not_supported</span>
                        <p class="text-[#D1CDC7]/60 text-sm">No thumbnail selected</p>
                    </div>
                `;
                info.innerHTML = '<p class="text-sm">No image selected</p>';
                clearBtn.classList.add('hidden');
                saveBtn.disabled = true;
            }
        }

        // Delete Image
        function deleteImage(id) {
            galleryImages = galleryImages.filter(img => img.id !== id);
            if (selectedThumbnailId === id) {
                selectedThumbnailId = null;
            }
            renderGallery();
            updateThumbnailPreview();
            showSuccessNotification('Image deleted successfully!');
        }

        // Back Arrow Button
        document.getElementById('backArrowBtn').addEventListener('click', () => {
            window.location.href = 'webedit.php';
        });

        // Save Thumbnail Button
        document.getElementById('saveThumbnailBtn').addEventListener('click', () => {
            if (selectedThumbnailId) {
                // In production, this would save to database
                sessionStorage.setItem(`category_${categoryId}_thumbnail`, selectedThumbnailId);
                showSuccessNotification('Thumbnail saved successfully!');
            }
        });

        // Clear Thumbnail Button
        document.getElementById('clearThumbnailBtn').addEventListener('click', () => {
            galleryImages.forEach(img => img.isThumbnail = false);
            selectedThumbnailId = null;
            renderGallery();
            updateThumbnailPreview();
            showSuccessNotification('Thumbnail cleared!');
        });

        // Success Notification
        function showSuccessNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'fixed bottom-8 right-8 px-6 py-3 bg-[#C5A059] text-[#12100E] font-bold rounded-lg shadow-2xl shadow-[#C5A059]/40 animate-pulse z-50';
            notification.textContent = message;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 2000);
        }

        // Initialize gallery on page load
        window.addEventListener('load', () => {
            renderGallery();
            updateThumbnailPreview();
        });
    </script>
</body>
</html>
