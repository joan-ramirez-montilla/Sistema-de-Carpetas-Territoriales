<div class="container mx-auto px-4 py-8">
    <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">Bienvenido al Sistema de Carpetas Territoriales</h1>
        <p class="text-lg text-gray-600">Sistema de gestión de personas, organizaciones y territorios</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
        <a href="{{ route('people.index') }}"
            class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-xl font-bold mb-2">Personas</h2>
            <p class="text-gray-600">Gestiona la información de todas las personas registradas en el sistema</p>
        </a>

        <a href="{{ route('profile.edit') }}"
            class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-xl font-bold mb-2">Configuración</h2>
            <p class="text-gray-600">Ajusta los parámetros de tu cuenta y preferencias del sistema</p>
        </a>

        <div class="block p-6 bg-white border border-gray-200 rounded-lg shadow">
            <h2 class="text-xl font-bold mb-2">Información</h2>
            <p class="text-gray-600">Sistema versión 1.0 - Gestión de Territorios</p>
        </div>
    </div>
</div>
