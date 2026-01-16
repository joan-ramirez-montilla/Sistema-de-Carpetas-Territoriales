<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-8">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Dashboard</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Visión general de métricas y estadísticas</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-sm text-gray-500 dark:text-gray-400">Actualizado hoy</div>
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
                        <p id="empleados" class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">120</p>
                    </div>
                    <div class="rounded-lg bg-indigo-50 dark:bg-indigo-950/30 p-3">
                        <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13-5.197a4 4 0 00-8 0m8 0a4 4 0 01-8 0" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="flex items-center text-emerald-600 dark:text-emerald-400">
                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        +12% este mes
                    </span>
                </div>
            </div>

            {{-- Métrica 2 --}}
            <div
                class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:border-gray-300/50 dark:hover:border-gray-700">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Citas Esta Semana</p>
                        <p id="citasSemana" class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">220</p>
                    </div>
                    <div class="rounded-lg bg-rose-50 dark:bg-rose-950/30 p-3">
                        <svg class="h-6 w-6 text-rose-600 dark:text-rose-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="flex items-center text-rose-600 dark:text-rose-400">
                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        -3% vs semana pasada
                    </span>
                </div>
            </div>

            {{-- Métrica 3 --}}
            <div
                class="relative overflow-hidden rounded-2xl border border-gray-200/50 dark:border-gray-800 bg-white/50 dark:bg-gray-900/50 backdrop-blur-sm p-6 shadow-sm transition-all duration-300 hover:shadow-md hover:border-gray-300/50 dark:hover:border-gray-700">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Citas Este Mes</p>
                        <p id="citasMes" class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">4,304</p>
                    </div>
                    <div class="rounded-lg bg-emerald-50 dark:bg-emerald-950/30 p-3">
                        <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm">
                    <span class="flex items-center text-emerald-600 dark:text-emerald-400">
                        <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        +8% vs mes pasado
                    </span>
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
                <div class="flex items-center gap-2">
                    <select
                        class="rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-3 py-1 text-sm text-gray-700 dark:text-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:outline-none">
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
            </div>
            <div class="h-80">
                <canvas id="chartCitas" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Contadores animados con efecto más suave
        function animateCount(id, target) {
            const element = document.getElementById(id);
            const duration = 1500;
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }

        // Iniciar animaciones
        document.addEventListener('DOMContentLoaded', () => {
            animateCount('empleados', 120);
            animateCount('citasSemana', 220);
            animateCount('citasMes', 4304);

            // Gráfico con estilo más profesional
            const ctx = document.getElementById('chartCitas').getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
            gradient.addColorStop(1, 'rgba(99, 102, 241, 0.05)');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov',
                        'Dic'
                    ],
                    datasets: [{
                        label: 'Citas',
                        data: [320, 420, 380, 510, 480, 610, 590, 520, 580, 630, 600, 650],
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
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.95)',
                            titleColor: '#1f2937',
                            bodyColor: '#4b5563',
                            borderColor: '#e5e7eb',
                            borderWidth: 1,
                            cornerRadius: 8,
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return `${context.parsed.y.toLocaleString()} citas`;
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 12
                                },
                                callback: function(value) {
                                    return value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6b7280',
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });
    </script>
</x-layouts::app>
