@props([
    'title' => null,
    'subtitle' => null,
    'icon' => null,
    'badge' => null,
    'badgeColor' => 'blue',
    'variant' => 'default',
    'header' => null,
    'footer' => null,
    'action' => null,
])

@php
    $variantClasses = match($variant) {
        'highlighted' => 'bg-gradient-to-br from-blue-50/80 via-white to-indigo-50/40 border-blue-200/80 text-slate-800 shadow-sm hover:shadow-md',
        'dark' => 'bg-slate-900/95 border-slate-800 text-slate-100 shadow-sm hover:border-slate-700',
        'subtle' => 'bg-slate-50/80 border-slate-200 text-slate-800',
        'bordered' => 'bg-white border-2 border-slate-200 text-slate-800 shadow-none',
        'emerald' => 'bg-emerald-50/50 border-emerald-200 text-slate-800 shadow-sm',
        'amber' => 'bg-amber-50/50 border-amber-200 text-slate-800 shadow-sm',
        default => 'bg-white border-slate-200 text-slate-800 shadow-sm hover:shadow-md',
    };

    $badgeColorClasses = match($badgeColor) {
        'emerald', 'green' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
        'indigo', 'purple' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
        'amber', 'yellow' => 'bg-amber-100 text-amber-800 border-amber-200',
        'rose', 'red' => 'bg-rose-100 text-rose-800 border-rose-200',
        'slate', 'gray' => 'bg-slate-100 text-slate-700 border-slate-200',
        'dark' => 'bg-slate-800 text-slate-200 border-slate-700',
        default => 'bg-blue-100 text-blue-800 border-blue-200',
    };

    $iconBgClasses = match($variant) {
        'dark' => 'bg-slate-800 text-cyan-400 border border-slate-700',
        'highlighted' => 'bg-blue-600 text-white shadow-sm',
        'emerald' => 'bg-emerald-600 text-white shadow-sm',
        'amber' => 'bg-amber-600 text-white shadow-sm',
        default => 'bg-blue-50 text-blue-700 border border-blue-100',
    };
@endphp

<div {{ $attributes->merge(['class' => "rounded-2xl border transition-all duration-200 flex flex-col p-6 {$variantClasses}"]) }}>
    {{-- Optional Custom Header Slot or Default Robust Header --}}
    @if (isset($header))
        <div class="mb-4 pb-3 border-b border-inherit">
            {{ $header }}
        </div>
    @elseif ($title || $icon || $badge || isset($action))
        <div class="space-y-3 mb-4">
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-start gap-3.5 min-w-0 flex-1">
                    @if ($icon)
                        <div class="shrink-0 w-10 h-10 rounded-xl flex items-center justify-center font-medium mt-0.5 {{ $iconBgClasses }}">
                            @if ($icon === 'academic')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                            @elseif ($icon === 'user')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            @elseif ($icon === 'cpu' || $icon === 'bot')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                            @elseif ($icon === 'book')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            @elseif ($icon === 'sparkles')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                            @elseif ($icon === 'code')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            @elseif ($icon === 'calendar')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            @elseif ($icon === 'check')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @else
                                <span class="text-sm font-bold uppercase">{{ substr($icon, 0, 2) }}</span>
                            @endif
                        </div>
                    @endif
                    <div class="min-w-0 flex-1">
                        @if ($title)
                            <h3 class="text-base sm:text-lg font-bold tracking-tight leading-snug break-words">{{ $title }}</h3>
                        @endif
                        @if ($subtitle)
                            <p class="text-xs text-inherit opacity-75 mt-1 leading-relaxed break-words">{{ $subtitle }}</p>
                        @endif
                    </div>
                </div>

                @if (isset($action))
                    <div class="shrink-0 self-start">
                        {{ $action }}
                    </div>
                @endif
            </div>

            @if ($badge)
                <div class="flex items-center gap-2 flex-wrap pt-0.5">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border {{ $badgeColorClasses }}">
                        {{ $badge }}
                    </span>
                </div>
            @endif
        </div>
    @endif

    {{-- Main Slot Body Content --}}
    <div class="flex-1 text-sm leading-relaxed">
        {{ $slot }}
    </div>

    {{-- Optional Named Footer Slot --}}
    @if (isset($footer))
        <div class="mt-4 pt-3 border-t border-inherit border-opacity-20 text-xs text-inherit opacity-90">
            {{ $footer }}
        </div>
    @endif
</div>
