<div>

    @if(auth()->user()->role == "admin")

        <x-admin-dashboard
            :registered-employees="$registeredEmployees"
            :monthly-appointments="$monthlyAppointments"
            :monthly-appointments-chart="$monthlyAppointmentsChart"
            :today-appointments="$todayAppointments"
        />

    @elseif(auth()->user()->role == "employee")

        <x-employee-dashboard
            :today-appointments="$todayAppointments"
            :monthly-appointments="$monthlyAppointments"
            :monthly-appointments-chart="$monthlyAppointmentsChart"
            :pending-appointments="$pendingAppointments"
        />

    @endif


</div>
