<?php
require_once 'config.php';
require_once 'Database.php';
require_once 'Staff.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staff = new Staff();
    
    $imagePath = 'Pictures/default-profile.png'; // Default image
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === 0) {
        $targetDir = "Pictures/";
        $fileName = time() . '_' . basename($_FILES['profileImage']['name']);
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        }
    }

    $data = [
        'full_name' => $_POST['fullName'] ?? '',
        'email' => $_POST['email'] ?? '',
        'username' => $_POST['username'] ?? '',
        'role' => $_POST['role'] ?? '',
        'password' => password_hash('EDPS2024', PASSWORD_DEFAULT), // Initial Default Password
        'profile_image' => $imagePath,
        'created_at' => date('Y-m-d H:i:s')
    ];

    if (empty($data['full_name']) || empty($data['email']) || empty($data['username']) || empty($data['role'])) {
        $message = 'All fields are required';
        $messageType = 'error';
    } else {
        if ($staff->addStaff($data)) {
            header('Location: staffmanage.php?success=1');
            exit;
        } else {
            $message = 'Failed to register staff';
            $messageType = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>EDPS Studio Admin - Register New Staff</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              "secondary": "#6f585f", "on-surface": "#1e1b18", "surface-container-lowest": "#ffffff",
              "surface": "#fff8f3", "primary": "#4a2d37", "outline": "#817477"
            },
            fontFamily: { "headline": ["Noto Serif"], "body": ["Manrope"], "label": ["Manrope"] },
            borderRadius: {"DEFAULT": "0.125rem", "lg": "0.25rem", "xl": "0.5rem", "full": "0.75rem"},
          },
        },
      }
    </script>
<style>
    .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; display: inline-block; vertical-align: middle; }
    .editorial-shadow { box-shadow: 0 40px 80px -20px rgba(30, 27, 24, 0.04); }
</style>
</head>
<body class="bg-[#12100E] font-body text-[#D1CDC7] antialiased flex min-h-screen">

<aside class="hidden md:flex flex-col h-screen w-72 border-r border-[#2C1A12] bg-[#1A1614] py-8 px-6 sticky top-0 font-['Noto_Serif'] antialiased overflow-y-auto">
    <div class="mb-10">
        <h1 class="text-2xl font-bold tracking-tight text-[#F5F5F0]">EDPS Studio</h1>
        <p class="text-xs text-[#D1CDC7] mt-1 font-['Manrope']">Editorial Management</p>
    </div>
    <nav class="flex-1 space-y-2">
        <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors group" href="Bulletin.php">
            <span class="material-symbols-outlined text-[#C5A059]">dashboard</span>
            <span class="font-body font-medium">Dashboard</span>
        </a>
        <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors group" href="stafflist.php">
            <span class="material-symbols-outlined text-[#C5A059]">photo_library</span>
            <span class="font-body font-medium">Projects</span>
        </a>
        <a class="flex items-center gap-4 text-[#F5F5F0] font-bold border-l-4 border-[#C5A059] pl-4 py-3 bg-[#2C1A12]" href="staffmanage.php">
            <span class="material-symbols-outlined text-[#C5A059]">group</span>
            <span class="font-body font-medium">Staff Management</span>
        </a>
        <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors group" href="webedit.php">
            <span class="material-symbols-outlined text-[#C5A059]">language</span>
            <span class="font-body font-medium">Website CMS</span>
        </a>
    </nav>
    <div class="mt-auto pt-6 border-t border-[#2C1A12] space-y-1">
        <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors rounded-lg" href="settings.php">
            <span class="material-symbols-outlined text-[#C5A059]">settings</span>
            <span class="font-medium">Settings</span>
        </a>
        <a class="flex items-center gap-4 text-[#D1CDC7] pl-5 py-3 hover:bg-[#2C1A12] transition-colors group" href="login.php">
            <span class="material-symbols-outlined text-[#C5A059]">logout</span>
            <span class="font-body font-medium">Logout</span>
        </a>
    </div>
</aside>

