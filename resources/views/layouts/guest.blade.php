<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans text-slate-300 antialiased bg-slate-950 selection:bg-sky-500/30 selection:text-sky-200 overflow-x-hidden">

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
        <div class="absolute top-3/4 right-1/4 w-96 h-96 bg-indigo-600/20 rounded-full blur-[120px] mix-blend-screen animate-pulse-glow"
            style="animation-delay: 1.5s;"></div>
    </div>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10 px-4">

        <div class="mb-8">
            <a href="/" class="text-xl font-bold text-white tracking-widest uppercase flex items-center gap-3 group">
                <div
                    class="relative flex items-center justify-center w-10 h-10 transition-transform group-hover:scale-110">
                    <div class="absolute inset-0 border border-sky-500/50 rotate-45 animate-spin-slow"></div>
                    <div class="w-1.5 h-1.5 bg-sky-400 rounded-full shadow-[0_0_10px_rgba(56,189,248,0.8)]"></div>
                </div>
                There_to_<span class="text-sky-400">Here</span>
            </a>
        </div>

        <!-- Authentic Container Frame -->
        <div
            class="w-full sm:max-w-md mt-6 px-1 py-1 bg-gradient-to-b from-sky-400/20 to-transparent rounded-sm relative group overflow-hidden shadow-[0_0_30px_rgba(56,189,248,0.1)]">
            <!-- Glowing rotating border effect -->
            <div
                class="absolute top-[-50%] left-[-50%] w-[200%] h-[200%] bg-[conic-gradient(transparent,rgba(56,189,248,0.3),transparent)] animate-spin-slow opacity-0 group-hover:opacity-100 transition-opacity">
            </div>

            <div class="w-full h-full glass-panel px-6 py-8 sm:rounded-sm relative z-10">
                <!-- Tech Corner Accents -->
                <div class="absolute top-0 left-0 w-3 h-3 border-t-2 border-l-2 border-sky-500"></div>
                <div class="absolute top-0 right-0 w-3 h-3 border-t-2 border-r-2 border-sky-500"></div>
                <div class="absolute bottom-0 left-0 w-3 h-3 border-b-2 border-l-2 border-sky-500"></div>
                <div class="absolute bottom-0 right-0 w-3 h-3 border-b-2 border-r-2 border-sky-500"></div>

                {{ $slot }}
            </div>
        </div>

        <!-- Connection Status -->
        <div class="mt-8 flex items-center gap-2 text-xs font-mono text-sky-500/70">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
            SECURE_LINK_ESTABLISHED
        </div>
    </div>
</body>

</html>