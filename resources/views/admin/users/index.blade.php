@extends('admin.layouts.app')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')
@section('page-subtitle', 'Kelola semua pengguna yang terdaftar')

@section('content')

{{-- Flash Messages --}}
@if (session('success'))
    <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm flex items-center gap-3">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm flex items-center gap-3">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        {{ session('error') }}
    </div>
@endif

{{-- Header + Search --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-lg font-bold text-white">Daftar Pengguna</h2>
        <p class="text-xs text-slate-500 mt-0.5">Total {{ $users->total() }} pengguna ditemukan</p>
    </div>
    <form action="{{ route('admin.users') }}" method="GET" class="flex items-center gap-2">
        <input type="text" name="search" value="{{ $search }}"
               placeholder="Cari nama atau email..."
               class="px-4 py-2 bg-slate-900 border border-slate-700 rounded-xl text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-red-500 w-64">
        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl transition shadow-lg shadow-red-600/20">Cari</button>
        @if($search)
            <a href="{{ route('admin.users') }}" class="px-3 py-2 bg-slate-800 hover:bg-slate-700 text-slate-400 text-sm rounded-xl transition">Reset</a>
        @endif
    </form>
</div>

{{-- Table --}}
<div class="bg-slate-900 border border-slate-800 rounded-2xl shadow-xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-800 bg-slate-900/50">
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-slate-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Pengguna</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Bergabung</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/50">
                @forelse ($users as $index => $user)
                    <tr class="hover:bg-slate-800/30 transition">
                        <td class="px-6 py-4 text-slate-600 text-xs">{{ $users->firstItem() + $index }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full {{ $user->role === 'admin' ? 'bg-red-500/20 text-red-400 border border-red-500/30' : 'bg-slate-700 text-slate-300' }} font-semibold flex items-center justify-center text-xs shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-slate-200 font-medium">{{ $user->name }}</p>
                                    @if($user->id === auth()->id())
                                        <p class="text-[10px] text-emerald-400">(Akun Anda)</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-400">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if($user->role === 'admin')
                                <span class="px-2 py-0.5 bg-red-500/10 text-red-400 border border-red-500/20 text-[10px] font-semibold rounded-full uppercase">Admin</span>
                            @else
                                <span class="px-2 py-0.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-[10px] font-semibold rounded-full uppercase">User</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-medium rounded-lg border border-slate-700 hover:border-slate-600 transition">
                                    Edit
                                </a>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.delete', $user) }}" method="POST"
                                          onsubmit="return confirm('Hapus pengguna {{ $user->name }}? Tindakan ini tidak dapat dibatalkan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 text-xs font-medium rounded-lg border border-red-500/20 hover:border-red-500/40 transition">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500 text-sm">
                            <svg class="w-10 h-10 mx-auto mb-3 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Tidak ada pengguna yang ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- Pagination --}}
    @if($users->hasPages())
        <div class="px-6 py-4 border-t border-slate-800">
            {{ $users->withQueryString()->links('pagination::tailwind') }}
        </div>
    @endif
</div>

@endsection