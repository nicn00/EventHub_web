<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvents = Event::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalTicketsSold = Ticket::count();

        // Data untuk Chart.js (Penjualan tiket per event)
        $eventsData = Event::withCount('tickets') // Menghitung jumlah tiket
                             ->orderBy('tickets_count', 'desc')
                             ->take(10) // Ambil 10 teratas
                             ->get();
        
        $chartLabels = $eventsData->pluck('namaEvent');
        $chartData = $eventsData->pluck('tickets_count');

        // untuk sistem notifikasi, siapkan di sini
        $unreadNotifications = []; // bisa diganti query dari tabel notifikasi
        $unreadCount = 0; // atau count($unreadNotifications);

        return view('admin.dashboard', compact(
            'totalEvents', 'totalUsers', 'totalTicketsSold', 
            'chartLabels', 'chartData', 'unreadNotifications',
            'unreadCount'
        ));
    }
}