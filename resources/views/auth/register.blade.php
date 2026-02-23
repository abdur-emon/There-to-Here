<x-guest-layout>
    <!-- Header/Title -->
    <div class="mb-8 border-b border-sky-500/20 pb-4 flex justify-between items-end">
        <div>
            <h2
                class="text-2xl font-mono font-bold text-white uppercase tracking-widest flex items-center gap-3 animate-flicker">
                <span class="w-2 h-2 bg-indigo-400 rounded-sm animate-pulse-glow"></span>
                <span class="animate-glitch hover:animate-glitch cursor-crosshair">New_Node</span>
            </h2>
            <p class="text-sky-500/70 text-xs font-mono tracking-widest uppercase mt-2">Initialize network registration
            </p>
        </div>
        <div class="text-[10px] font-mono text-slate-500 tracking-widest">SYS.REQ.01</div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="relative group">
            <label for="name" class="block text-xs font-mono text-sky-400 mb-2 uppercase tracking-widest pl-1">Operator
                Designation</label>
            <div
                class="absolute inset-y-0 left-0 top-6 bottom-0 w-1 bg-indigo-500/0 group-focus-within:bg-indigo-500 transition-colors">
            </div>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="futuristic-input w-full px-4 py-3 rounded-sm font-mono text-sm tracking-wide focus:outline-none focus:ring-0 placeholder-slate-500 focus:border-indigo-400 focus:shadow-[0_0_15px_rgba(99,102,241,0.15)]"
                placeholder="Identify" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400 text-xs font-mono" />
        </div>

        <!-- Email Address -->
        <div class="relative group">
            <label for="email" class="block text-xs font-mono text-sky-400 mb-2 uppercase tracking-widest pl-1">Network
                Contact</label>
            <div
                class="absolute inset-y-0 left-0 top-6 bottom-0 w-1 bg-indigo-500/0 group-focus-within:bg-indigo-500 transition-colors">
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="futuristic-input w-full px-4 py-3 rounded-sm font-mono text-sm tracking-wide focus:outline-none focus:ring-0 placeholder-slate-500 focus:border-indigo-400 focus:shadow-[0_0_15px_rgba(99,102,241,0.15)]"
                placeholder="operator@node.sys" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs font-mono" />
        </div>

        <!-- Password -->
        <div class="relative group">
            <label for="password"
                class="block text-xs font-mono text-sky-400 mb-2 uppercase tracking-widest pl-1">Generate Security
                Key</label>
            <div
                class="absolute inset-y-0 left-0 top-6 bottom-0 w-1 bg-indigo-500/0 group-focus-within:bg-indigo-500 transition-colors">
            </div>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="futuristic-input w-full px-4 py-3 rounded-sm font-mono text-sm tracking-wide focus:outline-none focus:ring-0 placeholder-slate-500 focus:border-indigo-400 focus:shadow-[0_0_15px_rgba(99,102,241,0.15)]"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs font-mono" />
        </div>

        <!-- Confirm Password -->
        <div class="relative group">
            <label for="password_confirmation"
                class="block text-xs font-mono text-sky-400 mb-2 uppercase tracking-widest pl-1">Verify Security
                Key</label>
            <div
                class="absolute inset-y-0 left-0 top-6 bottom-0 w-1 bg-indigo-500/0 group-focus-within:bg-indigo-500 transition-colors">
            </div>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password"
                class="futuristic-input w-full px-4 py-3 rounded-sm font-mono text-sm tracking-wide focus:outline-none focus:ring-0 placeholder-slate-500 focus:border-indigo-400 focus:shadow-[0_0_15px_rgba(99,102,241,0.15)]"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')"
                class="mt-2 text-red-400 text-xs font-mono" />
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-sky-500/20">
            <a class="text-xs font-mono text-sky-500/70 hover:text-sky-300 transition-colors uppercase tracking-widest"
                href="{{ route('login') }}">
                Cancel_Reg
            </a>

            <button type="submit"
                class="cyber-button-primary bg-indigo-500 hover:bg-indigo-400 w-full sm:w-auto px-8 py-3 rounded-sm font-mono text-sm uppercase tracking-widest shadow-[0_0_15px_rgba(99,102,241,0.2)] hover:shadow-[0_0_25px_rgba(99,102,241,0.6)]">
                ESTABLISH
            </button>
        </div>
    </form>
</x-guest-layout>