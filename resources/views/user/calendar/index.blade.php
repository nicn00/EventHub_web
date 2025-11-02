@extends('layouts.public')

@section('title', 'Kalender Event Saya')

@push('styles')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
        /* Membuat event di kalender bisa di-klik */
        .fc-event {
            cursor: pointer;
        }
        .fc-event:hover {
            opacity: 0.8;
        }
    </style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Kalender Event Saya (KF-07)</h3>
                </div>
                <div class="card-body">
                    <p>Ini adalah kalender yang menampilkan event-event yang tiketnya sudah Anda beli.</p>
                    
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Tampilan bulanan
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                // Ambil data event dari Rute yang kita buat di Langkah 2
                events: '{{ route('calendar.feed') }}',
                
                // Aksi saat event di kalender di-klik
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // Mencegah browser redirect
                    if (info.event.url) {
                        // Buka link detail event di tab baru
                        window.open(info.event.url, "_blank");
                    }
                }
            });
            calendar.render();
        });
    </script>
@endpush