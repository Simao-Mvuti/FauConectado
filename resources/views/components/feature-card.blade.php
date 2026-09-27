@props(['icon', 'title', 'description'])

<div class="bg-white/5 border border-white/10 rounded-xl p-4 flex items-start gap-3 sm:gap-4 hover:bg-white/10 transition">
    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-lg bg-white/10 text-white flex items-center justify-center font-bold text-base sm:text-lg shrink-0">
        {{ $icon }}
    </div>
    <div>
        <h4 class="font-bold text-xs sm:text-sm text-white">{{ $title }}</h4>
        <p class="text-xs text-white/70 mt-0.5 leading-relaxed">{{ $description }}</p>
    </div>
</div>