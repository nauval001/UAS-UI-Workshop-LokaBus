<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Pencarian Tiket - LokaBus</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-blue-600 transition">
                        &larr; <span class="hidden sm:inline">Kembali</span>
                    </a>
                    <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600 tracking-tight">Loka<span class="text-amber-500">Bus</span></a>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">Masuk</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-blue-700 py-8 px-4 text-white">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold mb-2">Hasil Pencarian Jadwal Bus</h1>
            <div class="flex flex-wrap items-center gap-2 text-blue-100 text-sm">
                <span class="font-semibold text-white">{{ request('origin') }}</span>
                <span>&rarr;</span>
                <span class="font-semibold text-white">{{ request('destination') }}</span>
                <span class="mx-2">&bull;</span>
                <span>{{ \Carbon\Carbon::parse(request('departure_date'))->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            
            <aside class="w-full md:w-1/4">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-24">
                    <h3 class="font-bold text-gray-900 mb-4">Filter Pencarian</h3>
                    
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Kelas Bus</h4>
                        <label class="flex items-center gap-2 mb-2 cursor-pointer text-sm text-gray-600">
                            <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500" checked> VIP
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-600">
                            <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500" checked> Ekonomi
                        </label>
                    </div>

                    <div>
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Waktu Keberangkatan</h4>
                        <label class="flex items-center gap-2 mb-2 cursor-pointer text-sm text-gray-600">
                            <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500"> Pagi (00:00 - 12:00)
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer text-sm text-gray-600">
                            <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500"> Malam (12:00 - 24:00)
                        </label>
                    </div>

                    <button class="w-full mt-6 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-sm py-2 px-4 rounded-xl transition">
                        Terapkan Filter
                    </button>
                </div>
            </aside>

            <section class="w-full md:w-3/4">
                @if($schedules->isEmpty())
                    <div class="bg-white p-12 rounded-2xl shadow-sm border border-gray-100 text-center">
                        <div class="text-gray-400 mb-4 text-5xl">🚌</div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Jadwal Tidak Ditemukan</h3>
                        <p class="text-gray-500 text-sm mb-6">Maaf, tidak ada jadwal bus yang tersedia untuk rute dan tanggal tersebut.</p>
                        <a href="{{ route('home') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-2.5 px-6 rounded-xl transition shadow-sm">
                            Ubah Pencarian
                        </a>
                    </div>
                @else
                    <div class="space-y-4">
                        <p class="text-sm text-gray-500 mb-4">Menampilkan <strong>{{ $schedules->count() }}</strong> jadwal keberangkatan.</p>
                        
                        @foreach($schedules as $schedule)
                            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition flex flex-col sm:flex-row items-center justify-between gap-6">
                                
                                <div class="flex-1 w-full flex items-start gap-4">
                                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 font-bold text-xl shrink-0">
                                        🚍
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-lg">{{ $schedule->bus->name ?? 'Armada LokaBus' }}</h3>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="inline-block px-2 py-1 bg-amber-100 text-amber-800 text-xs font-semibold rounded-md">
                                                {{ $schedule->bus->class ?? 'VIP' }}
                                            </span>
                                            <span class="text-xs text-gray-500 truncate max-w-[150px] sm:max-w-xs">
                                                {{ $schedule->bus->facilities ?? 'AC, Reclining Seat, USB Charger' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 text-center shrink-0 w-full sm:w-auto justify-between sm:justify-center border-y sm:border-y-0 border-gray-100 py-4 sm:py-0">
                                    <div>
                                        <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('H:i') }}</p>
                                        <p class="text-xs text-gray-500">{{ $schedule->origin }}</p>
                                    </div>
                                    <div class="text-gray-300 text-sm flex flex-col items-center">
                                        <span class="text-[10px] text-gray-400 mb-1">
                                            {{ \Carbon\Carbon::parse($schedule->departure_time)->diffInHours(\Carbon\Carbon::parse($schedule->arrival_time)) }} Jam
                                        </span>
                                        &rarr;
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($schedule->arrival_time)->format('H:i') }}</p>
                                        <p class="text-xs text-gray-500">{{ $schedule->destination }}</p>
                                    </div>
                                </div>

                                <div class="flex flex-col items-end shrink-0 w-full sm:w-auto">
                                    <p class="text-lg font-extrabold text-blue-600 mb-2">
                                        Rp {{ number_format($schedule->price, 0, ',', '.') }}
                                    </p>
                                    <a href="{{ route('tickets.show', $schedule->id) }}" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-2.5 px-6 rounded-xl transition text-center shadow-sm">
                                        Pilih Kursi
                                    </a>
                                    <p class="text-[10px] text-gray-400 mt-2">Sisa 12 Kursi</p>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    </main>

</body>
</html>