<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex">

    <!-- SIDEBAR -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 border-r border-slate-800 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
        
        <!-- Logo -->
        <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-800">
            <div class="w-9 h-9 bg-red-600 rounded-xl flex items-center justify-center font-bold text-white text-lg shadow-lg shadow-red-600/30">A</div>
            <div>
                <p class="text-sm font-bold text-white leading-tight">Admin Panel</p>
                <p class="text-[10px] text-slate-500">Projek Laravel</p>
            </div>
        </div>

        <!-- Navigasi -->
        <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
            <p class="text-[10px] uppercase font-semibold text-slate-600 px-3 pt-2 pb-1 tracking-widest">Menu Utama</p>

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-red-600/20 text-red-400 border border-red-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <a href="{{ route('admin.users') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition duration-200 {{ request()->routeIs('admin.users*') ? 'bg-red-600/20 text-red-400 border border-red-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-200' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Manajemen User
            </a>

            <div class="pt-4">
                <p class="text-[10px] uppercase font-semibold text-slate-600 px-3 pb-1 tracking-widest">Akun</p>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:bg-slate-800 hover:text-slate-200 transition duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil Saya
                </a>
            </div>
        </nav>

        <!-- Logout di Sidebar -->
        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center gap-3 mb-3 px-1">
                <div class="w-8 h-8 rounded-full bg-red-500/20 text-red-400 font-bold flex items-center justify-center text-sm border border-red-500/30">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-semibold text-slate-200 truncate">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-[10px] text-slate-500 truncate">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-semibold text-slate-400 hover:bg-red-600/10 hover:text-red-400 border border-slate-700 hover:border-red-500/30 transition duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay Mobile -->
    <div id="overlay" class="fixed inset-0 z-40 bg-black/60 lg:hidden hidden" onclick="toggleSidebar()"></div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col lg:ml-64 min-h-screen">

        <!-- Topbar -->
        <header class="sticky top-0 z-30 bg-slate-900/80 backdrop-blur-md border-b border-slate-800 px-6 py-3.5 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button onclick="toggleSidebar()" class="lg:hidden p-1.5 rounded-lg hover:bg-slate-800 text-slate-400 hover:text-slate-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div>
                    <h1 class="text-sm font-semibold text-white">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-[11px] text-slate-500">@yield('page-subtitle', 'Selamat datang di panel admin')</p>
                </div>
            </div>
            <span class="px-2 py-0.5 bg-red-500/10 border border-red-500/20 text-red-400 text-[10px] font-semibold rounded-full uppercase">Admin</span>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6 md:p-8 overflow-y-auto">
            @yield('content')
        </main>

    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

</body>
</html>