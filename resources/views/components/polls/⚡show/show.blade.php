<div class="min-h-screen py-8 px-4">
    <div class="container mx-auto max-w-7xl">

        <div class="dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden mb-8 border border-gray-200 dark:border-gray-700">
            <div class="w-full shadow-lg overflow-hidden bg-white dark:bg-slate-900">
                @if ($poll->image)
                    <div class="relative w-full h-64 sm:h-80 md:h-96 lg:h-[420px]">
                        <img src="{{ Storage::disk('polls')->url($poll->image) }}"
                            alt="{{ $poll->title }}"
                            class="w-full h-full object-cover">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/20 to-transparent"></div>

                        <div class="absolute top-4 left-4 z-10">
                            <span class="px-3 py-1 text-xs font-bold rounded-full bg-white/90 text-slate-900 backdrop-blur">
                                {{ $poll->category->name }}
                            </span>
                        </div>

                        <div class="absolute top-4 right-4 z-10">
                            <span @class([
                                'px-3 py-1 text-xs font-bold rounded-full backdrop-blur',
                                'bg-green-500/90 text-white' => $poll->status === 'activo',
                                'bg-gray-500/90 text-white' => $poll->status === 'cerrado',
                                'bg-yellow-500/90 text-white' => $poll->status === 'borrador',
                                'bg-red-500/90 text-white' => $poll->status === 'archivado',
                            ])>
                                {{ ucfirst($poll->status) }}
                            </span>
                        </div>
                    </div>
                @endif

                <div class="px-6 md:px-10 py-8">
                    <div class="max-w-6xl mx-auto">

                        <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                            {{ $poll->title }}
                        </h1>

                        <div class="prose dark:prose-invert max-w-none text-sm md:text-base mb-8">
                            {!! nl2br($poll->description) !!}
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                            <div class="flex items-center gap-3 bg-slate-100 dark:bg-white/5 rounded-xl px-4 py-3">
                                <flux:icon.map-pin />
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Ubicación</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $poll->location }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 bg-slate-100 dark:bg-white/5 rounded-xl px-4 py-3">
                                <flux:icon.clock-8 />
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Finaliza</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $poll->ends_at->format('d/m/Y') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 bg-slate-100 dark:bg-white/5 rounded-xl px-4 py-3 sm:col-span-2 lg:col-span-1">
                                <flux:icon.clipboard-plus />
                                <div>
                                    <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Votos emitidos</p>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $this->totalVotes }}</p>
                                </div>
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
                            <flux:icon.thumbs-up />
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
                        <flux:icon.file-text />
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
                                                src="{{ Storage::disk('candidates_photos')->url($candidate->photo) }}"
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
                                                    src="{{ Storage::disk('logos')->url($candidate->politicalParty->logo) }}"
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

                            @if($poll->allow_know_vote)
                                <tr class="{{ $hasVoted ? 'bg-[#d6f4df] dark:bg-[#253949]' : '' }}">
                                    <td class="px-4 py-3">
                                        @unless($hasVoted)
                                            <flux:button type="button" icon="x" wire:click="selectedVote('no_sabe')" class="cursor-pointer">
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
                                                    <p class="text-sm font-semibold  text-gray-900 dark:text-gray-100">No sabe / No opina</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">No tengo una opinión clara o no tengo preferencia</p>
                                                </div>
                                            </div>
                                        </label>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="font-bold text-red-600 dark:text-red-400">
                                            {{ $this->knowVotes }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($this->totalVotes > 0)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                                {{ round(($this->knowVotes / $this->totalVotes) * 100, 1) }}%
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">0%</span>
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            @if($poll->allow_none_vote)
                                <tr class="{{ $hasVoted ? 'bg-[#d6f4df] dark:bg-[#253949]' : '' }}">
                                    <td class="px-4 py-3">
                                        @unless($hasVoted)
                                            <flux:button type="button" icon="x" wire:click="selectedVote('ninguno')" class="cursor-pointer">
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
                                                    <p class="text-sm font-semibold  text-gray-900 dark:text-gray-100">Ninguno de los anteriores</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">Ninguno de las opciones me representa o que no votaría.</p>
                                                </div>
                                            </div>
                                        </label>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span class="font-bold text-red-600 dark:text-red-400">
                                            {{ $this->noneVotes }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($this->totalVotes > 0)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300">
                                                {{ round(($this->noneVotes / $this->totalVotes) * 100, 1) }}%
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
                        <flux:icon.chart-no-axes-column-increasing />
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

                    @if ($poll->allow_know_vote)
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700/30 dark:to-gray-600/30 rounded-xl p-5 border border-gray-200 dark:border-gray-600">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">No sabe / No opina</p>
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-liResumen nejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <p class="text-3xl font-bold text-gray-700 dark:text-gray-300">{{ $this->knowVotes }}</p>
                            @if($this->totalVotes > 0)
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ round(($this->knowVotes / $this->totalVotes) * 100, 1) }}%
                                </p>
                            @endif
                        </div>
                    @endif

                    @if ($poll->allow_none_vote)
                        <div class="bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/30 dark:to-red-800/30 rounded-xl p-5 border border-red-200 dark:border-red-700">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-sm font-medium text-red-900 dark:text-red-100">Ninguno de los anteriores</p>
                                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $this->noneVotes }}</p>
                            @if($this->totalVotes > 0)
                                <p class="text-xs text-red-500 dark:text-red-400 mt-1">
                                    {{ round(($this->noneVotes / $this->totalVotes) * 100, 1) }}%
                                </p>
                            @endif
                        </div>
                    @endif
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
