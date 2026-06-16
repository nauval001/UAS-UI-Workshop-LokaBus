<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pilih Kursi - LokaBus</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans pb-24 sm:pb-8">

    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center gap-4">
            <a href="javascript:history.back()" class="text-gray-500 hover:text-blue-600 transition font-medium">
                &larr; Kembali
            </a>
            <div class="h-6 w-px bg-gray-200"></div>
            <span class="font-bold text-gray-800">Detail Perjalanan & Pilih Kursi</span>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="flex items-center justify-center mb-10 hidden sm:flex">
            <div class="flex items-center text-sm font-medium">
                <span class="flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded-full">1</span>
                <span class="ml-2 text-gray-900">Pilih Bus</span>
                <div class="w-12 h-px bg-blue-600 mx-4"></div>
                
                <span class="flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded-full shadow-md ring-4 ring-blue-100">2</span>
                <span class="ml-2 text-blue-600 font-bold">Pilih Kursi</span>
                <div class="w-12 h-px bg-gray-300 mx-4"></div>
                
                <span class="flex items-center justify-center w-8 h-8 bg-gray-200 text-gray-500 rounded-full">3</span>
                <span class="ml-2 text-gray-500">Pembayaran</span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <span>💺</span> Pilih Kursi Anda
                </h2>

                <div class="flex flex-wrap items-center gap-6 mb-8 text-sm text-gray-600 justify-center sm:justify-start border-b border-gray-100 pb-6">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 border-2 border-gray-300 rounded-md bg-white"></div> Tersedia
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-gray-200 rounded-md text-center text-xs text-gray-400 flex justify-center items-center">X</div> Terisi
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-blue-600 shadow-md shadow-blue-200 rounded-md border-2 border-blue-600 text-white flex justify-center items-center text-xs">✓</div> Pilihanmu
                    </div>
                </div>

                <div class="max-w-xs mx-auto bg-gray-50 border-2 border-gray-200 rounded-3xl p-6 relative">
                    <div class="flex justify-end mb-8 border-b-2 border-gray-200 pb-4">
                        <div class="w-10 h-10 border-2 border-gray-300 rounded-full flex items-center justify-center text-gray-400 text-xl" title="Sopir">
                             steering_wheel
                        </div>
                    </div>

                    <div class="grid grid-cols-5 gap-y-4 gap-x-2">
                        @for($i = 1; $i <= 10; $i++)
                            <button class="seat-btn w-10 h-10 border-2 border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition flex items-center justify-center text-xs font-bold text-gray-600" data-seat="{{ $i }}A">
                                {{ $i }}A
                            </button>
                            <button class="seat-btn w-10 h-10 border-2 border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition flex items-center justify-center text-xs font-bold text-gray-600" data-seat="{{ $i }}B">
                                {{ $i }}B
                            </button>
                            
                            <div class="w-6"></div>

                            @if($i == 3 && rand(0,1)) <div class="w-10 h-10 bg-gray-200 rounded-lg flex items-center justify-center text-xs font-bold text-gray-400 cursor-not-allowed">X</div>
                            @else
                                <button class="seat-btn w-10 h-10 border-2 border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition flex items-center justify-center text-xs font-bold text-gray-600" data-seat="{{ $i }}C">
                                    {{ $i }}C
                                </button>
                            @endif

                            <button class="seat-btn w-10 h-10 border-2 border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition flex items-center justify-center text-xs font-bold text-gray-600" data-seat="{{ $i }}D">
                                {{ $i }}D
                            </button>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl shadow-blue-900/5 border border-gray-100 p-6 sticky top-24">
                    <h3 class="font-bold text-gray-900 mb-4 pb-4 border-b border-gray-100">Ringkasan Perjalanan</h3>
                    
                    <div class="mb-6 space-y-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Keberangkatan</p>
                            <p class="font-bold text-gray-900 text-lg">{{ $schedule->origin }}</p>
                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($schedule->departure_time)->translatedFormat('l, d F Y - H:i') }}</p>
                        </div>
                        <div class="pl-2 border-l-2 border-dashed border-gray-300 py-1">
                            <span class="text-xs text-gray-400">Durasi: {{ \Carbon\Carbon::parse($schedule->departure_time)->diffInHours(\Carbon\Carbon::parse($schedule->arrival_time)) }} Jam</span>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Tujuan</p>
                            <p class="font-bold text-gray-900 text-lg">{{ $schedule->destination }}</p>
                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($schedule->arrival_time)->translatedFormat('l, d F Y - H:i') }}</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl mb-6">
                        <p class="font-bold text-gray-900">{{ $schedule->bus->name ?? 'Armada LokaBus' }} <span class="text-xs font-normal bg-amber-100 text-amber-800 px-2 py-0.5 rounded ml-1">{{ $schedule->bus->class ?? 'VIP' }}</span></p>
                        <p class="text-xs text-gray-500 mt-1">{{ $schedule->bus->facilities ?? 'AC, Reclining Seat' }}</p>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Harga per tiket</span>
                            <span class="font-semibold text-gray-900" id="base-price" data-price="{{ $schedule->price }}">Rp {{ number_format($schedule->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Kursi Terpilih</span>
                            <span class="font-bold text-blue-600" id="selected-seats-label">-</span>
                        </div>
                        <div class="pt-4 border-t border-gray-100 flex justify-between items-end">
                            <span class="font-bold text-gray-900">Total Harga</span>
                            <span class="text-2xl font-extrabold text-blue-600" id="total-price">Rp 0</span>
                        </div>
                    </div>

                    <form action="#" method="POST" id="checkout-form">
                        @csrf
                        <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                        <input type="hidden" name="selected_seats" id="selected-seats-input" required>
                        
                        <p id="warning-msg" class="text-xs text-red-500 text-center mb-3 hidden">Silakan pilih minimal 1 kursi untuk melanjutkan.</p>
                        
                        <button type="submit" id="btn-checkout" class="w-full bg-gray-300 text-gray-500 font-bold py-3.5 px-4 rounded-xl transition cursor-not-allowed" disabled>
                            Lanjut ke Pembayaran
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seats = document.querySelectorAll('.seat-btn');
            const selectedSeatsLabel = document.getElementById('selected-seats-label');
            const selectedSeatsInput = document.getElementById('selected-seats-input');
            const totalPriceLabel = document.getElementById('total-price');
            const basePrice = parseInt(document.getElementById('base-price').dataset.price);
            const btnCheckout = document.getElementById('btn-checkout');
            const warningMsg = document.getElementById('warning-msg');

            let selectedSeats = [];

            seats.forEach(seat => {
                seat.addEventListener('click', function() {
                    const seatNumber = this.dataset.seat;

                    if (selectedSeats.includes(seatNumber)) {
                        // Batalkan pilihan
                        selectedSeats = selectedSeats.filter(s => s !== seatNumber);
                        this.classList.remove('bg-blue-600', 'text-white', 'border-blue-600', 'shadow-md');
                        this.classList.add('bg-white', 'text-gray-600', 'border-gray-300');
                    } else {
                        // Pilih kursi (Batas maks misal 4 kursi)
                        if (selectedSeats.length >= 4) {
                            alert('Maksimal pemesanan adalah 4 kursi per transaksi.');
                            return;
                        }
                        selectedSeats.push(seatNumber);
                        this.classList.remove('bg-white', 'text-gray-600', 'border-gray-300');
                        this.classList.add('bg-blue-600', 'text-white', 'border-blue-600', 'shadow-md');
                    }

                    updateSummary();
                });
            });

            function updateSummary() {
                // Update Label
                selectedSeatsLabel.textContent = selectedSeats.length > 0 ? selectedSeats.join(', ') : '-';
                
                // Update Input Hidden form
                selectedSeatsInput.value = selectedSeats.join(',');

                // Update Total Harga
                const total = selectedSeats.length * basePrice;
                totalPriceLabel.textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(total);

                // Validasi Tombol Checkout
                if (selectedSeats.length > 0) {
                    btnCheckout.disabled = false;
                    btnCheckout.classList.remove('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                    btnCheckout.classList.add('bg-blue-600', 'text-white', 'hover:bg-blue-700', 'shadow-lg', 'shadow-blue-200');
                    warningMsg.classList.add('hidden');
                } else {
                    btnCheckout.disabled = true;
                    btnCheckout.classList.add('bg-gray-300', 'text-gray-500', 'cursor-not-allowed');
                    btnCheckout.classList.remove('bg-blue-600', 'text-white', 'hover:bg-blue-700', 'shadow-lg', 'shadow-blue-200');
                }
            }
            
            // Tampilkan warning jika tombol diklik dalam keadaan disabled
            btnCheckout.parentElement.addEventListener('click', function(e){
                if(btnCheckout.disabled) {
                    e.preventDefault();
                    warningMsg.classList.remove('hidden');
                }
            });
        });
    </script>
</body>
</html>