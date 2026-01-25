<script>
    document.addEventListener('DOMContentLoaded', () => {

        const notyf = new Notyf({
            duration: 3000,
            dismissible: true,
        })

        // 🔹 Alerts por sesión (redirect)
        @if (session('success'))
            notyf.success(@json(session('success')))
        @endif

        @if (session('error'))
            notyf.error(@json(session('error')))
        @endif

        @if (session('warning'))
            notyf.open({ type: 'warning', message: @json(session('warning')) })
        @endif

        @if (session('info'))
            notyf.open({ type: 'info', message: @json(session('info')) })
        @endif

        // Alerts desde Livewire (SIN redirect)
        // Para Livewire v4 - solo registrar una vez
        let notifyListenerSetup = false
        
        function setupNotifyListener() {
            if (window.Livewire && !notifyListenerSetup) {
                notifyListenerSetup = true
                Livewire.on('notify', (data) => {
                    // En Livewire v4, cuando haces dispatch('notify', ['type' => 'error', 'message' => '...'])
                    // el listener recibe el array directamente: {type: 'error', message: '...'}
                    let type = 'info'
                    let message = ''
                    
                    // Manejar diferentes formatos de datos
                    if (typeof data === 'object' && data !== null) {
                        type = data.type || data[0]?.type || 'info'
                        message = data.message || data[0]?.message || ''
                    } else if (typeof data === 'string') {
                        message = data
                    }
                    
                    if (message) {
                        notyf.open({
                            type: type,
                            message: message
                        })
                    }
                })
            }
        }

        // Configurar cuando Livewire se inicializa
        document.addEventListener('livewire:init', setupNotifyListener)
        
        // También intentar configurar inmediatamente si Livewire ya está cargado
        if (window.Livewire) {
            setupNotifyListener()
        }
    })
</script>
