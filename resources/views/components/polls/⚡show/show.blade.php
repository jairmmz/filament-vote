<div class="min-h-screen py-8 px-4">
    <div class="container mx-auto max-w-7xl">

        <div class="dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden mb-8 border border-gray-200 dark:border-gray-700">
            <div class="bg-gradient-to-r px-8 py-10">
                <div class="flex items-start justify-between">
                    <div class="w-full">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-gray-100 mb-3">
                            {{ $poll->title }}
                        </h1>
                        <p class="text-gray-800 dark:text-gray-100">
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
                                    <p class="text-sm font-semibold text-gray-800 dark:text-blue-200">Ubicación</p>
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
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-100">Fecha de inicio</p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $poll->starts_at->format('d/m/Y') }}</p>
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
                                    <p class="text-sm font-semibold text-gray-800 dark:text-gray-100">Fecha de finalización</p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-100">{{ $poll->ends_at->format('d/m/Y') }}</p>
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
                                <p class="text-sm font-semibold text-gray-800 dark:text-gray-100">Total votos emitidos</p>
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
                        <h3 class="font-bold text-green-900 dark:text-green-100">¡Voto registrado exitosamente!</h3>
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
                        Lista de candidatos
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
                                    Candidato
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
                                <tr class="{{ $hasVoted ? 'bg-[#d6f4df] dark:bg-[#253949]' : '' }}">
                                    <td class="px-4 py-3">
                                        @unless($hasVoted)
                                            <flux:button type="button" icon="x" wire:click="selectedVote({{ $candidate->id }})" class="cursor-pointer">
                                                Marcar
                                            </flux:button>
                                        @else
                                            <flux:button type="button" icon="vote" disabled>
                                                Marcado
                                            </flux:button>
                                        @endunless
                                    </td>
                                    <td class="px-4 py-3">
                                        <label for="candidate-{{ $candidate->id }}" class="text-sm font-semibold text-gray-900 dark:text-gray-100 cursor-pointer">
                                            {{ $candidate->name }}
                                        </label>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center">
                                            <img
                                                src="{{ $candidate->photo }}"
                                                alt="{{ $candidate->name }}"
                                                class="w-12 h-12 object-cover ring-gray-200 dark:ring-gray-600"
                                            >
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($candidate->number)
                                            <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 shadow-md">
                                                <span class="font-bold text-white">{{ $candidate->number }}</span>
                                            </div>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                                            {{ $candidate->politicalParty->name }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center">
                                            @if($candidate->politicalParty?->logo)
                                                <img
                                                    src="{{ $candidate->politicalParty->logo }}"
                                                    alt="{{ $candidate->politicalParty->name }}"
                                                    class="w-10 h-10 object-cover ring-gray-200 dark:ring-gray-600"
                                                >
                                            @else
                                                <div class="w-10 h-10 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="font-bold text-blue-600 dark:text-blue-400">
                                            {{ $candidate->votes->count() }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($this->totalVotes > 0)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                                {{ round(($candidate->votes->count() / $this->totalVotes) * 100, 1) }}%
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">0%</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            @if($poll->allow_blank_vote)
                                <tr class="{{ $hasVoted ? 'bg-[#d6f4df] dark:bg-[#253949]' : '' }}">
                                    <td class="px-4 py-3">
                                        @unless($hasVoted)
                                            <flux:button type="button" icon="x" wire:click="selectedVote('blanco')" class="cursor-pointer">
                                                Marcar
                                            </flux:button>
                                        @else
                                            <flux:button type="button" icon="vote" disabled>
                                                Marcado
                                            </flux:button>
                                        @endunless
                                    </td>
                                    <td colspan="5" class="px-4 py-3">
                                        <label for="vote-blank" class="cursor-pointer">
                                            <div class="flex items-center gap-3">
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Voto en blanco</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">No selecciono ningún candidato</p>
                                                </div>
                                            </div>
                                        </label>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="font-bold text-gray-600 dark:text-gray-300">
                                            {{ $this->blankVotes }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($this->totalVotes > 0)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-sm font-semibold bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                                {{ round(($this->blankVotes / $this->totalVotes) * 100, 1) }}%
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">0%</span>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if($poll->allow_null_vote)
                                <tr class="{{ $hasVoted ? 'bg-[#d6f4df] dark:bg-[#253949]' : '' }}">
                                    <td class="px-4 py-3">
                                        @unless($hasVoted)
                                            <flux:button type="button" icon="x" wire:click="selectedVote('nulo')" class="cursor-pointer">
                                                Marcar
                                            </flux:button>
                                        @else
                                            <flux:button type="button" icon="vote" disabled>
                                                Marcado
                                            </flux:button>
                                        @endunless
                                    </td>
                                    <td colspan="5" class="px-4 py-3">
                                        <label for="vote-null" class="cursor-pointer">
                                            <div class="flex items-center gap-3">
                                                <div>
                                                    <p class="text-sm font-semibold  text-gray-900 dark:text-gray-100">Voto nulo</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">Anulo mi voto</p>
                                                </div>
                                            </div>
                                        </label>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="font-bold text-red-600 dark:text-red-400">
                                            {{ $this->nullVotes }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($this->totalVotes > 0)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
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

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700 sticky top-8">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-600/50 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Resumen de votos
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 items-stretch">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl p-5 border border-blue-200 dark:border-blue-700">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium text-blue-900 dark:text-blue-100">Total de votos</p>
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                            </svg>
                        </div>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $this->totalVotes }}</p>
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

    {{-- Modal --}}
    <flux:modal name="modal-vote" class="md:w-96" :dismissible="false">
        <div class="space-y-6">
            @if ($isUserNotAuth)
                <div>
                    <flux:heading size="lg">Debes iniciar sesión para votar</flux:heading>
                    <flux:text class="my-4">
                        Para poder votar en esta encuesta, debes iniciar sesión en tu cuenta de google
                    </flux:text>

                    <div class="my-4">
                        <flux:button class="w-full" href="{{ route('auth.google.redirect') }}">
                            <x-slot name="icon">
                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.06 12.25C23.06 11.47 22.99 10.72 22.86 10H12.5V14.26H18.42C18.16 15.63 17.38 16.79 16.21 17.57V20.34H19.78C21.86 18.42 23.06 15.6 23.06 12.25Z" fill="#4285F4"/>
                                    <path d="M12.4997 23C15.4697 23 17.9597 22.02 19.7797 20.34L16.2097 17.57C15.2297 18.23 13.9797 18.63 12.4997 18.63C9.63969 18.63 7.20969 16.7 6.33969 14.1H2.67969V16.94C4.48969 20.53 8.19969 23 12.4997 23Z" fill="#34A853"/>
                                    <path d="M6.34 14.0899C6.12 13.4299 5.99 12.7299 5.99 11.9999C5.99 11.2699 6.12 10.5699 6.34 9.90995V7.06995H2.68C1.93 8.54995 1.5 10.2199 1.5 11.9999C1.5 13.7799 1.93 15.4499 2.68 16.9299L5.53 14.7099L6.34 14.0899Z" fill="#FBBC05"/>
                                    <path d="M12.4997 5.38C14.1197 5.38 15.5597 5.94 16.7097 7.02L19.8597 3.87C17.9497 2.09 15.4697 1 12.4997 1C8.19969 1 4.48969 3.47 2.67969 7.07L6.33969 9.91C7.20969 7.31 9.63969 5.38 12.4997 5.38Z" fill="#EA4335"/>
                                </svg>
                            </x-slot>
                            Iniciar sesión con Google
                        </flux:button>
                    </div>
                </div>
            @else
                <div>
                    <flux:heading size="lg">Confirmar Votación</flux:heading>
                    <flux:text class="mt-2">
                        Estás seguro de que deseas registrar tu voto en esta encuesta?
                    </flux:text>
                </div>
                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="danger">Cancelar</flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" wire:click="vote" variant="primary">Confirmar Votación</flux:button>
                </div>
            @endif
        </div>
    </flux:modal>
</div>
