<div class="grid gap-12 md:grid-cols-3">
    {{-- Metric 1 --}}
    <div
        class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:border-gray-300/50 dark:hover:border-gray-700">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Citas pendientes</p>
                <p id="pendingAppointments" class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $pendingAppointments }}</p>
            </div>
            <div class="rounded-lg bg-indigo-50 dark:bg-indigo-950/30 p-3">
                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13-5.197a4 4 0 00-8 0m8 0a4 4 0 01-8 0" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Metric 2 --}}
    <div
        class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:border-gray-300/50 dark:hover:border-gray-700">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Citas de hoy</p>
                <p id="todayAppointments" class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $todayAppointments }}</p>
            </div>
            <div class="rounded-lg bg-rose-50 dark:bg-rose-950/30 p-3">
                <svg class="h-6 w-6 text-rose-600 dark:text-rose-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Metric 3 --}}
    <div
        class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:border-gray-300/50 dark:hover:border-gray-700">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Citas mensuales</p>
                <p id="monthlyAppointments" class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $monthlyAppointments }}</p>
            </div>
            <div class="rounded-lg bg-emerald-50 dark:bg-emerald-950/30 p-3">
                <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        animateCount('pendingAppointments', {{ $pendingAppointments }});
        animateCount('todayAppointments', {{ $todayAppointments }});
        animateCount('monthlyAppointments', {{ $monthlyAppointments }});
    });
</script>
