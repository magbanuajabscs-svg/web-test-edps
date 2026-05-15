<?php
require_once 'config.php';
require_once 'Database.php';

// Session check
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$db = Database::getInstance();
$staffId = $_SESSION['user_id'];

// Fetch current logged-in user's data from staff table
$staffQuery = "SELECT id, name, username, first_name, last_name, email, role, phone, profile_image, is_email_verified FROM staff WHERE id = ?";
$staffData = $db->fetch($staffQuery, [$staffId]);

// Initialize all variables with null coalescing operator to prevent undefined variable warnings
$staffName = $staffData['name'] ?? $_SESSION['username'] ?? '';
$staffUsername = $staffData['username'] ?? $_SESSION['username'] ?? '';
$staffFirstName = $staffData['first_name'] ?? '';
$staffLastName = $staffData['last_name'] ?? '';
$staffEmail = $staffData['email'] ?? '';
$staffPhone = $staffData['phone'] ?? '';
$staffRole = $staffData['role'] ?? 'Staff Member';
$staffImg = (!empty($staffData['profile_image'])) ? $staffData['profile_image'] : 'assets/images/default-profile.png';
$isEmailVerified = $staffData['is_email_verified'] ?? false;

// Handle form submission for profile update
$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $newName = isset($_POST['full_name']) ? trim($_POST['full_name']) : $staffName;
    $newEmail = isset($_POST['email']) ? trim($_POST['email']) : $staffEmail;

    $uploadedPath = null;

    // Handle direct file upload
    if (!empty($_FILES['profile_image']) && ($_FILES['profile_image']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['profile_image'];
        if ($file['error'] === UPLOAD_ERR_OK) {
            if ($file['size'] <= 2 * 1024 * 1024) {
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime = $finfo->file($file['tmp_name']);
                $ext = null;
                switch ($mime) {
                    case 'image/jpeg': $ext = 'jpg'; break;
                    case 'image/png': $ext = 'png'; break;
                    case 'image/gif': $ext = 'gif'; break;
                }
                if ($ext) {
                    if (!is_dir(UPLOAD_PATH)) mkdir(UPLOAD_PATH, 0755, true);
                    $filename = 'profile_' . $staffId . '_' . time() . '.' . $ext;
                    $destFull = rtrim(UPLOAD_PATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $filename;
                    if (move_uploaded_file($file['tmp_name'], $destFull)) {
                        // store web-accessible relative path
                        $uploadedPath = 'Pictures/' . $filename;
                    }
                } else {
                    $errorMessage = 'Unsupported image type. Use JPG, PNG, or GIF.';
                }
            } else {
                $errorMessage = 'Image too large. Max 2MB allowed.';
            }
        } else {
            $errorMessage = 'Error uploading file.';
        }
    }

    // If no direct file but a temporary data URL exists in session, decode and save it
    if (empty($uploadedPath) && !empty($_SESSION['profile_image']) && is_string($_SESSION['profile_image'])) {
        $dataUrl = $_SESSION['profile_image'];
        if (preg_match('#^data:image/(png|jpe?g|gif);base64,(.+)$#i', $dataUrl, $m)) {
            $ext = strtolower($m[1]) === 'jpeg' ? 'jpg' : strtolower($m[1]);
            $b64 = $m[2];
            $bin = base64_decode($b64);
            if ($bin !== false) {
                if (!is_dir(UPLOAD_PATH)) mkdir(UPLOAD_PATH, 0755, true);
                $filename = 'profile_' . $staffId . '_' . time() . '.' . $ext;
                $destFull = rtrim(UPLOAD_PATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $filename;
                if (file_put_contents($destFull, $bin) !== false) {
                    $uploadedPath = 'Pictures/' . $filename;
                    // clear temporary preview from session
                    unset($_SESSION['profile_image']);
                }
            }
        }
    }

    // Build update query
    if ($uploadedPath) {
        $updateQuery = "UPDATE staff SET name = ?, email = ?, profile_image = ? WHERE id = ?";
        $params = [$newName, $newEmail, $uploadedPath, $staffId];
    } else {
        $updateQuery = "UPDATE staff SET name = ?, email = ? WHERE id = ?";
        $params = [$newName, $newEmail, $staffId];
    }

    $updateResult = $db->execute($updateQuery, $params);

    if ($updateResult) {
        $successMessage = 'Profile updated successfully!';
        $staffName = $newName;
        $staffEmail = $newEmail;
        $_SESSION['username'] = $newName;
        if ($uploadedPath) {
            $_SESSION['profile_image'] = $uploadedPath;
            $staffImg = $uploadedPath;
        }
    } else {
        if (empty($errorMessage)) $errorMessage = 'Failed to update profile. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Staff Settings | EDPS Studio</title>
    <style>html:not(.dark) body { background-color: #FFF8F3; color: #2D141D; } html.dark body { background-color: #12100E; color: #D1CDC7; } .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }</style>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&family=Manrope:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            colors: {
              "primary": "#4a2d37",
              "secondary": "#6f585f",
              "surface": "#fff8f3",
              "surface-container-low": "#f9f2ed",
              "surface-container-highest": "#e8e1dc",
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .glass-nav { background: rgba(255, 248, 243, 0.8); backdrop-filter: blur(12px); }
        .dark .glass-nav { background: rgba(26, 22, 20, 0.8); }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .page-transition {
            animation: fadeIn 0.4s ease-out forwards;
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
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        @media (max-width: 640px) {
            h1, h2, h3, h4, h5, h6 { font-size: calc(1em * 0.8); }
            body { font-size: 14px; }
        }
    </style>
</head>
<body class="bg-[#FFF8F3] dark:bg-[#12100E] font-body text-[#2D141D] dark:text-[#D1CDC7] antialiased flex min-h-screen transition-colors duration-300 page-transition">

<aside class="hidden md:flex flex-col h-screen w-64 md:w-72 border-r bg-[#FFF8F3] dark:bg-[#1A1614] dark:border-[#2C1A12] py-8 px-6 sticky top-0 overflow-y-auto transition-colors duration-300">
    <div class="mb-10">
        <h1 class="text-2xl font-bold font-headline text-[#2D141D] dark:text-[#F5F5F0]">EDPS Studio</h1>
        <p class="text-xs text-[#745C63] dark:text-[#D1CDC7] mt-1">Staff Portal</p>
    </div>
    <nav class="flex-1 space-y-2">
        <a class="flex items-center gap-4 text-[#745C63] dark:text-[#D1CDC7] pl-5 py-3 hover:bg-[#F9F2ED] dark:hover:bg-[#2C1A12] transition-colors rounded-lg" href="staff-dashboard.php">
            <span class="material-symbols-outlined">home</span>
            <span class="font-medium">Home</span>
        </a>
        <a class="flex items-center gap-4 text-[#745C63] dark:text-[#D1CDC7] pl-5 py-3 hover:bg-[#F9F2ED] dark:hover:bg-[#2C1A12] transition-colors rounded-lg" href="staff-projects.php">
            <span class="material-symbols-outlined">check_box</span>
            <span class="font-medium">My Projects</span>
        </a>
    </nav>
    <div class="mt-auto pt-6 border-t border-[#D2C3C6] dark:border-[#2C1A12] space-y-1">
        <a class="flex items-center gap-4 text-[#2D141D] dark:text-[#C5A059] font-bold border-l-4 border-[#D2C3C6] dark:border-[#C5A059] pl-4 py-3 bg-[#F9F2ED] dark:bg-[#2C1A12]" href="staff-settings.php">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">settings</span>
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
                    <img id="headerProfileImg" class="w-full h-full object-cover" src="<?php echo htmlspecialchars($staffImg); ?>" alt="Profile"/>
                </div>
            </a>
        </div>
    </header>

    <div class="p-4 sm:p-8 md:p-12 lg:p-20 max-w-4xl mx-auto w-full pb-28">
        <h2 class="text-2xl sm:text-3xl font-headline font-bold text-[#2D141D] dark:text-[#F5F5F0] mb-6">Settings</h2>
        
        <?php if (!empty($successMessage)): ?>
            <div class="mb-6 p-4 bg-green-100/20 dark:bg-green-900/20 border border-green-400/50 dark:border-green-600/50 rounded-2xl">
                <p class="text-green-700 dark:text-green-400 font-label text-sm"><?php echo htmlspecialchars($successMessage); ?></p>
            </div>
        <?php endif; ?>
        <?php if (!empty($errorMessage)): ?>
            <div class="mb-4 p-4 bg-red-100/20 dark:bg-red-900/20 border border-red-400/50 dark:border-red-600/50 rounded-2xl">
                <p class="text-red-700 dark:text-red-400 font-label text-sm"><?php echo htmlspecialchars($errorMessage); ?></p>
            </div>
        <?php endif; ?>

        <!-- Account Information Section -->
        <details id="account-info" class="mb-0 group">
            <summary class="cursor-pointer w-full block">
                <div class="flex items-center justify-between py-3">
                        <h3 class="text-lg font-headline font-bold text-[#2D141D] dark:text-[#F5F5F0]">Account Information</h3>
                    <span class="chevron-icon material-symbols-outlined text-[#745C63] dark:text-[#C5A059]">expand_more</span>
                </div>
            </summary>

            <div class="pb-4">
                <form method="POST" enctype="multipart/form-data" id="profileForm" class="space-y-4">
                    <!-- Profile Photo Upload -->
                    <div class="flex flex-col items-center py-4 border-b border-[#D2C3C6] dark:border-[#2C1A12]">
                        <div class="relative group cursor-pointer mb-3">
                            <div class="w-20 h-20 rounded-full overflow-hidden bg-primary dark:bg-[#C5A059] flex items-center justify-center flex-shrink-0 shadow-md">
                                <img id="profilePreview" class="w-full h-full object-cover" src="<?php echo htmlspecialchars($staffImg); ?>" alt="<?php echo htmlspecialchars($staffName); ?>"/>
                            </div>
                            <div class="absolute inset-0 rounded-full bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-xl">edit</span>
                            </div>
                            <input type="file" id="profileImageInput" name="profile_image" accept="image/*" class="hidden" onchange="previewImage(event)"/>
                        </div>
                        <button type="button" onclick="document.getElementById('profileImageInput').click()" class="text-xs text-[#C5A059] hover:text-[#D4AF5A] transition-colors font-medium">Change Photo</button>
                        <p class="text-xs text-[#745C63] dark:text-[#D1CDC7] mt-1">JPG, PNG or GIF (Max 2MB)</p>
                    </div>
                    <!-- First Name & Last Name -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-[#745C63] dark:text-[#F5F5F0] font-label">First Name</label>
                            <input
                                type="text"
                                name="first_name"
                                class="w-full bg-[#F4EDE8] dark:bg-[#2C1A12] dark:text-[#F5F5F0] text-[#2D141D] py-2 px-3 border border-[#D2C3C6] dark:border-[#3E2723] rounded-lg focus:border-[#C5A059] focus:outline-none transition-colors font-label text-sm"
                                value="<?php echo htmlspecialchars($staffFirstName); ?>"
                            />
                        </div>
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-[#745C63] dark:text-[#F5F5F0] font-label">Last Name</label>
                            <input
                                type="text"
                                name="last_name"
                                class="w-full bg-[#F4EDE8] dark:bg-[#2C1A12] dark:text-[#F5F5F0] text-[#2D141D] py-2 px-3 border border-[#D2C3C6] dark:border-[#3E2723] rounded-lg focus:border-[#C5A059] focus:outline-none transition-colors font-label text-sm"
                                value="<?php echo htmlspecialchars($staffLastName); ?>"
                            />
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-primary light:text-[#12100E] dark:text-[#F5F5F0] font-label">Username</label>
                        <input
                            type="text"
                            name="username"
                            class="w-full bg-[#F4EDE8] dark:bg-[#2C1A12] dark:text-[#F5F5F0] text-[#2D141D] py-2 px-3 border border-[#D2C3C6] dark:border-[#3E2723] rounded-lg focus:border-[#C5A059] focus:outline-none transition-colors font-label text-sm"
                            value="<?php echo htmlspecialchars($staffUsername); ?>"
                        />
                    </div>

                    <!-- Email (Read-Only) -->
                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 font-label">
                            Email Address
                            <span class="material-symbols-outlined text-xs align-middle ml-1" style="font-variation-settings: 'FILL' 1;">lock</span>
                        </label>
                        <input
                            type="email"
                            disabled
                            class="w-full bg-transparent text-gray-500 dark:text-gray-400 py-2 px-3 border border-gray-300 light:border-gray-300 dark:border-[#4A3B32]/50 rounded-lg cursor-not-allowed font-label text-sm opacity-60"
                            value="<?php echo htmlspecialchars($staffEmail); ?>"
                        />
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Admin-assigned. Contact administrator to change.</p>
                    </div>

                    <!-- Contact Number -->
                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-primary light:text-[#12100E] dark:text-[#F5F5F0] font-label">Contact Number</label>
                        <input
                            type="tel"
                            name="phone"
                            class="w-full bg-transparent dark:text-[#F5F5F0] light:text-[#12100E] py-2 px-3 border border-gray-300 light:border-gray-300 dark:border-[#4A3B32] rounded-lg focus:border-[#C5A059] focus:outline-none transition-colors font-label text-sm"
                            value="<?php echo htmlspecialchars($staffPhone); ?>"
                        />
                    </div>



                    <!-- Action Buttons -->
                    <div class="flex justify-end items-center gap-2 pt-4 border-t border-[#D2C3C6] dark:border-[#2C1A12]">
                        <button type="reset" class="text-[#745C63] dark:text-[#D1CDC7] font-bold text-xs uppercase tracking-widest hover:opacity-70 transition-opacity font-label px-3 py-2">Discard</button>
                        <button type="submit" name="update_profile" class="bg-[#C5A059] text-[#12100E] px-4 py-2 rounded-lg shadow-lg hover:scale-[1.02] active:scale-95 transition-all font-bold text-xs uppercase tracking-widest flex items-center gap-1 font-label">
                            Update
                            <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        </button>
                    </div>
                </form>
            </div>
        </details>

        <!-- Divider -->
        <hr class="border-gray-300 light:border-gray-300 dark:border-[#2C1A12] my-2">

        <!-- Account Security Section -->
        <details class="mb-0 group">
            <summary class="cursor-pointer w-full block">
                <div class="flex items-center justify-between py-3">
                    <h3 class="text-lg font-headline font-bold text-primary dark:text-[#F5F5F0]">Account Security</h3>
                    <span class="chevron-icon material-symbols-outlined text-primary dark:text-[#C5A059]">expand_more</span>
                </div>
            </summary>

            <div class="pb-4 space-y-4">
                <!-- Email Verification Warning (if not verified) -->
                <?php if (!$isEmailVerified): ?>
                    <div class="p-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-700/50 rounded-lg">
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-amber-600 dark:text-amber-400 flex-shrink-0 text-sm mt-0.5">warning</span>
                            <div class="flex-1">
                                <h5 class="font-bold text-amber-800 dark:text-amber-300 mb-1 text-xs">Email Not Verified</h5>
                                <p class="text-xs text-amber-700 dark:text-amber-200 mb-2">Please verify your email address to unlock additional security features.</p>
                                <form method="POST" class="inline">
                                    <button type="submit" name="send_verification_email" class="bg-amber-600 hover:bg-amber-700 text-white px-3 py-1 rounded text-xs font-bold transition-colors">
                                        Send Verification Email
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Email Verified Badge -->
                    <div class="p-3 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700/50 rounded-lg">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-green-600 dark:text-green-400 text-sm" style="font-variation-settings: 'FILL' 1;">verified</span>
                            <p class="text-green-700 dark:text-green-300 font-medium text-xs">Email Verified</p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Change Password Form (Always Visible) -->
                <form method="POST" id="passwordForm" class="space-y-3">
                    <div class="space-y-1">
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-primary light:text-[#12100E] dark:text-[#F5F5F0] font-label">Current Password</label>
                        <input
                            type="password"
                            name="current_password"
                            class="w-full bg-transparent dark:text-[#F5F5F0] light:text-[#12100E] py-2 px-3 border border-gray-300 light:border-gray-300 dark:border-[#4A3B32] rounded-lg focus:border-[#C5A059] focus:outline-none transition-colors font-label text-sm"
                            placeholder="Enter your current password"
                        />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-primary light:text-[#12100E] dark:text-[#F5F5F0] font-label">New Password</label>
                            <input
                                type="password"
                                name="new_password"
                                class="w-full bg-transparent dark:text-[#F5F5F0] light:text-[#12100E] py-2 px-3 border border-gray-300 light:border-gray-300 dark:border-[#4A3B32] rounded-lg focus:border-[#C5A059] focus:outline-none transition-colors font-label text-sm"
                                placeholder="Enter new password"
                            />
                        </div>

                        <div class="space-y-1">
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-primary light:text-[#12100E] dark:text-[#F5F5F0] font-label">Confirm Password</label>
                            <input
                                type="password"
                                name="confirm_password"
                                class="w-full bg-transparent dark:text-[#F5F5F0] light:text-[#12100E] py-2 px-3 border border-gray-300 light:border-gray-300 dark:border-[#4A3B32] rounded-lg focus:border-[#C5A059] focus:outline-none transition-colors font-label text-sm"
                                placeholder="Confirm new password"
                            />
                        </div>
                    </div>

                    <p class="text-xs text-gray-600 dark:text-gray-400">Password must be at least 8 characters long and contain a mix of uppercase, lowercase, numbers, and special characters.</p>

                    <div class="flex justify-end pt-2">
                        <button type="submit" name="change_password" class="bg-[#C5A059] text-[#12100E] px-4 py-2 rounded-lg shadow-lg hover:scale-[1.02] active:scale-95 transition-all font-bold text-xs uppercase tracking-widest flex items-center gap-1 font-label">
                            Update Password
                            <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                        </button>
                    </div>
                </form>
            </div>
        </details>

        <!-- Divider -->
        <hr class="border-gray-300 light:border-gray-300 dark:border-[#2C1A12] my-4">

        <!-- Dark Mode Toggle -->
        <input type="checkbox" id="darkModeCheckbox" class="hidden" />
        <label for="darkModeCheckbox" class="flex items-center justify-between py-3 cursor-pointer">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-[#C5A059] text-base dark:text-[#C5A059] light:text-[#1A1614]" style="font-variation-settings: 'FILL' 0; font-size: 28px;">dark_mode</span>
                <span class="text-primary dark:text-[#F5F5F0] font-medium text-sm">Dark Mode</span>
            </div>
            <div class="relative inline-flex items-center">
                <span id="darkToggleVisual" class="relative inline-block h-6 w-11 rounded-full bg-gray-400 transition-colors">
                    <span id="toggleDot" class="absolute left-1 top-1/2 h-5 w-5 rounded-full bg-white shadow-lg transition-transform" style="transform: translate(0, -50%);"></span>
                </span>
            </div>
        </label>

        <!-- Divider -->
        <hr class="border-gray-300 light:border-gray-300 dark:border-[#2C1A12] my-4">

        <!-- Logout Row -->
        <a href="login.php" class="flex items-center justify-between py-3 w-full hover:opacity-90 transition-opacity" onclick="handlePageTransition(event)">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-[#E57373] text-base dark:text-[#E57373] light:text-[#8B0000]" style="font-variation-settings: 'FILL' 0; font-size: 28px;">logout</span>
                <span class="text-primary dark:text-[#F5F5F0] font-medium hover:text-[#E57373] transition-colors text-sm">Logout</span>
            </div>
            <span class="material-symbols-outlined text-[#E57373] text-sm" style="font-variation-settings: 'FILL' 0;">chevron_right</span>
        </a>
        </div>
    </div>
    <!-- Bottom Navigation Bar (Mobile Only) -->
    <nav class="fixed md:hidden bottom-0 w-full z-50 bg-[#FFF8F3]/90 dark:bg-[#1A1614]/80 backdrop-blur-md border-t border-[#D2C3C6] dark:border-[#2C1A12] flex items-center py-3 pb-[calc(0.75rem+env(safe-area-inset-bottom)))]">
        <a href="staff-dashboard.php" class="flex-1 flex flex-col items-center justify-center text-[#745C63] dark:text-[#D1CDC7] hover:text-[#C5A059] transition-colors active:scale-95 duration-200">
            <span class="material-symbols-outlined text-2xl">home</span>
        </a>
        <a href="staff-projects.php" class="flex-1 flex flex-col items-center justify-center text-[#745C63] dark:text-[#D1CDC7] hover:text-[#C5A059] transition-colors active:scale-95 duration-200">
            <span class="material-symbols-outlined text-2xl">check_box</span>
        </a>
        <a href="staff-settings.php#account-info" class="flex-1 flex flex-col items-center justify-center text-[#745C63] dark:text-[#D1CDC7] hover:text-[#C5A059] transition-colors active:scale-95 duration-200">
            <span class="material-symbols-outlined text-2xl" style="font-variation-settings: 'FILL' 1;">settings</span>
        </a>
    </nav>
</main>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePreview').src = e.target.result;
                // Persist temporary preview to session so other pages show the preview
                try {
                    fetch('api/staff.php?action=set_temp_profile', {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ data: e.target.result })
                    }).then(res => res.json()).then(json => { if (!json.success) console.error('Temp profile set failed', json.message); }).catch(err => console.error(err));
                } catch (err) { console.error(err); }
                // Also update header avatar on this page immediately
                try {
                    const hdr = document.getElementById('headerProfileImg');
                    if (hdr) hdr.src = e.target.result;
                } catch (err) { /* ignore */ }
            };
            reader.readAsDataURL(file);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const html = document.documentElement;
        const darkModeCheckbox = document.getElementById('darkModeCheckbox');
        const darkToggleVisual = document.getElementById('darkToggleVisual');
        const toggleDot = document.getElementById('toggleDot');
        const staffId = <?php echo intval($staffId); ?>;

        // Ensure anchored content is not hidden behind the sticky header.
        // Measure the header height and apply it as scroll-padding and scroll-margin dynamically.
        function updateScrollPadding() {
            const header = document.querySelector('header.sticky') || document.querySelector('header');
            const headerHeight = header ? header.offsetHeight : 0;
            // Use scroll-padding-top to offset browser native scrolling to anchors
            document.documentElement.style.scrollPaddingTop = headerHeight + 'px';
            // Also set scroll-margin-top on anchorable sections for good measure
            document.querySelectorAll('[id]').forEach(el => {
                el.style.scrollMarginTop = (headerHeight + 8) + 'px';
            });
        }
        updateScrollPadding();
        window.addEventListener('resize', updateScrollPadding);

        // Initialize theme from database or localStorage
        const savedTheme = localStorage.getItem('staffPortalTheme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        const shouldBeDark = savedTheme === 'dark' || (savedTheme === null && prefersDark);
        darkModeCheckbox.checked = shouldBeDark;
        html.classList.toggle('dark', shouldBeDark);
        updateToggleStyle(shouldBeDark);

        function updateToggleStyle(isDark) {
            // Toggle background color
            if (isDark) {
                darkToggleVisual.classList.remove('bg-gray-400');
                darkToggleVisual.classList.add('bg-[#C5A059]');
            } else {
                darkToggleVisual.classList.remove('bg-[#C5A059]');
                darkToggleVisual.classList.add('bg-gray-400');
            }

            // Compute pixel-perfect horizontal offset so the dot centers inside the track
            try {
                const trackWidth = darkToggleVisual.clientWidth; // px
                const dotWidth = toggleDot.clientWidth; // px
                const sideGap = 8; // total horizontal padding (left+right) in px (approx 4px each)
                const offset = Math.max(0, trackWidth - dotWidth - sideGap);
                if (isDark) {
                    // move to right: translate by offset (preserve vertical center)
                    toggleDot.style.transform = `translate(${offset}px, -50%)`;
                } else {
                    // left position
                    toggleDot.style.transform = `translate(0, -50%)`;
                }
            } catch (e) {
                // fallback to simple transforms
                toggleDot.style.transform = isDark ? 'translateX(1.25rem)' : 'translateX(0)';
            }
        }

        darkModeCheckbox?.addEventListener('change', function() {
            const isDark = this.checked;
            html.classList.toggle('dark', isDark);
            updateToggleStyle(isDark);
            localStorage.setItem('staffPortalTheme', isDark ? 'dark' : 'light');

            // Persist to database
            fetch('api/staff.php?action=update_theme', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ staff_id: staffId, theme_preference: isDark ? 'dark' : 'light' })
            })
            .then(r => r.json())
            .then(data => { if (!data.success) console.error('Failed to update theme:', data.message); })
            .catch(err => console.error('Error updating theme:', err));
        });

        // If URL hash points to account-info, open that details tag
        if (window.location.hash === '#account-info') {
            const el = document.getElementById('account-info');
            if (el && !el.hasAttribute('open')) el.setAttribute('open', '');
            // Ensure the expanded section is visible (account for sticky header)
            setTimeout(() => { el?.scrollIntoView({ behavior: 'auto', block: 'start' }); }, 40);
        }

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

        // Page transition handler to smooth navigation
        window.handlePageTransition = function(event) {
            const target = event.target.closest('a');
            if (target) {
                const href = target.getAttribute('href');
                if (href && !href.startsWith('#') && !href.startsWith('javascript:')) {
                    event.preventDefault();
                    document.body.style.transition = 'opacity 0.3s ease';
                    document.body.style.opacity = '0';
                    setTimeout(() => {
                        window.location.href = href;
                    }, 300);
                }
            }
        };

        // Add page transition listeners to all navigation links
        document.querySelectorAll('a:not([data-no-transition])').forEach(link => {
            if (!link.getAttribute('href')?.startsWith('#')) {
                link.addEventListener('click', handlePageTransition);
            }
        });

        // Confirmation dialogs for update actions
        document.getElementById('profileForm')?.addEventListener('submit', function(e){
            var ok = confirm('Are you sure you want to update your profile information?');
            if (!ok) e.preventDefault();
        });

        document.getElementById('passwordForm')?.addEventListener('submit', function(e){
            var ok = confirm('Are you sure you want to change your password? Make sure your current password is correct.');
            if (!ok) e.preventDefault();
        });
    });
</script>

</body>
</html>
