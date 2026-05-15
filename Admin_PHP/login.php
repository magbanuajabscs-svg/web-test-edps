<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>EDPS Studio - Staff Portal</title>

  <link href="https://fonts.googleapis.com" rel="preconnect"/>
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.158.0/three.min.js"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              plum: '#301f17', // Updated color
              beige: '#F5E6D3',
              dark: '#1A1A1A',
            }
          },
          fontFamily: {
            serif: ['Noto Serif', 'serif'],
            sans: ['Inter', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <style>
    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
      background-color: #050505;
      overflow: hidden;
      font-family: 'Inter', sans-serif;
    }

    #beams-root {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
      pointer-events: none; 
    }

    .content-overlay {
      position: relative;
      z-index: 10;
      height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.07);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }

    .logo-text {
      font-family: 'Noto Serif', serif;
      letter-spacing: 0.1em;
      text-transform: uppercase;
    }

    .input-label {
      font-size: 0.7rem;
      letter-spacing: 0.05em;
      font-weight: 600;
      color: #9ca3af;
    }

    select option {
        background: #1A1A1A;
        color: white;
    }
  </style>
</head>
<body>

  <div id="beams-root"></div>

  <div class="content-overlay">
    <main class="flex-grow flex items-center justify-center p-4">
      <section class="glass-card w-full max-w-md rounded-2xl p-6 md:p-10 text-center">
        
        <div class="mb-4">
          <h1 class="logo-text text-3xl font-bold text-white leading-none">EDPS</h1>
          <p class="logo-text text-[10px] font-medium tracking-widest text-white opacity-80 mt-1">STUDIO</p>
        </div>

        <div class="mb-6">
          <h2 class="font-serif text-2xl text-white mb-1">Staff Portal</h2>
          <p class="text-xs italic text-gray-400 font-serif">Capturing the Soul</p>
        </div>

        <form action="login-logic.php" class="text-left space-y-4" method="POST">
          <div>
            <label class="input-label block mb-1" for="role">SELECT YOUR ROLE</label>
            <div class="relative">
              <select name="role" class="w-full bg-white/10 border border-white/10 rounded-md py-2 px-4 text-sm text-white focus:ring-2 focus:ring-brand-plum appearance-none" id="role">
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
              </select>
            </div>
          </div>

          <div>
            <label class="input-label block mb-1" for="username">EMAIL OR USERNAME</label>
            <input name="username" class="w-full bg-white/10 border border-white/10 rounded-md py-2 px-4 text-sm text-white focus:ring-2 focus:ring-brand-plum" id="username" type="text" required />
          </div>

          <div class="relative">
            <label class="input-label block mb-1" for="password">PASSWORD</label>
            <div class="relative">
              <input name="password" class="w-full bg-white/10 border border-white/10 rounded-md py-2 px-4 text-sm text-white focus:ring-2 focus:ring-brand-plum" id="password" type="password" required />
              <button class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400" type="button" id="togglePass">
                <span class="material-symbols-outlined text-lg" id="eyeIcon">visibility</span>
              </button>
            </div>
          </div>

          <div class="pt-2">
            <button class="w-full bg-brand-plum hover:bg-opacity-90 text-white font-medium py-2.5 rounded-md transition-all shadow-lg active:scale-[0.98]" type="submit">
              Sign In
            </button>
          </div>
        </form>

        <div class="mt-8">
          <a class="inline-flex items-center text-[10px] font-semibold tracking-wider text-white uppercase opacity-70 hover:opacity-100 transition-opacity" href="index.php">
            Back to Public Website
          </a>
        </div>
      </section>
    </main>

    <footer class="w-full max-w-7xl mx-auto px-6 py-4 flex flex-row justify-between items-center text-[10px] text-white opacity-40 border-t border-white/10">
      <span class="logo-text font-bold">EDPS Studio</span>
      <p>© 2024 EDPS Studio. Capturing the Soul.</p>
    </footer>
  </div>

  <script type="text/babel">
    const { useEffect, useRef } = React;

    const BeamsBackground = () => {
      const mountRef = useRef(null);

      useEffect(() => {
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
        
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        mountRef.current.appendChild(renderer.domElement);

        const beams = [];
        const beamCount = 6;
        // Updated beam colors to match #301f17 theme
        const colors = [0x301f17, 0x1a110d, 0x473229, 0x1A1A1A];

        for (let i = 0; i < beamCount; i++) {
          const geometry = new THREE.CylinderGeometry(.05, 1.5, 25, 32, 1, true);
          const material = new THREE.MeshBasicMaterial({
            color: colors[i % colors.length],
            transparent: true,
            opacity: 0.3,
            side: THREE.DoubleSide,
            blending: THREE.AdditiveBlending
          });
          
          const beam = new THREE.Mesh(geometry, material);
          
          beam.position.x = (Math.random() - 0.5) * 15;
          beam.position.z = -2 - (Math.random() * 5);
          beam.rotation.z = (Math.random() - 0.5) * Math.PI * 0.2;
          
          scene.add(beam);
          beams.push({
            mesh: beam,
            speed: 0.002 + Math.random() * 0.005,
            offset: Math.random() * Math.PI * 2
          });
        }

        camera.position.z = 8;

        const animate = () => {
          requestAnimationFrame(animate);
          const time = Date.now() * 0.001;
          
          beams.forEach((b, i) => {
            b.mesh.position.y = Math.sin(time + b.offset) * 0.5;
            b.mesh.rotation.y += b.speed;
            b.mesh.material.opacity = 0.2 + Math.sin(time * 0.5 + b.offset) * 0.1;
          });

          renderer.render(scene, camera);
        };

        animate();

        const handleResize = () => {
          const width = window.innerWidth;
          const height = window.innerHeight;
          camera.aspect = width / height;
          camera.updateProjectionMatrix();
          renderer.setSize(width, height);
        };

        window.addEventListener('resize', handleResize);

        return () => {
          window.removeEventListener('resize', handleResize);
          if (mountRef.current) mountRef.current.removeChild(renderer.domElement);
          scene.clear();
          renderer.dispose();
        };
      }, []);

      return <div ref={mountRef} className="w-full h-full" />;
    };

    const root = ReactDOM.createRoot(document.getElementById('beams-root'));
    root.render(<BeamsBackground />);
  </script>

  <script>
    document.getElementById('togglePass').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.textContent = "visibility_off";
      } else {
        passwordInput.type = "password";
        eyeIcon.textContent = "visibility";
      }
    });
  </script>

</body>
</html>