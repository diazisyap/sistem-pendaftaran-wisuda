@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <div class="text-center">
        <h2 class="text-3xl font-black text-gray-800 tracking-tight">Presensi Kehadiran</h2>
        <p class="text-gray-500 font-medium text-sm">Scan QR Code pada tiket atau dashboard mahasiswa untuk mencatat kehadiran.</p>
    </div>

    <!-- Scanner Section -->
    <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 flex flex-col items-center">
        <div id="reader" class="w-full max-w-lg overflow-hidden rounded-[2rem] border-4 border-gray-50 mb-8 aspect-square"></div>
        
        <div class="space-y-4 w-full max-w-md">
            <div id="result-card" class="hidden p-6 rounded-3xl border transition-all duration-300 transform scale-95 opacity-0">
                <div class="flex items-center gap-4">
                    <div id="result-icon" class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl"></div>
                    <div>
                        <h4 id="result-title" class="font-black text-gray-800">Menunggu Scan...</h4>
                        <p id="result-message" class="text-xs font-medium text-gray-500">Arahkan kamera ke QR Code.</p>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <button onclick="startScanner()" class="flex-1 py-4 bg-[#0b3c39] text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-emerald-900/20 hover:scale-[1.02] transition-all">
                    <i class="fas fa-play mr-2"></i> Start Camera
                </button>
                <button onclick="stopScanner()" class="flex-1 py-4 bg-gray-50 text-gray-400 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-100 transition-all">
                    <i class="fas fa-stop mr-2"></i> Stop
                </button>
            </div>
        </div>
    </div>

    <!-- Recent Scans -->
    <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100">
        <h4 class="font-black text-gray-800 text-lg mb-6">Presensi Terbaru</h4>
        <div class="space-y-4" id="recent-scans">
            @php
                $recent = \App\Models\Kehadiran::with('pendaftaran')->latest()->take(5)->get();
            @endphp
            @foreach($recent as $scan)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#0b3c39] border border-gray-100 shadow-sm">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">{{ $scan->pendaftaran->nama_mahasiswa }}</p>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">{{ $scan->pendaftaran->nim }}</p>
                    </div>
                </div>
                <p class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg uppercase tracking-widest">{{ $scan->waktu_hadir->format('H:i') }}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    let html5QrcodeScanner = null;

    function startScanner() {
        if (html5QrcodeScanner) return;
        
        html5QrcodeScanner = new Html5Qrcode("reader");
        const config = { fps: 10, qrbox: { width: 250, height: 250 } };

        html5QrcodeScanner.start(
            { facingMode: "environment" }, 
            config,
            onScanSuccess
        );
    }

    function stopScanner() {
        if (html5QrcodeScanner) {
            html5QrcodeScanner.stop().then(() => {
                html5QrcodeScanner = null;
                document.getElementById('reader').innerHTML = '';
            }).catch(err => console.error(err));
        }
    }

    function onScanSuccess(decodedText, decodedResult) {
        // Send to backend
        fetch("{{ route('admin.scan.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ qr_token: decodedText })
        })
        .then(response => response.json())
        .then(data => {
            showResult(data);
            if (data.success) {
                addToRecent(data);
            }
        })
        .catch(err => {
            showResult({ success: false, message: "Terjadi kesalahan sistem." });
        });
    }

    function showResult(data) {
        const card = document.getElementById('result-card');
        const icon = document.getElementById('result-icon');
        const title = document.getElementById('result-title');
        const message = document.getElementById('result-message');

        card.classList.remove('hidden', 'bg-emerald-50', 'bg-red-50', 'border-emerald-100', 'border-red-100', 'scale-95', 'opacity-0');
        
        if (data.success) {
            card.classList.add('bg-emerald-50', 'border-emerald-100');
            icon.className = 'w-12 h-12 rounded-2xl flex items-center justify-center text-xl bg-emerald-600 text-white';
            icon.innerHTML = '<i class="fas fa-check"></i>';
            title.innerText = data.nama;
            message.innerText = data.message;
        } else {
            card.classList.add('bg-red-50', 'border-red-100');
            icon.className = 'w-12 h-12 rounded-2xl flex items-center justify-center text-xl bg-red-500 text-white';
            icon.innerHTML = '<i class="fas fa-times"></i>';
            title.innerText = "Gagal Presensi";
            message.innerText = data.message;
        }

        setTimeout(() => {
            card.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function addToRecent(data) {
        const container = document.getElementById('recent-scans');
        const now = new Date();
        const timeStr = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');
        
        const html = `
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100 animate-in slide-in-from-top duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-[#0b3c39] border border-gray-100 shadow-sm">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">${data.nama}</p>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">${data.nim}</p>
                    </div>
                </div>
                <p class="text-[10px] font-black text-emerald-600 bg-emerald-50 px-3 py-1 rounded-lg uppercase tracking-widest">${timeStr}</p>
            </div>
        `;
        container.insertAdjacentHTML('afterbegin', html);
        if (container.children.length > 5) {
            container.lastElementChild.remove();
        }
    }
</script>
@endsection