<main class="flex-1 ml-0 min-h-screen flex flex-col">
    <header class="sticky top-0 z-40 flex justify-between items-center w-full px-8 py-4 bg-[#1A1614]/80 backdrop-blur-md text-[#F5F5F0] font-['Manrope'] font-medium border-b border-[#2C1A12]">
        <div class="flex items-center gap-4">
            <span class="md:hidden material-symbols-outlined text-2xl text-[#C5A059]">menu</span>
            <h2 class="text-lg font-bold text-[#F5F5F0]">Admin Portal</h2>
        </div>
        <div class="flex items-center gap-6">
            <div class="relative hidden sm:block">
                <span class="absolute inset-y-0 left-3 flex items-center text-[#C5A059]">
                    <span class="material-symbols-outlined text-xl">search</span>
                </span>
                <input class="bg-[#2C1A12] border border-[#2C1A12] rounded-full py-2 pl-10 pr-4 w-64 focus:ring-1 focus:ring-[#C5A059]/30 text-sm placeholder:text-[#D1CDC7] text-[#F5F5F0]" placeholder="Global search..." type="text"/>
            </div>
            <div class="flex items-center gap-4">
                <span class="material-symbols-outlined text-[#C5A059] cursor-pointer hover:opacity-70 transition-opacity p-2">notifications</span>
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

    <section class="p-8 md:p-12 lg:p-20 max-w-7xl mx-auto w-full flex items-center justify-center min-h-full">
        <div class="w-full max-w-2xl bg-[#1A1614] p-12 rounded-3xl relative overflow-hidden border border-[#2C1A12]">
            <div class="mb-10 text-center">
                <h2 class="font-['Noto_Serif'] text-4xl text-[#F5F5F0] font-bold mb-2">Register New Staff</h2>
                <p class="text-[#D1CDC7] text-sm max-w-sm mx-auto">Expand your creative collective. <br> <br>Initial password is set to <span class="font-bold text-[#C5A059]">EDPS2024</span>.</p>
            </div>

            <form class="space-y-8" method="post" enctype="multipart/form-data">
                
                <div class="flex flex-col items-center gap-4 mb-8">
                    <div class="w-24 h-24 rounded-full bg-[#2C1A12] border-2 border-dashed border-[#C5A059] flex items-center justify-center overflow-hidden relative group">
                        <img id="preview" src="Pictures/default-profile.png" class="w-full h-full object-cover hidden">
                        <span id="placeholder-icon" class="material-symbols-outlined text-[#C5A059] text-3xl">add_a_photo</span>
                        <input type="file" name="profileImage" class="absolute inset-0 opacity-0 cursor-pointer" onchange="const file = this.files[0]; if(file){ const reader = new FileReader(); reader.onload = e => { document.getElementById('preview').src = e.target.result; document.getElementById('preview').classList.remove('hidden'); document.getElementById('placeholder-icon').classList.add('hidden'); }; reader.readAsDataURL(file); }">
                    </div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-[#C5A059]">Upload Profile Photo</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059]">Full Name</label>
                        <input class="w-full bg-[#2C1A12] border border-[#2C1A12] rounded-md px-4 py-3.5 focus:ring-1 focus:ring-[#C5A059]/30 transition-all text-[#F5F5F0] placeholder:text-[#D1CDC7]" name="fullName" placeholder="e.g. Julian Thorne" required type="text"/>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059]">Professional Email</label>
                        <input class="w-full bg-[#2C1A12] border border-[#2C1A12] rounded-md px-4 py-3.5 focus:ring-1 focus:ring-[#C5A059]/30 transition-all text-[#F5F5F0] placeholder:text-[#D1CDC7]" name="email" placeholder="j.thorne@edps.studio" required type="email"/>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059]">Username</label>
                        <input class="w-full bg-[#2C1A12] border border-[#2C1A12] rounded-md px-4 py-3.5 focus:ring-1 focus:ring-[#C5A059]/30 transition-all text-[#F5F5F0] placeholder:text-[#D1CDC7]" name="username" placeholder="e.g. jthorne_edps" required type="text"/>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#C5A059]">Staff Role</label>
                        <select class="w-full bg-[#2C1A12] border border-[#2C1A12] rounded-md px-4 py-3.5 focus:ring-1 focus:ring-[#C5A059]/30 appearance-none cursor-pointer text-[#F5F5F0]" name="role" required>
                            <option disabled selected value="">Select role</option>
                            <option value="artist">Artist</option>
                            <option value="editor">Editor</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                </div>

                <div class="pt-6 flex flex-col md:flex-row gap-4 items-center justify-between">
                    <button class="text-[#D1CDC7] font-bold text-sm tracking-wide px-6 py-3 hover:text-[#F5F5F0] transition-colors" type="button" onclick="window.location.href='staffmanage.php'">Cancel</button>
                    <button class="bg-[#3E2723] text-[#C5A059] px-8 py-3.5 rounded-md font-bold text-sm tracking-wide shadow-lg hover:bg-[#4A3728] transition-all border border-[#C5A059]" type="submit">Create Staff Account</button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php if ($message): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() { alert('<?php echo addslashes($message); ?>'); });
</script>
<?php endif; ?>
</body></html>