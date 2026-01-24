<div class="pt-16 pb-8" style="background: var(--color-secondary); color: var(--color-light);">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-12 pb-12 border-b border-white/10">
            <!-- Logo y descripción -->
            <div class="space-y-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background: {{ $primaryColor }};">
                        <i class="fas fa-cut text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold">{{ $companySetting->name }}</span>
                </div>
                <p class="text-gray-300">{{ $companySetting->seo_description }}</p>
            </div>

            <!-- Enlaces rápidos -->
            <div>
                <h4 class="text-lg font-bold mb-6">Enlaces Rápidos</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('appointments.create') }}" class="text-gray-300 hover:text-white transition">Reservar Cita</a></li>
                    <li><a href="#equipo" class="text-gray-300 hover:text-white transition">Nuestro Equipo</a></li>
                    <li><a href="#horario" class="text-gray-300 hover:text-white transition">Horarios</a></li>
                    <li><a href="#ubicacion" class="text-gray-300 hover:text-white transition">Ubicación</a></li>
                </ul>
            </div>

            <!-- Contacto -->
            <div>
                <h4 class="text-lg font-bold mb-6">Contacto</h4>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-phone text-gray-300"></i>
                        <span class="text-gray-300">{{ $companySetting->phone }}</span>
                    </div>
                    @if ($companySetting->email)
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-gray-300"></i>
                            <span class="text-gray-300">{{ $companySetting->email }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Redes sociales -->
            <div>
                <h4 class="text-lg font-bold mb-6">Síguenos</h4>
                <div class="flex gap-3">
                    @if ($companySetting->whatsapp)
                        <a href="{{ $companySetting->whatsapp }}"
                            class="w-10 h-10 rounded-lg flex items-center justify-center hover:opacity-90 transition"
                            style="background: {{ $primaryColor }};">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    @endif
                    @if ($companySetting->instagram)
                        <a href="{{ $companySetting->instagram }}"
                            class="w-10 h-10 rounded-lg flex items-center justify-center hover:opacity-90 transition"
                            style="background: {{ $primaryColor }};">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                    @if ($companySetting->facebook)
                        <a href="{{ $companySetting->facebook }}"
                            class="w-10 h-10 rounded-lg flex items-center justify-center hover:opacity-90 transition"
                            style="background: {{ $primaryColor }};">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="pt-8 text-center">
            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} {{ $companySetting->name }}. Todos los derechos reservados.
            </p>
        </div>
    </div>
</div>
