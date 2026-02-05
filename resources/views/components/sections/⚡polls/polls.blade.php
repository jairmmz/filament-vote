<section class="mx-auto max-w-7xl px-6 py-16">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-6">
        <div>
            <span class="inline-block px-4 py-1 rounded-full bg-slate-900/5 dark:bg-white/10 text-slate-700 dark:text-white text-sm font-semibold mb-4">
                Encuestas Destacadas
            </span>
            <h2 class="text-3xl lg:text-4xl font-bold text-slate-900 dark:text-white">
                Participa y haz escuchar tu voz
            </h2>
        </div>

        <a href="{{ route('polls') }}"
           class="self-start sm:self-auto inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-300 dark:border-white/20 text-slate-700 dark:text-white hover:bg-slate-100 dark:hover:bg-white/10 transition"
           wire:navigate>
            Ver todas las encuestas
            <flux:icon.chevron-right />
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        @foreach($polls as $poll)
            <div class="group rounded-2xl overflow-hidden border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-900 shadow-sm hover:shadow-lg flex flex-col">
                <div class="h-40 relative overflow-hidden">

                    @if($poll->image)
                        <img src="{{ Storage::disk('polls')->url($poll->image) }}"
                            alt="{{ $poll->title }}"
                            class="absolute inset-0 w-full h-full object-cover">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-black/10"></div>
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-700"></div>
                    @endif

                    <div class="absolute top-4 left-4 flex flex-wrap gap-2 z-10">
                        <span class="px-3 py-1 rounded-full bg-white/90 dark:bg-slate-900/90 backdrop-blur text-xs font-semibold text-slate-800 dark:text-white">
                            {{ $poll->category->name }}
                        </span>

                        @if($poll->status === 'activo')
                            <span class="px-3 py-1 rounded-full bg-emerald-500 text-white text-xs font-semibold shadow">
                                Activo
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-slate-700 text-white text-xs font-semibold shadow">
                                Cerrado
                            </span>
                        @endif
                    </div>

                    <div class="absolute top-4 right-4 z-10">
                        <span class="px-3 py-1 rounded-full bg-black/60 text-white text-xs font-semibold backdrop-blur">
                            {{ number_format($poll->votes_count) }} {{ \Illuminate\Support\Str::plural('voto', $poll->votes_count) }}
                        </span>
                    </div>

                </div>

                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 line-clamp-2 transition">
                        {{ $poll->title }}
                    </h3>

                    <div class="flex flex-wrap gap-4 text-sm text-slate-500 dark:text-slate-400 mb-4">
                        <div class="flex items-center gap-1">
                            <flux:icon.map-pin class="w-6 h-6" />
                            {{ $poll->location }}
                        </div>

                        @if($poll->ends_at)
                        <div class="flex items-center gap-1">
                            <flux:icon.calendar-1 class="w-6 h-6" />
                            Finaliza el {{ $poll->ends_at->format('d/m/Y') }}
                        </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-3 mb-5">
                        <div class="flex -space-x-2">
                            @foreach($poll->candidates->take(3) as $candidate)
                                @php
                                    $initials = collect(explode(' ', $candidate->name))->map(fn($n) => substr($n, 0, 1))->take(2)->join('');
                                    $color = $candidate->politicalParty?->color ?? '#64748b';
                                @endphp
                                <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-sm font-bold border-2 border-white dark:border-slate-900"
                                    style="color: {{ $color }};">
                                    {{ $initials }}
                                </div>
                            @endforeach
                        </div>
                        <span class="text-sm text-slate-500 dark:text-slate-400">
                            {{ $poll->candidates->count() }} {{ \Illuminate\Support\Str::plural('candidato', $poll->candidates->count()) }}
                        </span>
                    </div>

                    <div class="mt-auto flex gap-2">
                        <a href="{{ route('polls.show', $poll->slug) }}"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-slate-900 text-white dark:bg-white dark:text-slate-900 font-semibold hover:opacity-90 transition"
                        wire:navigate>
                            Ver Encuesta
                        </a>
                        <button class="p-2 rounded-lg border border-slate-300 dark:border-white/20 hover:bg-slate-100 dark:hover:bg-white/10 transition">
                            <flux:icon.share-2 />
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
