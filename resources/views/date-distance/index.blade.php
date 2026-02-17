@extends('layouts.app')

@section('content')
    <div class="min-h-screen gradient-bg flex items-center justify-center p-4">
        <div class="w-full max-w-2xl">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-3 bengali-text">
                    একদিন তো মরেই যাবো !
                </h1>
                <p class="text-gray-300 text-lg">
                    Calculate the precise time between any two dates
                </p>
            </div>
            
            <!-- Main Card -->
            <div class="glass rounded-3xl p-8 shadow-2xl">
                <!-- Theme Toggle -->
                <div class="flex justify-end mb-6">
                    <x-theme-toggle :theme="$theme" />
                </div>
                
                <!-- Form -->
                <form id="date-form" class="space-y-6">
                    <!-- Target Date -->
                    <x-date-input
                        label="Target Date"
                        id="target-date"
                        name="target_date"
                        :value="$targetDate"
                        :required="true"
                    />
                    
                    <!-- From Date Toggle -->
                    <div class="flex items-center space-x-3">
                        <input
                            type="checkbox"
                            id="use-from-date"
                            class="w-4 h-4 text-purple-500 bg-white/5 border-white/10 rounded focus:ring-2 focus:ring-purple-500"
                            {{ $fromDate ? 'checked' : '' }}
                        />
                        <label for="use-from-date" class="text-sm text-gray-300 cursor-pointer">
                            Use custom "From" date (defaults to today)
                        </label>
                    </div>
                    
                    <!-- From Date Input (conditionally shown) -->
                    <div id="from-date-container" class="{{ $fromDate ? 'block' : 'hidden' }}">
                        <x-date-input
                            label="From Date"
                            id="from-date"
                            name="from_date"
                            :value="$fromDate"
                        />
                    </div>
                    
                    <!-- Calculate Button -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold py-4 rounded-lg hover:from-purple-600 hover:to-pink-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-900"
                    >
                        Calculate
                    </button>
                </form>
                
                <!-- Results -->
                <div class="mt-8">
                    <x-result-display :result="$result" />
                </div>
            </div>
            
            <!-- Footer -->
            <div class="text-center mt-8 text-gray-400 text-sm">
                <p>Built with Laravel 11, TypeScript, and Tailwind CSS v4</p>
                <p class="mt-2">
                    <kbd class="px-2 py-1 bg-white/5 rounded text-xs">Cmd+K</kbd> to focus date input
                </p>
            </div>
        </div>
    </div>
    
    <!-- Pass initial state to JavaScript -->
    <script>
        window.__INITIAL_STATE__ = {
            targetDate: @json($targetDate),
            fromDate: @json($fromDate),
            theme: @json($theme),
            result: @json($result),
        };
    </script>
@endsection

