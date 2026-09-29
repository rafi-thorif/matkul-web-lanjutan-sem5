<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Aplikasi Laravel 12</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col font-sans">

    <!-- Top Navigation Bar -->
    <nav class="bg-slate-900 border-b border-slate-800 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Logo / Brand -->
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 bg-red-600 rounded-xl flex items-center justify-center font-bold text-white shadow-lg shadow-red-600/30">
                    L
                </div>
                <span class="text-lg font-bold text-white tracking-wide">Projek Laravel</span>
            </div>

            <!-- User Menu & Logout -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3 bg-slate-950 px-4 py-2 rounded-xl border border-slate-800">
                    <div class="w-8 h-8 rounded-full bg-red-500/20 text-red-400 font-semibold flex items-center justify-center text-sm border border-red-500/30">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="text-left hidden sm:block">
                        <p class="text-xs font-semibold text-slate-200">{{ Auth::user()->name ?? 'Pengguna' }}</p>
                        <p class="text-[10px] text-slate-400">{{ Auth::user()->email ?? '' }}</p>
                    </div>
                </div>

                <!-- Form Logout -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                        class="px-4 py-2 bg-slate-800 hover:bg-red-600/20 hover:text-red-400 border border-slate-700 hover:border-red-500/30 text-slate-300 text-xs font-semibold rounded-xl transition duration-200">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-7xl w-full mx-auto p-6 md:p-8 space-y-6">
        
        <!-- Pesan Success Flash -->
        @if (session('success'))
            <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm flex items-center justify-between shadow-lg">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Banner Selamat Datang -->
        <div class="bg-gradient-to-r from-slate-900 via-slate-900 to-red-950/40 border border-slate-800 rounded-2xl p-6 md:p-8 shadow-2xl relative overflow-hidden">
            <div class="relative z-10 max-w-2xl">
                <span class="px-3 py-1 bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-medium rounded-full inline-block mb-3">
                    Pengguna Terautentikasi
                </span>
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">
                    Selamat Datang Kembali, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Anda berhasil masuk ke dalam sistem. Di sini Anda dapat mengelola profil akun dan melihat informasi penting seputar aktivitas Anda.
                </p>
            </div>
            
            <!-- Glow background effect -->
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-red-600/10 rounded-full blur-3xl pointer-events-none"></div>
        </div>

        <!-- Grid Kartu Informasi -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Kartu Status Akun -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Status Akun</span>
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                </div>
                <div>
                    <p class="text-xl font-bold text-white">Aktif</p>
                    <p class="text-xs text-slate-400 mt-1">Terverifikasi di sistem</p>
                </div>
            </div>

            <!-- Kartu Alamat Email -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Email Terdaftar</span>
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-white truncate">{{ Auth::user()->email }}</p>
                    <p class="text-xs text-slate-400 mt-1">Digunakan untuk login</p>
                </div>
            </div>

            <!-- Kartu Tanggal Mendaftar -->
            <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-xl space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Bergabung Pada</span>
                    <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-white">
                        {{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : 'Hari ini' }}
                    </p>
                    <p class="text-xs text-slate-400 mt-1">Tanggal pembuatan akun</p>
                </div>
            </div>

        </div>

        <!-- Section Informasi Detail Akun -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 md:p-8 shadow-xl">
            <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Detail Profil Pengguna
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800">
                    <p class="text-xs text-slate-400 uppercase font-semibold">Nama Lengkap</p>
                    <p class="text-base text-slate-200 font-medium mt-1">{{ Auth::user()->name }}</p>
                </div>

                <div class="bg-slate-950 p-4 rounded-xl border border-slate-800">
                    <p class="text-xs text-slate-400 uppercase font-semibold">Alamat Email</p>
                    <p class="text-base text-slate-200 font-medium mt-1">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

    </main>

</body>
</html>