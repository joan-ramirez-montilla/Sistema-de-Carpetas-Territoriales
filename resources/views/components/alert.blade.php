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
        Livewire.on('notify', data => {
            notyf.open({
                type: data.type,
                message: data.message
            })
        })
    })
</script>
