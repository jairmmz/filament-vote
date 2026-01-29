<section class="mx-auto max-w-7xl px-6 py-16">
    <div class="mb-12 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
            Encuestas Electorales
        </h1>
        <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
            Explora las encuestas electorales más recientes y participa votando por tus candidatos favoritos.
        </p>
    </div>

    <div class="mb-8">
        <flux:input icon="magnifying-glass" wire:model.live.300ms="search" placeholder="Ingrese el nombre de la encuesta a buscar" clearable />
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        @if ($this->polls->isEmpty())
            <p class="text-center text-gray-600 dark:text-gray-300 col-span-full">
                No se encontraron encuestas.
            </p>
        @else
            @foreach($this->polls as $poll)
                <div class="group rounded-2xl overflow-hidden border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-900 shadow-sm hover:shadow-lg flex flex-col">

                    <div class="h-32 relative bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-700">
                        <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                            <span class="px-3 py-1 rounded-full bg-white/80 dark:bg-slate-900/80 backdrop-blur text-xs font-semibold text-slate-800 dark:text-white">
                                {{ $poll->category->name }}
                            </span>

                            @if($poll->status === 'activo')
                                <span class="px-3 py-1 rounded-full bg-emerald-500/15 text-emerald-600 dark:text-emerald-400 text-xs font-semibold">Activa</span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-slate-500/15 text-slate-600 dark:text-slate-300 text-xs font-semibold">Cerrada</span>
                            @endif
                        </div>

                        <div class="absolute top-4 right-4">
                            <span class="px-2 py-1 rounded bg-white/80 dark:bg-slate-900/80 backdrop-blur text-xs text-slate-600 dark:text-slate-300">
                                {{ number_format($poll->votes_count) }} {{ \Illuminate\Support\Str::plural('voto', $poll->votes_count) }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 line-clamp-2 transition">
                            {{ $poll->title }}
                        </h3>

                        <p class="text-sm text-slate-600 dark:text-slate-400 mb-4 line-clamp-2">
                            {{ $poll->description }}
                        </p>

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
                                {{ auth()->check() && auth()->user()->hasVotedInPoll($poll) ? 'Ver Resultados' : 'Votar Ahora' }}
                            </a>

                            <button class="p-2 rounded-lg border border-slate-300 dark:border-white/20 hover:bg-slate-100 dark:hover:bg-white/10 transition">
                                <flux:icon.share-2 />
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    {{-- Paginación --}}
    <div class="mt-12">
        {{ $this->polls->links() }}
    </div>
</section>
