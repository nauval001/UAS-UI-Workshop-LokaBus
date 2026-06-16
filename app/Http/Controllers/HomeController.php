<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Schedule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil 3 artikel terbaru untuk ditampilkan di Landing Page
        $latestArticles = Article::with('author')->latest()->take(3)->get();

        // Mengambil daftar kota unik untuk pilihan form Asal dan Tujuan
        $origins = Schedule::distinct()->pluck('origin');
        $destinations = Schedule::distinct()->pluck('destination');

        return view('welcome', compact('latestArticles', 'origins', 'destinations'));
    }
    public function search(Request $request)
    {
        $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'departure_date' => 'required|date',
        ]);

        // Alur pencarian akan mencocokkan asal, tujuan, dan tanggal keberangkatan
        $schedules = Schedule::with('bus')
            ->where('origin', $request->origin)
            ->where('destination', $request->destination)
            ->whereDate('departure_time', $request->departure_date)
            ->get();

        return view('tickets.index', compact('schedules', 'request'));
    }
    public function show($id)
    {
        // Mengambil data jadwal beserta relasi bus dan kursi
        $schedule = Schedule::with(['bus', 'seats'])->findOrFail($id);

        return view('tickets.show', compact('schedule'));
    }
}