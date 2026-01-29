<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-8 px-4">
    <div class="container mx-auto max-w-7xl">

        <div class="dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden mb-8 border border-gray-200 dark:border-gray-700">
            <div class="bg-gradient-to-r px-8 py-10">
                <div class="flex items-start justify-between">
                    <div class="w-full">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-gray-100 mb-3">
                            {{ $poll->title }}
                        </h1>
                        <p class="text-gray-800 dark:text-gray-100 text-lg">
                            {{ $poll->description }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                    @if($poll->location)
                        <div class="bg-gray-200/30 dark:bg-white/10 backdrop-blur-sm rounded-xl px-4 py-3">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-gray-800 dark:text-blue-200">Ubicación</p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $poll->location }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($poll->starts_at)
                        <div class="bg-gray-200/30 dark:bg-white/10 backdrop-blur-sm rounded-xl px-4 py-3">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-gray-800 dark:text-gray-100">Inicio</p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $poll->starts_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($poll->ends_at)
                        <div class="bg-gray-200/30 dark:bg-white/10 backdrop-blur-sm rounded-xl px-4 py-3">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <p class="text-xs text-gray-800 dark:text-gray-100">Finaliza</p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $poll->ends_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="bg-gray-200/30 dark:bg-white/10 backdrop-blur-sm rounded-xl px-4 py-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <div>
                                <p class="text-xs text-gray-800 dark:text-gray-100">Total votos</p>
                                <p class="text-sm font-bold text-gray-800 dark:text-gray-100">{{ $this->totalVotes }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($hasVoted)
            <div class="mb-8 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-2 border-green-200 dark:border-green-700 rounded-2xl p-6">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-green-900 dark:text-green-100">¡Voto registrado exitosamente!</h3>
                        <p class="text-green-700 dark:text-green-300 text-sm">Tu voto ha sido guardado de forma segura en esta encuesta.</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Opciones de Votación
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100 dark:bg-gray-700/30 border-b border-gray-200 dark:border-gray-600">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Votar
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Foto
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Número
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Partido
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Logo
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    Votos
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    %
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($poll->candidates as $candidate)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors {{ !$hasVoted ? 'cursor-pointer' : '' }}">
                                    <td class="px-4 py-4">
                                        @unless($hasVoted)
                                            <input
                                                type="radio"
                                                wire:model="selectedCandidate"
                                                value="{{ $candidate->id }}"
                                                id="candidate-{{ $candidate->id }}"
                                                class="w-5 h-5 text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600 cursor-pointer"
                                            >
                                        @endunless
                                    </td>
                                    <td class="px-4 py-4">
                                        <label for="candidate-{{ $candidate->id }}" class="font-semibold text-gray-900 dark:text-gray-100 cursor-pointer">
                                            {{ $candidate->name }}
                                        </label>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <div class="flex justify-center">
                                            <img
                                                src="{{ $candidate->photo }}"
                                                alt="{{ $candidate->name }}"
                                                class="w-12 h-12 rounded-full object-cover ring-2 ring-gray-200 dark:ring-gray-600"
                                            >
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @if($candidate->number)
                                            <div class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 shadow-md">
                                                <span class="text-lg font-bold text-white">{{ $candidate->number }}</span>
                                            </div>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">
                                            {{ $candidate->politicalParty->name ?? 'Independiente' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <div class="flex justify-center">
                                            @if($candidate->politicalParty?->logo)
                                                <img
                                                    src="{{ $candidate->politicalParty->logo }}"
                                                    alt="{{ $candidate->politicalParty->name }}"
                                                    class="w-10 h-10 rounded-full object-cover ring-2 ring-gray-200 dark:ring-gray-600"
                                                >
                                            @else
                                                <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-lg font-bold text-blue-600 dark:text-blue-400">
                                            {{ $candidate->votes->count() }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @if($this->totalVotes > 0)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                                {{ round(($candidate->votes->count() / $this->totalVotes) * 100, 1) }}%
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">0%</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            @if($poll->allow_blank_vote)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors {{ !$hasVoted ? 'cursor-pointer' : '' }} border-t-2 border-gray-300 dark:border-gray-600">
                                    <td class="px-4 py-4">
                                        @unless($hasVoted)
                                            <input
                                                type="radio"
                                                wire:model="specialVote"
                                                value="blanco"
                                                id="vote-blank"
                                                class="w-5 h-5 text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600 cursor-pointer"
                                            >
                                        @endunless
                                    </td>
                                    <td colspan="5" class="px-4 py-4">
                                        <label for="vote-blank" class="cursor-pointer">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-900 dark:text-gray-100">Voto en blanco</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">No selecciono ningún candidato</p>
                                                </div>
                                            </div>
                                        </label>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-lg font-bold text-gray-600 dark:text-gray-300">
                                            {{ $this->blankVotes }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @if($this->totalVotes > 0)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                {{ round(($this->blankVotes / $this->totalVotes) * 100, 1) }}%
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">0%</span>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if($poll->allow_null_vote)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors {{ !$hasVoted ? 'cursor-pointer' : '' }}">
                                    <td class="px-4 py-4">
                                        @unless($hasVoted)
                                            <input
                                                type="radio"
                                                wire:model="specialVote"
                                                value="nulo"
                                                id="vote-null"
                                                class="w-5 h-5 text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600 cursor-pointer"
                                            >
                                        @endunless
                                    </td>
                                    <td colspan="5" class="px-4 py-4">
                                        <label for="vote-null" class="cursor-pointer">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-900 dark:text-gray-100">Voto nulo</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">Anulo mi voto</p>
                                                </div>
                                            </div>
                                        </label>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span class="text-lg font-bold text-red-600 dark:text-red-400">
                                            {{ $this->nullVotes }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        @if($this->totalVotes > 0)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                                {{ round(($this->nullVotes / $this->totalVotes) * 100, 1) }}%
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">0%</span>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            @unless($hasVoted)
                <div class="mt-6">
                    <flux:button
                        wire:click="vote"
                        variant="primary"
                        class="w-full py-4 text-lg font-bold rounded-xl shadow-lg hover:shadow-xl transition-all"
                    >
                        <svg class="w-6 h-6 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Emitir mi voto
                    </flux:button>
                </div>
            @endunless

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700 sticky top-8">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-600/50 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Resumen de votos
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 space-y-4">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl p-5 border border-blue-200 dark:border-blue-700">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-blue-900 dark:text-blue-100">Total de votos</p>
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                            </svg>
                        </div>
                        <p class="text-4xl font-bold text-blue-600 dark:text-blue-400">{{ $this->totalVotes }}</p>
                    </div>

                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700/30 dark:to-gray-600/30 rounded-xl p-5 border border-gray-200 dark:border-gray-600">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Votos en blanco</p>
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-gray-700 dark:text-gray-300">{{ $this->blankVotes }}</p>
                        @if($this->totalVotes > 0)
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                {{ round(($this->blankVotes / $this->totalVotes) * 100, 1) }}%
                            </p>
                        @endif
                    </div>

                    <div class="bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/30 dark:to-red-800/30 rounded-xl p-5 border border-red-200 dark:border-red-700">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-red-900 dark:text-red-100">Votos nulos</p>
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $this->nullVotes }}</p>
                        @if($this->totalVotes > 0)
                            <p class="text-xs text-red-500 dark:text-red-400 mt-1">
                                {{ round(($this->nullVotes / $this->totalVotes) * 100, 1) }}%
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
