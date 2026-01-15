@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="space-y-4">

        {{-- Vista Móvil --}}
        <div class="flex items-center justify-between sm:hidden">
            {{-- Anterior --}}
            @if ($paginator->onFirstPage())
                <button disabled class="px-3 py-1.5 text-sm text-gray-400 bg-gray-50 rounded-lg border border-gray-200 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-500">
                    ← Anterior
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   rel="prev"
                   class="px-3 py-1.5 text-sm text-gray-700 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-colors dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                    ← Anterior
                </a>
            @endif

            {{-- Info de Página --}}
            <span class="text-sm text-gray-600 dark:text-gray-400 px-4">
                {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>

            {{-- Siguiente --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   rel="next"
                   class="px-3 py-1.5 text-sm text-gray-700 bg-white rounded-lg border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-colors dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                    Siguiente →
                </a>
            @else
                <button disabled class="px-3 py-1.5 text-sm text-gray-400 bg-gray-50 rounded-lg border border-gray-200 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-500">
                    Siguiente →
                </button>
            @endif
        </div>

        {{-- Vista Escritorio --}}
        <div class="hidden sm:block">
            <div class="flex items-center justify-between">
                {{-- Info de Resultados --}}
                <div class="text-sm text-gray-600 dark:text-gray-400 mr-6">
                    @if ($paginator->total() > 0)
                        Mostrando
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $paginator->firstItem() }}</span>
                        a
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $paginator->lastItem() }}</span>
                        de
                        <span class="font-medium text-gray-800 dark:text-gray-200">{{ $paginator->total() }}</span>
                        resultados
                    @else
                        No se encontraron resultados
                    @endif
                </div>

                {{-- Controles de Paginación --}}
                <div class="flex items-center space-x-2">
                    {{-- Página Anterior --}}
                    @if ($paginator->onFirstPage())
                        <button disabled
                                class="p-2.5 rounded-lg text-gray-400 bg-gray-50 border border-gray-200 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}"
                           rel="prev"
                           class="p-2.5 rounded-lg text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-colors dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                    @endif

                    {{-- Números de Página --}}
                    <div class="flex items-center space-x-1 mx-1">
                        @foreach ($elements as $element)
                            {{-- Separador "Tres Puntos" --}}
                            @if (is_string($element))
                                <span class="px-3 py-1.5 text-sm text-gray-500 dark:text-gray-400">...</span>
                            @endif

                            {{-- Array de Enlaces --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <span class="px-3.5 py-1.5 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-sm dark:bg-blue-500">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}"
                                           class="px-3.5 py-1.5 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-colors dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>

                    {{-- Página Siguiente --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}"
                           rel="next"
                           class="p-2.5 rounded-lg text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-colors dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:border-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @else
                        <button disabled
                                class="p-2.5 rounded-lg text-gray-400 bg-gray-50 border border-gray-200 cursor-not-allowed dark:bg-gray-800 dark:border-gray-700 dark:text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </nav>
@endif
