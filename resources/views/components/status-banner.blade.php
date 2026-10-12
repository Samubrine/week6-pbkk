@props([
    'type' => 'info',
    'title' => null,
    'badgeText' => null,
    'dismissible' => false,
    'action' => null,
])

@php
    $typeConfig = match($type) {
        'success' => [
            'wrapper' => 'bg-emerald-50 border-emerald-200 text-emerald-950',
            'iconBg' => 'bg-emerald-100 text-emerald-600',
            'badge' => 'Sukses',
            'badgeClass' => 'bg-emerald-200/70 text-emerald-900',
        ],
        'warning' => [
            'wrapper' => 'bg-amber-50 border-amber-200 text-amber-950',
            'iconBg' => 'bg-amber-100 text-amber-600',
            'badge' => 'Perhatian',
            'badgeClass' => 'bg-amber-200/70 text-amber-900',
        ],
        'error', 'danger' => [
            'wrapper' => 'bg-rose-50 border-rose-200 text-rose-950',
            'iconBg' => 'bg-rose-100 text-rose-600',
            'badge' => 'Kesalahan',
            'badgeClass' => 'bg-rose-200/70 text-rose-900',
        ],
        'welcome' => [
            'wrapper' => 'bg-gradient-to-r from-indigo-50 via-blue-50 to-cyan-50 border-indigo-200 text-indigo-950 shadow-sm',
            'iconBg' => 'bg-indigo-600 text-white shadow-sm',
            'badge' => 'Pengunjung',
            'badgeClass' => 'bg-indigo-100 text-indigo-800',
        ],
        'mode', 'dark_mode' => [
            'wrapper' => 'bg-slate-900 border-2 border-cyan-600/80 text-cyan-100 shadow-xl',
            'iconBg' => 'bg-cyan-950 text-cyan-300 border border-cyan-700',
            'badge' => 'Dark Mode',
            'badgeClass' => 'bg-cyan-950 text-cyan-300 border border-cyan-700 font-semibold',
        ],
        default => [
            'wrapper' => 'bg-blue-50 border-blue-200 text-blue-950',
            'iconBg' => 'bg-blue-100 text-blue-600',
            'badge' => 'Informasi',
            'badgeClass' => 'bg-blue-200/70 text-blue-900',
        ],
    };

    $activeBadge = $badgeText ?? $typeConfig['badge'];
@endphp

<div {{ $attributes->merge(['class' => "relative rounded-2xl border p-4 sm:p-5 flex flex-col sm:flex-row items-start gap-4 transition-all duration-200 {$typeConfig['wrapper']}"]) }} role="alert">
    {{-- Icon --}}
    <div class="shrink-0 w-9 h-9 sm:w-10 sm:h-10 rounded-xl flex items-center justify-center {{ $typeConfig['iconBg'] }}">
        @if ($type === 'success')
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        @elseif ($type === 'warning')
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        @elseif ($type === 'error' || $type === 'danger')
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        @elseif ($type === 'welcome')
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        @elseif ($type === 'mode' || $type === 'dark_mode')
            <span class="text-base">🌙</span>
        @else
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        @endif
    </div>

    {{-- Content --}}
    <div class="flex-1 min-w-0">
        <div class="flex items-center gap-2 mb-1.5 flex-wrap">
            @if ($title)
                <h4 class="text-sm sm:text-base font-bold tracking-tight">{{ $title }}</h4>
            @endif
            @if ($activeBadge)
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold {{ $typeConfig['badgeClass'] }}">
                    {{ $activeBadge }}
                </span>
            @endif
        </div>
        <div class="text-xs sm:text-sm leading-relaxed opacity-95 break-words">
            {{ $slot }}
        </div>
    </div>

    {{-- Optional Action Slot --}}
    @if (isset($action))
        <div class="shrink-0 self-start sm:self-center mt-2 sm:mt-0">
            {{ $action }}
        </div>
    @endif
</div>
