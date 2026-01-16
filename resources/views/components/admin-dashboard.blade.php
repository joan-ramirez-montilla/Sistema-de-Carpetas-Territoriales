<div class="flex h-full w-full flex-1 flex-col gap-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Visión general de métricas y estadísticas</p>
        </div>
    </div>

    {{-- Grid de métricas --}}
    <div class="grid gap-12 md:grid-cols-3">
        {{-- Métrica 1 --}}
        <div
            class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:border-gray-300/50 dark:hover:border-gray-700">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Empleados Registrado</p>
                    <p id="registeredEmployees" class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{$registeredEmployees}}</p>
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

        {{-- Métrica 2 --}}
        <div
            class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:border-gray-300/50 dark:hover:border-gray-700">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Citas de hoy</p>
                    <p id="todayAppointments" class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $todayAppointments }}</p>
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

        {{-- Métrica 3 --}}
        <div
            class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:border-gray-300/50 dark:hover:border-gray-700">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Citas Este Mes</p>
                    <p id="monthlyAppointments" class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $monthlyAppointments }}</p>
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

    {{-- Gráfico de citas --}}
    <div
        class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Citas por Mes</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Evolución mensual de citas programadas</p>
            </div>
            <!--div class="flex items-center gap-2">
                <select
                    class="rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-3 py-1 text-sm text-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:outline-none">
                    <option value="2026">2026</option>
                </select>
            </div-->
        </div>
        <div class="h-80">
            <canvas id="chartAppointments" class="w-full h-full"></canvas>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    animateCount('registeredEmployees', {{ $registeredEmployees }});
    animateCount('todayAppointments', {{ $todayAppointments }});
    animateCount('monthlyAppointments', {{ $monthlyAppointments }});

    const ctx = document.getElementById('chartAppointments').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0.05)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            datasets: [{
                label: 'Citas',
                data: @json($monthlyAppointmentsChart), // ✅ usar la variable enviada
                backgroundColor: gradient,
                borderColor: '#6366F1',
                borderWidth: 2,
                borderRadius: 12,
                borderSkipped: false,
                barThickness: 36
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>
