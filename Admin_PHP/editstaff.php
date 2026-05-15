<?php
require_once 'config.php';
require_once 'Database.php';
require_once 'Staff.php';

$staff = new Staff();
$message = '';

// Kunin ang ID mula sa URL (e.g., editstaff.php?id=5)
$id = $_GET['id'] ?? null;
$member = $id ? $staff->getById($id) : null;

if (!$member) {
    header('Location: staffmanage.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imagePath = $member['profile_image']; // Default ay lumang image

    // Simple Upload Logic kung may bagong picture
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === 0) {
        $targetDir = "Pictures/";
        $imagePath = $targetDir . basename($_FILES['profileImage']['name']);
        move_uploaded_file($_FILES['profileImage']['tmp_name'], $imagePath);
    }

    $updateData = [
        'name' => $_POST['fullName'],
        'email' => $_POST['email'],
        'role' => $_POST['role'],
        'profile_image' => $imagePath
    ];

    if ($staff->updateStaff($id, $updateData)) {
        header('Location: staffmanage.php?updated=1');
        exit;
    } else {
        $message = "Failed to update staff.";
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Staff | EDPS Studio</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&family=Manrope:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</head>
<body class="bg-[#12100E] font-body text-[#D1CDC7] antialiased flex min-h-screen">
    <main class="flex-1 flex flex-col items-center justify-center p-8">
        <div class="w-full max-w-xl bg-white p-10 rounded-xl shadow-lg border border-gray-100">
            <h2 class="font-['Noto_Serif'] text-3xl font-bold text-[#4a2d37] mb-8">Edit Staff Member</h2>
            
            <form method="POST" enctype="multipart/form-data" class="space-y-6">
                <div class="flex items-center gap-6 mb-8">
                    <img src="<?php echo $member['profile_image'] ?: 'https://via.placeholder.com/150'; ?>" class="w-20 h-20 rounded-full object-cover border-2 border-[#ffd9e4]">
                    <div class="flex-1">
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#6f585f] mb-2">Change Profile Picture</label>
                        <input type="file" name="profileImage" class="text-xs">
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#6f585f] mb-1">Full Name</label>
                        <input type="text" name="fullName" value="<?php echo htmlspecialchars($member['name']); ?>" class="w-full border-gray-200 rounded-lg p-3" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#6f585f] mb-1">Email</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($member['email']); ?>" class="w-full border-gray-200 rounded-lg p-3" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-widest text-[#6f585f] mb-1">Role</label>
                        <select name="role" class="w-full border-gray-200 rounded-lg p-3">
                            <option value="photographer" <?php echo $member['role'] == 'photographer' ? 'selected' : ''; ?>>Photographer</option>
                            <option value="editor" <?php echo $member['role'] == 'editor' ? 'selected' : ''; ?>>Editor</option>
                            <option value="artist" <?php echo $member['role'] == 'artist' ? 'selected' : ''; ?>>Artist</option>
                            <option value="manager" <?php echo $member['role'] == 'manager' ? 'selected' : ''; ?>>Manager</option>
                        </select>
                    </div>
                </div>

                <div class="pt-8 flex justify-between items-center">
                    <a href="staffmanage.php" class="text-[#6f585f] font-bold text-sm">Cancel</a>
                    <button type="submit" class="bg-[#4a2d37] text-white px-8 py-3 rounded-lg font-bold hover:brightness-110 transition-all">
                        Update Staff
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>