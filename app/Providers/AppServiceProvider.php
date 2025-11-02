<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share data notifikasi HANYA ke layout admin
    View::composer('layouts.admin', function ($view) {
        // Kita cek manual apakah user adalah admin
        if (Auth::check() && Auth::user()->role == 'admin') {
            $unreadNotifications = Notification::where('is_read', false)
                                               ->latest()
                                               ->take(5) // Ambil 5 notif terbaru
                                               ->get();
            $unreadCount = Notification::where('is_read', false)->count();

            // Kirim variabel ini ke layout
            $view->with('unreadNotifications', $unreadNotifications)
                 ->with('unreadCount', $unreadCount);
        } else {
            // Jika bukan admin (misal saat proses login), kirim data kosong
            $view->with('unreadNotifications', collect())
                 ->with('unreadCount', 0);
        }
    });
    }
}
