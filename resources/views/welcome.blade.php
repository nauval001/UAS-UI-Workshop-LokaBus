<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.1">
    <title>LokaBus - Pemesanan Tiket Bus Online</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-blue-600 tracking-tight">Loka<span class="text-amber-500">Bus</span></span>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 h-9 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition shadow-sm">Daftar</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <header class="relative bg-gradient-to-r bg-blue-700 py-16 sm:py-24 px-4 text-center text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="relative max-w-3xl mx-auto">
            <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-semibold bg-blue-600/50 text-amber-300 border border-blue-500 mb-4">
                🎉 Promo Spesial Liburan: Diskon Hingga 20% !
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight mb-4">Perjalanan Aman dan Nyaman Bersama LokaBus</h1>
            <p class="text-base sm:text-xl text-blue-100 mb-8">Pesan tiket bus ke berbagai destinasi impianmu tanpa ribet, langsung dari genggaman.</p>
        </div>
    </header>

    <section class="max-w-5xl mx-auto px-4 -mt-12 relative z-10">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 sm:p-8">
            <form action="{{ route('tickets.search') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                
                <div>
                    <label for="origin" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Kota Asal</label>
                    <select name="origin" id="origin" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" required>
                        <option value="">Pilih Asal...</option>
                        @foreach($origins as $origin)
                            <option value="{{ $origin }}">{{ $origin }}</option>
                        @endforeach
                        @if($origins->isEmpty())
                            <option value="Surabaya">Surabaya</option>
                            <option value="Jombang">Jombang</option>
                            <option value="Bekasi">Bekasi</option>
                        @endif
                    </select>
                </div>

                <div>
                    <label for="destination" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Kota Tujuan</label>
                    <select name="destination" id="destination" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" required>
                        <option value="">Pilih Tujuan...</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination }}">{{ $destination }}</option>
                        @endforeach
                        @if($destinations->isEmpty())
                            <option value="Surabaya">Surabaya</option>
                            <option value="Jombang">Jombang</option>
                            <option value="Bekasi">Bekasi</option>
                        @endif
                    </select>
                </div>

                <div>
                    <label for="departure_date" class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tanggal Berangkat</label>
                    <input type="date" name="departure_date" id="departure_date" min="{{ date('Y-m-d') }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition" required>
                </div>

                <div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm py-3.5 px-4 rounded-xl shadow-md shadow-blue-200 transition flex justify-center items-center gap-2">
                        Cari Jadwal Bus
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900">Apa Kata Mereka?</h2>
            <p class="text-gray-500 mt-2 text-sm sm:text-base">Pengalaman nyata dari para penumpang setia LokaBus.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex items-center gap-1 text-amber-400 mb-3">★★★★★</div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">"Pesan tiket rute Surabaya-Jombang lancar banget tanpa kendala. Konfirmasi pembayarannya juga cepat sekali."</p>
                <div class="font-semibold text-sm text-gray-800">— Rian K.</div>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex items-center gap-1 text-amber-400 mb-3">★★★★★</div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">"Tampilan mobilenya bersih banget dan gak membingungkan buat orang tua. Fitur pilih kursinya sangat informatif!"</p>
                <div class="font-semibold text-sm text-gray-800">— Siti A.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex items-center gap-1 text-amber-400 mb-3">★★★★★</div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">"Sangat terbantu kalau mau dinas ke luar kota seperti Bekasi, gak perlu antre lagi di terminal tinggal tunjukin e-tiket PDF."</p>
                <div class="font-semibold text-sm text-gray-800">— Budi S.</div>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 border-t border-gray-200/50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900">Artikel & Tips Perjalanan</h2>
                    <p class="text-gray-500 mt-2 text-sm sm:text-base">Informasi rute dan tips menarik seputar perjalanan darat.</p>
                </div>
                <a href="#" class="text-sm font-semibold text-blue-600 hover:text-blue-700 transition hidden sm:block">Lihat Semua Artikel &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestArticles as $article)
                    <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="h-48 bg-gray-200 relative">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-400 font-bold">LokaBus</div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-lg text-gray-900 line-clamp-2 hover:text-blue-600 transition mb-2">
                                <a href="#">{{ $article->title }}</a>
                            </h3>
                            <p class="text-gray-500 text-xs mb-4">Ditulis oleh {{ $article->author->name }} &bull; {{ $article->created_at->diffForHumans() }}</p>
                            <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                            <a href="#" class="text-xs font-bold text-blue-600 hover:underline">Baca Selengkapnya</a>
                        </div>
                    </article>
                @empty
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 p-6 md:col-span-3 text-center text-gray-500 py-12">
                        Belum ada artikel yang diterbitkan. Data dummy akan muncul setelah CMS diaktifkan.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-100 py-8 text-center text-xs text-gray-400">
        <p>&copy; {{ date('Y') }} LokaBus. Seluruh Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>