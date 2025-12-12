<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Darion Finance - Login</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- DARION DASHBOARD FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- p5.js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.7.0/p5.min.js"></script>

    <!-- Custom Tailwind Config with Darion Colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'darion-bg': '#090c10',
                        'darion-panel': '#161b22',
                        'darion-primary': '#2C7446',
                        'darion-primary-light': '#4a9e86',
                        'darion-slate': '#5e7a7d',
                        'darion-text': '#ffffff',
                        'darion-text-muted': '#8b949e',
                        'darion-gold': '#d4a94e',
                        'darion-red': '#c94646',
                        'darion-glass': 'rgba(22, 27, 34, 0.7)',
                        'darion-border': 'rgba(255, 255, 255, 0.1)',
                    },
                    borderRadius: {
                        'darion-lg': '16px',
                        'darion-sm': '8px',
                    },
                    backdropBlur: {
                        'darion': '10px',
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS for Darion Effects -->
    <style>
        /* Darion Background Effects */
        .darion-bg-effect {
            background-color: #090c10;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(44, 116, 70, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(94, 122, 125, 0.1) 0%, transparent 40%);
            min-height: 100vh;
        }

        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(22, 27, 34, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Logo Stipple Effect */
        .logo-stipple {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: radial-gradient(circle, #fff 20%, transparent 21%), #161b22;
            background-size: 3px 3px;
            border: 1px solid rgba(255,255,255,0.3);
        }

        /* Input field styling */
        .darion-input {
            background: rgba(22, 27, 34, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .darion-input:focus {
            outline: none;
            border-color: rgba(74, 158, 134, 0.5);
            box-shadow: 0 0 0 2px rgba(74, 158, 134, 0.2);
        }

        /* Video container styling */
        .video-container {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(44, 116, 70, 0.3), rgba(74, 158, 134, 0.2));
            mix-blend-mode: overlay;
            pointer-events: none;
        }

        /* Smooth transitions */
        * {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="darion-bg-effect text-darion-text font-inter">

<!-- NAVBAR -->
<nav class="flex items-center justify-between px-6 py-4 bg-darion-panel/70 backdrop-blur-darion fixed top-0 left-0 right-0 z-50 border-b border-darion-border">
    <div class="flex items-center gap-3">
        <div class="logo-stipple"></div>
        <a href="index.php?page=home" class="text-2xl font-light tracking-tight">Darion Finance</a>
    </div>

    <div class="hidden md:flex gap-6 font-medium">
        <a href="index.php?page=register" class="px-4 py-2 rounded-darion-sm hover:bg-darion-glass hover:text-darion-primary-light transition-colors">
            Register
        </a>
        <a href="index.php?page=login" class="px-4 py-2 rounded-darion-sm bg-darion-glass text-darion-primary-light border-l-2 border-darion-primary">
            Login
        </a>
    </div>
</nav>

<div class="h-20"></div>

<!-- SPLIT LAYOUT -->
<div class="flex min-h-[75vh] px-4 lg:px-8">
    
    <!-- LEFT SIDE: LOGIN FORM -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-4 lg:px-12">
        <div class="w-full max-w-md mx-auto">
            <!-- Logo in header -->
            <div class="flex items-center justify-center gap-3 mb-8">
                <div class="logo-stipple"></div>
                <h2 class="text-3xl font-light">Welcome Back</h2>
            </div>

            <!-- Login Box -->
            <div class="glass-card shadow-2xl rounded-darion-lg p-8 border border-darion-border">
                <h3 class="text-xl font-medium mb-6 text-center text-darion-text-muted">Sign in to your account</h3>

                <form action="index.php?page=login" method="POST" class="space-y-5">
                    <input type="hidden" name="action" value="login">
                    <input type="hidden" name="role" value="user">

                    <div class="space-y-3">
                        <label class="font-medium text-sm text-darion-text-muted">Email Address</label>
                        <input type="email" name="email" required
                               class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50"
                               placeholder="you@example.com">
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <label class="font-medium text-sm text-darion-text-muted">Password</label>
                            <a href="#" class="text-xs text-darion-primary-light hover:text-darion-primary transition-colors">
                                Forgot password?
                            </a>
                        </div>
                        <input type="password" name="password" required
                               class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50"
                               placeholder="Enter your password">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="mr-2 rounded darion-input">
                        <label for="remember" class="text-sm text-darion-text-muted">Remember me for 30 days</label>
                    </div>

                    <button
                        class="w-full bg-gradient-to-r from-darion-primary to-darion-primary-light text-white py-3.5 rounded-darion-sm font-medium hover:opacity-90 transition-all duration-300 mt-2 shadow-lg">
                        Sign In
                    </button>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-darion-border"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-darion-panel/70 text-darion-text-muted">Or continue with</span>
                    </div>
                </div>

                <!-- Google Login Button -->
                <a href="index.php?page=google_login"
                   class="flex items-center justify-center gap-3 px-4 py-3.5 darion-input rounded-darion-sm hover:bg-darion-glass/50 transition-colors border border-darion-border">
                    <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" class="w-5 h-5"/>
                    <span class="font-medium text-sm">Continue with Google</span>
                </a>

                <!-- Sign up link -->
                <p class="text-center mt-8 text-darion-text-muted text-sm">
                    Don't have an account?
                    <a href="index.php?page=register" class="text-darion-primary-light font-medium hover:text-darion-primary transition-colors ml-1">
                        Create an account
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE: FULLSCREEN P5.JS ANIMATION -->
<div class="hidden lg:flex lg:w-1/2 h-[75vh] relative overflow-hidden">
    <!-- p5.js Animation Container (Full Right Side) -->
    <div id="animation-container" class="absolute inset-0">
        <div id="p5-canvas" class="w-full h-full"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-black/10 to-black/30"></div>
    </div>
</div>
</div>

<footer class="text-center py-6 text-darion-text-muted text-sm mt-12 border-t border-darion-border/30">
    © <?= date("Y") ?> Darion Finance — All Rights Reserved.
</footer>

<!-- p5.js Animation Script -->
<script>
    // Exact animation code as provided
    let spacing = 30; // Distance between dots
    let cols = 12;    // Number of columns
    let rows = 12;    // Number of rows
    let depth = 12;   // Depth of the grid
    let sphereSize = 220; // Radius of the sphere shape
    
    let myp5;
    
    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        initializeAnimation();
        
        // Re-initialize on resize
        window.addEventListener('resize', function() {
            if (myp5) {
                myp5.remove();
                initializeAnimation();
            }
        });
    });
    
    function initializeAnimation() {
        const sketch = function(p) {
            p.setup = function() {
                const container = document.getElementById('animation-container');
                const canvas = p.createCanvas(container.offsetWidth, container.offsetHeight, p.WEBGL);
                canvas.parent('p5-canvas');
                p.stroke(255); // White dots
                p.strokeWeight(4); // Size of the dots
                p.noFill();
            };
            
            p.draw = function() {
               p.clear(); // Black background

                // Slowly rotate the entire shape (tumble effect)
                p.rotateX(p.frameCount * 0.01);
                p.rotateY(p.frameCount * 0.015);

                // Calculate the "morph" factor based on time (Sine wave)
                // This oscillates between 0 (Cube) and 1 (Sphere)
                let wave = p.sin(p.frameCount * 0.02);
                let morphAmount = p.map(wave, -1, 1, 0, 1);

                // Center the grid in the middle of the canvas
                let startX = -cols * spacing / 2;
                let startY = -rows * spacing / 2;
                let startZ = -depth * spacing / 2;

                // Nested loops to generate the grid of points
                for (let z = 0; z < depth; z++) {
                    for (let y = 0; y < rows; y++) {
                        for (let x = 0; x < cols; x++) {
                            
                            // 1. Calculate Cube Position
                            let xPos = startX + x * spacing;
                            let yPos = startY + y * spacing;
                            let zPos = startZ + z * spacing;
                            let cubePos = p.createVector(xPos, yPos, zPos);

                            // 2. Calculate Sphere Position
                            // We take the cube position, normalize it (turn it into a direction),
                            // and multiply by radius to force it onto a sphere surface.
                            let spherePos = cubePos.copy();
                            spherePos.normalize();
                            spherePos.mult(sphereSize);

                            // 3. Interpolate (Morph) between them
                            // lerp() calculates a point between the cube and the sphere
                            // based on the current morphAmount.
                            let currentPos = p5.Vector.lerp(cubePos, spherePos, morphAmount);

                            // Draw the point
                            p.point(currentPos.x, currentPos.y, currentPos.z);
                        }
                    }
                }
            };
            
            p.windowResized = function() {
                const container = document.getElementById('animation-container');
                p.resizeCanvas(container.offsetWidth, container.offsetHeight);
            };
        };
        
        // Create new p5 instance
        myp5 = new p5(sketch);
    }
</script>

</body>
</html>