@extends('admin.layouts.app')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')
@section('page-subtitle', 'Pantau semua pengguna yang terdaftar')

@section('content')
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-lg font-bold text-white">Daftar Pengguna</h2>
        <p class="mt-0.5 text-xs text-slate-500">Total {{ $users->total() }} pengguna ditemukan</p>
    </div>
    <form action="{{ route('admin.users') }}" method="GET" class="flex items-center gap-2">
        <input
            type="search"
            name="search"
            value="{{ $search }}"
            placeholder="Cari nama atau email..."
            aria-label="Cari nama atau email"
            class="w-64 rounded-xl border border-slate-700 bg-slate-900 px-4 py-2 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-red-500"
        >
        <button type="submit" class="rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-700">Cari</button>
        @if ($search !== '')
            <a href="{{ route('admin.users') }}" class="rounded-xl bg-slate-800 px-3 py-2 text-sm text-slate-300 transition hover:bg-slate-700">Reset</a>
        @endif
    </form>
</div>

<div class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900 shadow-xl">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-slate-800 bg-slate-900/50">
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">#</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Pengguna</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Email</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Role</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Bergabung</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/50">
                @forelse ($users as $index => $user)
                    <tr class="transition hover:bg-slate-800/30">
                        <td class="px-6 py-4 text-xs text-slate-600">{{ $users->firstItem() + $index }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full {{ $user->role === 'admin' ? 'border border-red-500/30 bg-red-500/20 text-red-400' : 'bg-slate-700 text-slate-300' }} text-xs font-semibold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-slate-200">{{ $user->name }}</p>
                                    @if ($user->id === auth()->id())
                                        <p class="text-[10px] text-emerald-400">Akun Anda</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-400">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @if ($user->role === 'admin')
                                <span class="rounded-full border border-red-500/20 bg-red-500/10 px-2 py-0.5 text-[10px] font-semibold uppercase text-red-400">Admin</span>
                            @else
                                <span class="rounded-full border border-blue-500/20 bg-blue-500/10 px-2 py-0.5 text-[10px] font-semibold uppercase text-blue-400">User</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-500">{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-500">Tidak ada pengguna yang ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($users->hasPages())
        <div class="border-t border-slate-800 px-6 py-4">
            {{ $users->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection