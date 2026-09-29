<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Laravel 12</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-slate-900 border border-slate-800 rounded-2xl p-8 shadow-2xl">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-white">Selamat Datang</h1>
            <p class="text-sm text-slate-400 mt-1">Silakan masuk ke akun Anda</p>
        </div>

        <!-- Pesan Success Flash -->
        @if (session('success'))
            <div class="mb-4 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf  <!-- Directive wajib CSRF Token Laravel -->

            <!-- Email -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 bg-slate-950 border @error('email') border-red-500 @else border-slate-800 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="nama@email.com">
                
                @error('email')
                    <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase mb-2">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 bg-slate-950 border @error('password') border-red-500 @else border-slate-800 @enderror rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="••••••••">
                
                @error('password')
                    <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded bg-slate-950 border-slate-800 text-red-500">
                    <span class="text-slate-300">Ingat Saya</span>
                </label>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="w-full py-3.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl transition text-sm shadow-lg shadow-red-600/30">
                Masuk
            </button>
        </form>

        <!-- Footer Link -->
        <div class="text-center mt-6 text-xs text-slate-400">
            Belum memiliki akun? 
            <a href="{{ route('register') }}" class="text-red-400 hover:underline font-semibold">Daftar sekarang</a>
        </div>
    </div>

</body>
</html>