<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Calculate the precise time between any two dates with beautiful visualizations.">

    <title>{{ config('app.name', 'Date Distance Calculator') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.ts'])
</head>

<body
    class="antialiased bg-slate-950 text-slate-300 font-sans selection:bg-sky-500/30 selection:text-sky-200 overflow-x-hidden">

    <!-- Dynamic Cyber Background -->
    <div class="fixed inset-0 z-0 bg-slate-950">
        <!-- Animated Grid -->
        <div
            class="absolute inset-0 bg-grid-white/[0.02] bg-[size:50px_50px] [mask-image:linear-gradient(to_bottom,transparent,black,transparent)] animate-scan">
        </div>

        <!-- Glowing Orbs -->
        <div
            class="absolute top-1/4 left-1/4 w-96 h-96 bg-sky-600/20 rounded-full blur-[120px] mix-blend-screen animate-pulse-glow">
        </div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-indigo-600/20 rounded-full blur-[120px] mix-blend-screen animate-pulse-glow"
            style="animation-delay: 1.5s;"></div>
    </div>

    <!-- Navigation Area -->
    <nav
        class="absolute top-0 w-full px-6 py-4 flex justify-between items-center z-20 border-b border-white/5 bg-slate-950/50 backdrop-blur-md">
        <div class="text-xl font-bold text-white tracking-widest uppercase flex items-center gap-3">
            <div class="relative flex items-center justify-center w-8 h-8">
                <div class="absolute inset-0 border border-sky-500/50 rotate-45 animate-spin-slow"></div>
                <div class="w-1.5 h-1.5 bg-sky-400 rounded-full shadow-[0_0_10px_rgba(56,189,248,0.8)]"></div>
            </div>
            There_to_<span class="text-sky-400">Here</span>
        </div>

        <div class="flex space-x-4 items-center">
            @auth
                <a href="{{ url('/app') }}"
                    class="text-sm font-mono tracking-wider text-slate-400 hover:text-sky-400 hover:animate-glitch transition-all">INITIALIZE_APP</a>

                <form method="POST" action="{{ route('logout') }}" class="inline m-0 p-0 ml-4">
                    @csrf
                    <button type="submit"
                        class="text-sm font-mono tracking-wider text-rose-500 hover:text-rose-400 hover:animate-glitch transition-all uppercase">
                        [DISCONNECT_NODE]
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="text-sm font-mono tracking-wider text-slate-400 hover:text-sky-400 hover:animate-glitch transition-all">AUTH_LOGIN</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="cyber-button-primary px-5 py-2 rounded-sm text-sm uppercase tracking-wider ml-4">REGISTER_NODE</a>
                @endif
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="min-h-screen flex flex-col justify-center items-center relative z-10 px-4 pt-20">

        <div class="text-center max-w-4xl mx-auto flex flex-col items-center">

            <!-- Tech Badge -->
            <div
                class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full border border-sky-500/30 bg-sky-500/10 text-sky-400 text-xs font-mono tracking-widest uppercase mb-8 shadow-[0_0_15px_rgba(56,189,248,0.15)] animate-float-fast">
                <span class="w-2 h-2 rounded-full bg-sky-400 animate-pulse"></span>
                Temporal Processor v2.0
            </div>

            <h1
                class="text-5xl md:text-7xl font-extrabold tracking-tight text-white mb-6 leading-tight uppercase relative inline-block animate-flicker">
                Map The <br class="hidden md:block" />
                <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 via-indigo-400 to-sky-400 animate-pulse-glow animate-glitch hover:animate-glitch cursor-crosshair">Distance</span>

                <!-- Corner brackets decoration -->
                <div class="absolute -top-4 -left-4 w-8 h-8 border-t-2 border-l-2 border-sky-500/30"></div>
                <div class="absolute -bottom-4 -right-4 w-8 h-8 border-b-2 border-r-2 border-sky-500/30"></div>
            </h1>

            <p class="text-lg md:text-xl text-slate-400 mb-12 max-w-2xl leading-relaxed font-light">
                A high-precision temporal calculator engineered to compute the exact span between distinct chronologies.
                Enter coordinates to determine exact spatial-time variance.
            </p>

            <div class="flex flex-col sm:flex-row gap-6 w-full sm:w-auto">
                <a href="{{ route('calculator') }}"
                    class="cyber-button-primary w-full sm:w-auto px-10 py-4 rounded-sm font-mono tracking-wider uppercase flex items-center justify-center gap-3 group">
                    LAUNCH_SYSTEM
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </a>

                @guest
                    <a href="{{ route('register') }}"
                        class="cyber-button w-full sm:w-auto px-10 py-4 rounded-sm font-mono tracking-wider uppercase flex items-center justify-center">
                        ESTABLISH_UPLINK
                    </a>
                @endguest
            </div>

            <!-- Data Modules -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-32 text-left w-full">

                <div class="glass-panel p-6 rounded-sm relative overflow-hidden group">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-sky-400/0 via-sky-400 to-sky-400/0 opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                    <div class="text-sky-400 font-mono text-xs mb-4 tracking-widest opacity-70">MOD_01</div>
                    <h3 class="text-lg font-bold text-white mb-2 uppercase tracking-wide">Instant Execution</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Zero latency client-side rendering. Immediate
                        variable processing leveraging modern DOM capabilities.</p>
                </div>

                <div class="glass-panel p-6 rounded-sm relative overflow-hidden group">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-400/0 via-indigo-400 to-indigo-400/0 opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                    <div class="text-indigo-400 font-mono text-xs mb-4 tracking-widest opacity-70">MOD_02</div>
                    <h3 class="text-lg font-bold text-white mb-2 uppercase tracking-wide">Secure Comms</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Authorized nodes can synthesize encrypted link
                        generation and clipboard protocols.</p>
                </div>

                <div class="glass-panel p-6 rounded-sm relative overflow-hidden group">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-sky-400/0 via-sky-400 to-sky-400/0 opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                    <div class="text-sky-400 font-mono text-xs mb-4 tracking-widest opacity-70">MOD_03</div>
                    <h3 class="text-lg font-bold text-white mb-2 uppercase tracking-wide">Cyber Aesthetics</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Engineered with high contrast visual styling. Neon
                        indicators, structural grids, and glass diffusion.</p>
                </div>

            </div>

        </div>
    </main>

    <footer class="border-t border-white/5 bg-slate-950/80 backdrop-blur-sm py-6 text-center z-20 relative mt-16">
        <p class="text-slate-500 text-xs font-mono uppercase tracking-widest">SYS.VER {{ date('Y') }} // TERMINAL SECURE
        </p>
    </footer>
</body>

</html>