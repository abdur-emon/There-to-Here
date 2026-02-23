<x-guest-layout>
    <!-- Header/Title -->
    <div class="mb-8 border-b border-sky-500/20 pb-4">
        <h2
            class="text-2xl font-mono font-bold text-white uppercase tracking-widest flex items-center gap-3 animate-flicker">
            <span class="w-2 h-2 bg-sky-400 rounded-sm animate-pulse-glow"></span>
            <span class="animate-glitch hover:animate-glitch cursor-crosshair">Auth_Link</span>
        </h2>
        <p class="text-sky-500/70 text-xs font-mono tracking-widest uppercase mt-2">Initialize secure session to proceed
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="relative group">
            <label for="email" class="block text-xs font-mono text-sky-400 mb-2 uppercase tracking-widest pl-1">Target
                Email</label>
            <div
                class="absolute inset-y-0 left-0 top-6 bottom-0 w-1 bg-sky-500/0 group-focus-within:bg-sky-500 transition-colors">
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username"
                class="futuristic-input w-full px-4 py-3 rounded-sm font-mono text-sm tracking-wide focus:outline-none focus:ring-0 placeholder-slate-500"
                placeholder="operator@node.sys" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs font-mono" />
        </div>

        <!-- Password -->
        <div class="relative group">
            <label for="password"
                class="block text-xs font-mono text-sky-400 mb-2 uppercase tracking-widest pl-1">Access Key</label>
            <div
                class="absolute inset-y-0 left-0 top-6 bottom-0 w-1 bg-sky-500/0 group-focus-within:bg-sky-500 transition-colors">
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="futuristic-input w-full px-4 py-3 rounded-sm font-mono text-sm tracking-wide focus:outline-none focus:ring-0 placeholder-slate-500"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs font-mono" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <div
                    class="relative flex items-center justify-center w-5 h-5 border border-sky-500/50 rounded-sm bg-slate-900 group-hover:border-sky-400 transition-colors">
                    <input id="remember_me" type="checkbox" class="absolute opacity-0 cursor-pointer w-full h-full peer"
                        name="remember">
                    <svg class="w-3 h-3 text-sky-400 opacity-0 peer-checked:opacity-100 transition-opacity" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <span
                    class="ms-3 text-xs font-mono text-slate-400 group-hover:text-sky-300 transition-colors uppercase tracking-widest">Maintain_Link</span>
            </label>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-sky-500/20">
            @if (Route::has('password.request'))
                <a class="text-xs font-mono text-sky-500/70 hover:text-sky-300 transition-colors uppercase tracking-widest"
                    href="{{ route('password.request') }}">
                    Recover_Key?
                </a>
            @else
                <div></div>
            @endif

            <button type="submit"
                class="cyber-button-primary w-full sm:w-auto px-8 py-3 rounded-sm font-mono text-sm uppercase tracking-widest shadow-[0_0_15px_rgba(56,189,248,0.2)]">
                AUTHENTICATE
            </button>
        </div>
    </form>
</x-guest-layout>