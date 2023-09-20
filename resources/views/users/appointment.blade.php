<x-app-layout>
    <h1>AAAAAAA</h1>
<div id="calendar"></div>

<button class="btn btn-primary"><a href="{{ route('user.createRequest',$id) }}">Request</a></button>
@push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
        <script> 
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    slotMinTime: '9:00:00',
                    slotMaxTime: '17:00:00',
                    events: @json($events),
                });
                calendar.render();
            });
        </script>
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
@endpush
</x-app-layout>