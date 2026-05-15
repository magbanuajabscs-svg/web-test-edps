<?php 
  // Dito dapat i-check muna kung valid ang token sa URL ($_GET['token']) 
  $token = $_GET['token'] ?? ''; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/><meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>New Password | EDPS Studio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background: radial-gradient(circle at 20% 20%, #e8dccb 0%, #dcc9b1 40%, #c4ac92 100%); height: 100vh; overflow: hidden; display: flex; flex-direction: column; font-family: 'Inter', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); }
    </style>
</head>
<body class="flex flex-col">
    <main class="flex-grow flex items-center justify-center p-4">
        <section class="glass-card w-full max-w-md rounded-2xl p-8 md:p-10 text-center">
            <div class="mb-6">
                <h2 class="font-serif text-2xl text-[#1A1A1A] mb-2">New Password</h2>
                <p class="text-xs text-gray-600">Please enter your new secured password.</p>
            </div>
            <form action="update-password-logic.php" method="POST" class="text-left space-y-4">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <div>
                    <label class="text-[10px] font-bold tracking-widest text-gray-500 block mb-1 uppercase">New Password</label>
                    <input class="w-full bg-white/80 border-0 rounded-md py-2.5 px-4 text-sm focus:ring-2 focus:ring-[#4A2338]" name="password" type="password" required />
                </div>
                <div>
                    <label class="text-[10px] font-bold tracking-widest text-gray-500 block mb-1 uppercase">Confirm Password</label>
                    <input class="w-full bg-white/80 border-0 rounded-md py-2.5 px-4 text-sm focus:ring-2 focus:ring-[#4A2338]" name="confirm_password" type="password" required />
                </div>
                <button class="w-full bg-[#4A2338] text-white font-medium py-3 rounded-md shadow-md text-sm mt-4 hover:bg-opacity-90" type="submit">
                    Update Password
                </button>
            </form>
        </section>
    </main>
</body>
</html>