<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Notification;

class TicketController extends Controller
{
    /**
     * Logika Pembelian Tiket 
     * Rute ini hanya bisa diakses setelah login.
     */
    public function store(Event $event)
    {
        // Cek dulu apakah user sudah punya tiket ini
        $alreadyBought = Ticket::where('user_id', Auth::id())
                                ->where('event_id', $event->id)
                                ->exists();
        
        if ($alreadyBought) {
            return redirect()->route('tickets.index')->with('error', 'Anda sudah memiliki tiket untuk event ini.');
        }

        // Buat Tiket
        Ticket::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'ticket_code' => 'EVH-' . strtoupper(Str::random(10)), // Kode QR unik 
            'status' => 'paid' // Simulasi pembayaran
        ]);

        $newTicket = Ticket::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'ticket_code' => 'EVH-' . strtoupper(Str::random(10)),
            'status' => 'paid'
        ]);

        // Buat notifikasi baru untuk Admin
    Notification::create([
        'message' => Auth::user()->name . ' baru saja membeli tiket ' . $event->namaEvent,
        'user_id' => Auth::id(),
        'ticket_id' => $newTicket->id, // Tautkan ke tiket yg baru dibuat
    ]);

        // Simpan tiket yg baru dibuat ke sebuah variabel
    $newTicket = Ticket::create([
        'user_id' => Auth::id(),
        'event_id' => $event->id,
        'ticket_code' => 'EVH-' . strtoupper(Str::random(10)),
        'status' => 'paid'
    ]);

        

        return redirect()->route('tickets.index')->with('success', 'Pembelian tiket berhasil!');
    }

    /**
     * Menampilkan halaman "Tiket Saya"
     */
    public function index()
    {
        $myTickets = Ticket::where('user_id', Auth::id())
                            ->where('status','paid')
                            ->with('event') // Ambil data event-nya sekaligus
                            ->latest()
                            ->get();
        
        return view('user.tickets.index', compact('myTickets'));
    }

    /**
     * Membatalkan (bukan menghapus) tiket.
     */
    public function destroy(Ticket $ticket)
    {
        // 1. Pastikan user ini adalah pemilik tiket
        if ($ticket->user_id != Auth::id()) {
            abort(403, 'Anda tidak diizinkan membatalkan tiket ini.');
        }

        // 2. Ubah status, BUKAN dihapus
        $ticket->update([
            'status' => 'cancelled'
        ]);

        // 3. Kembalikan ke halaman Tiket Saya
        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dibatalkan.');
    }
}