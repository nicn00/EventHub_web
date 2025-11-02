<?php

namespace App\Http\Controllers;

use App\Models\Event; // <-- Jangan lupa import Model
use Illuminate\Http\Request;

class PublicEventController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar event (KF-03: Pencarian Event)
     */
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%'); // <-- PERBAIKAN
        }

        $events = $query->where('date', '>=', now()) // <-- PERBAIKAN
                         ->orderBy('date', 'asc') // <-- PERBAIKAN
                         ->paginate(9);

        return view('public.index', compact('events'));
    }

    /**
     * Menampilkan halaman detail event (KF-04: Melihat Detail Event)
     */
    public function show(Event $event)
    {
        // Laravel otomatis mencari Event berdasarkan {id} di URL
        return view('public.show', compact('event'));
    }
}