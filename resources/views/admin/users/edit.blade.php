@extends('admin.layouts.app')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')
@section('page-subtitle', 'Perbarui informasi akun pengguna')

@section('content')

<div class="max-w-2xl">

    {{-- Back Button --}}
    <a href="{{ route('admin.users') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-slate-200 transition mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar User
    </a>

    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 md:p-8 shadow-xl">

        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-slate-800">
            <div class="w-14 h-14 rounded-2xl {{ $user->role === 'admin' ? 'bg-red-500/20 text-red-400 border border-red-500/30' : 'bg-slate-800 text-slate-300' }} font-bold flex items-center justify-center text-xl">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-lg font-bold text-white">{{ $user->name }}</h2>
                <p class="text-sm text-slate-400">{{ $user->email }}</p>
                <span class="mt-1 inline-block px-2 py-0.5 {{ $user->role === 'admin' ? 'bg-red-500/10 text-red-400 border-red-500/20' : 'bg-blue-500/10 text-blue-400 border-blue-500/20' }} border text-[10px] font-semibold rounded-full uppercase">{{ $user->role }}</span>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-4 py-3 bg-slate-950 border @error('name') border-red-500 @else border-slate-700 @enderror rounded-xl text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                @error('name')
                    <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-4 py-3 bg-slate-950 border @error('email') border-red-500 @else border-slate-700 @enderror rounded-xl text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                @error('email')
                    <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase mb-2">Role / Hak Akses</label>
                <select name="role"
                        class="w-full px-4 py-3 bg-slate-950 border @error('role') border-red-500 @else border-slate-700 @enderror rounded-xl text-sm text-slate-200 focus:outline-none focus:ring-2 focus:ring-red-500 transition">
                    <option value="user"  {{ old('role', $user->role) === 'user'  ? 'selected' : '' }}>User (Pengguna Biasa)</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin (Administrator)</option>
                </select>
                @error('role')
                    <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password (opsional) --}}
            <div class="pt-2 border-t border-slate-800">
                <p class="text-xs text-slate-500 mb-4">Kosongkan kolom password jika tidak ingin mengubah password.</p>
                <div class="space-y-5">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase mb-2">Password Baru (Opsional)</label>
                        <input type="password" name="password"
                               class="w-full px-4 py-3 bg-slate-950 border @error('password') border-red-500 @else border-slate-700 @enderror rounded-xl text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-red-500 transition"
                               placeholder="••••••••">
                        @error('password')
                            <p class="text-xs text-red-400 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 uppercase mb-2">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation"
                               class="w-full px-4 py-3 bg-slate-950 border border-slate-700 rounded-xl text-sm text-slate-200 placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-red-500 transition"
                               placeholder="••••••••">
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-xl transition text-sm shadow-lg shadow-red-600/30">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.users') }}"
                   class="px-6 py-3 bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold rounded-xl transition text-sm border border-slate-700">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection