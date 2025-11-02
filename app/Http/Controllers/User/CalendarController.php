<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket; // Import model Tiket
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth

class CalendarController extends Controller
{
    /**
     * Menampilkan halaman kalender (Sesi 4 dari SKPL)
     */
    public function index()
    {
        // View ini akan kita buat di Langkah 3
        return view('user.calendar.index');
    }

    /**
     * Menyediakan data (feed) untuk FullCalendar dalam format JSON
     */
    public function feed()
    {
        // Ambil tiket milik user yang sedang login
        $tickets = Ticket::where('user_id', Auth::id())
                        ->with('event') // Ambil data 'event' terkait
                        ->get();

        $events = [];
        foreach ($tickets as $ticket) {
            $events[] = [
                'title' => $ticket->event->name,       // Nama event
                'start' => $ticket->event->date,       // Tanggal event
                'url'   => route('events.show', $ticket->event->id), // Link ke detail event
            ];
        }

        return response()->json($events);
    }
}