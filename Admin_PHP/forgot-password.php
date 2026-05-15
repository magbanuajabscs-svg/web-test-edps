<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Forgot Password | EDPS Studio</title>
  <link href="https://fonts.googleapis.com" rel="preconnect"/>
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet"/>
  <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: { brand: { plum: '#4A2338', dark: '#1A1A1A' } },
          fontFamily: { serif: ['Noto Serif', 'serif'], sans: ['Inter', 'sans-serif'] }
        }
      }
    }
  </script>
  <style>
    body {
      background: radial-gradient(circle at 20% 20%, #e8dccb 0%, #dcc9b1 40%, #c4ac92 100%);
      height: 100vh;
      overflow: hidden; /* No scroll */
      display: flex;
      flex-direction: column;
      margin: 0;
      font-family: 'Inter', sans-serif;
    }
    .glass-card {
      background: rgba(255, 255, 255, 0.4);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
    }
    .logo-text { font-family: 'Noto Serif', serif; letter-spacing: 0.1em; text-transform: uppercase; }
  </style>
</head>
<body class="flex flex-col">

  <main class="flex-grow flex items-center justify-center p-4">
    <section class="glass-card w-full max-w-md rounded-2xl p-8 md:p-10 text-center">
      
      <div class="mb-6">
        <div class="w-16 h-16 bg-brand-plum/10 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8 text-brand-plum" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
          </svg>
        </div>
        <h2 class="font-serif text-2xl text-brand-dark mb-2">Reset Password</h2>
        <p class="text-xs text-gray-600 px-6">Enter your registered email address and we'll send you a link to reset your password.</p>
      </div>

      <form action="#" class="text-left space-y-5" method="POST">
        <div>
          <label class="text-[10px] font-bold tracking-widest text-gray-500 block mb-1 uppercase" for="email">Email Address</label>
          <input class="w-full bg-white/80 border-0 rounded-md py-2.5 px-4 text-sm text-gray-700 focus:ring-2 focus:ring-brand-plum focus:ring-opacity-20 transition-all" 
                 id="email" 
                 name="email" 
                 placeholder="name@edpsstudio.com" 
                 type="email" 
                 required/>
        </div>

        <button class="w-full bg-brand-plum hover:bg-opacity-90 text-white font-medium py-3 rounded-md transition-all shadow-md text-sm" type="submit">
          Send Reset Link
        </button>
      </form>

      <div class="mt-8 pt-6 border-t border-white/30 text-center">
        <a class="inline-flex items-center text-[10px] font-semibold tracking-wider text-brand-dark uppercase opacity-70 hover:opacity-100 transition-opacity" href="login.php">
          <svg class="h-3 w-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
          </svg>
          Back to Login
        </a>
      </div>
    </section>
  </main>

  <footer class="w-full max-w-7xl mx-auto px-6 py-4 flex justify-between items-center text-[10px] text-brand-dark opacity-60">
    <span class="logo-text font-bold">EDPS Studio</span>
    <p>© 2024 EDPS Studio</p>
  </footer>

</body>
</html>