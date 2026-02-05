<div class="min-h-screen py-8 px-4" x-data="voteSecurityHandler()">
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
                                <tr class="{{ $this->isVotedCandidate($candidate->id) ? 'bg-[#d6f4df] dark:bg-[#253949]' : '' }}">
                                    <td class="px-4 py-3">
                                        @php
                                            $isThisCandidate = $userVote?->candidate_id === $candidate->id;
                                        @endphp
                                        @if($this->isPollClosed)
                                            @if($isThisCandidate)
                                                <flux:button type="button" icon="vote" disabled>
                                                    Marcado
                                                </flux:button>
                                            @endif
                                        @elseif(!$userVote)
                                            <flux:button type="button" icon="x"
                                                wire:click="selectedVote({{ $candidate->id }})"
                                                class="cursor-pointer">
                                                Marcar
                                            </flux:button>
                                        @elseif($isThisCandidate)
                                            <flux:button type="button" icon="vote" disabled>
                                                Marcado
                                            </flux:button>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <label for="candidate-{{ $candidate->id }}" class="text-sm font-semibold text-gray-900 dark:text-gray-100 cursor-pointer">
                                            {{ $candidate->name }}
                                        </label>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center">
                                            @if($candidate?->photo)
                                                <img
                                                    src="{{ Storage::disk('candidates_photos')->url($candidate->photo) }}"
                                                    alt="{{ $candidate->name }}"
                                                    class="w-12 h-12 object-cover ring-gray-200 dark:ring-gray-600"
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

                            <tr class="{{ $this->isSpecialVote('no sabe') ? 'bg-[#d6f4df] dark:bg-[#253949]' : '' }}">
                                <td class="px-4 py-3">
                                    @php
                                        $isNoSabe = $userVote?->vote_type === 'no sabe';
                                    @endphp
                                    @if($this->isPollClosed)
                                        @if($isNoSabe)
                                            <flux:button type="button" icon="vote" disabled>
                                                Marcado
                                            </flux:button>
                                        @endif
                                    @elseif(!$userVote)
                                        <flux:button type="button" icon="x"
                                            wire:click="selectedVote('no sabe')"
                                            class="cursor-pointer">
                                            Marcar
                                        </flux:button>
                                    @elseif($isNoSabe)
                                        <flux:button type="button" icon="vote" disabled>
                                            Marcado
                                        </flux:button>
                                    @endif
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

                            <tr class="{{ $this->isSpecialVote('ninguno') ? 'bg-[#d6f4df] dark:bg-[#253949]' : '' }}">
                                <td class="px-4 py-3">
                                    @php
                                        $isNinguno = $userVote?->vote_type === 'ninguno';
                                    @endphp
                                    @if($this->isPollClosed)
                                        @if($isNinguno)
                                            <flux:button type="button" icon="vote" disabled>
                                                Marcado
                                            </flux:button>
                                        @endif
                                    @elseif(!$userVote)
                                        <flux:button type="button" icon="x"
                                            wire:click="selectedVote('ninguno')"
                                            class="cursor-pointer">
                                            Marcar
                                        </flux:button>
                                    @elseif($isNinguno)
                                        <flux:button type="button" icon="vote" disabled>
                                            Marcado
                                        </flux:button>
                                    @endif
                                </td>
                                <td colspan="5" class="px-4 py-3">
                                    <label for="vote-null" class="cursor-pointer">
                                        <div class="flex items-center gap-3">
                                            <div>
                                                <p class="text-sm font-semibold  text-gray-900 dark:text-gray-100">Ninguno de los anteriores</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-400">Ninguno de las opciones me representa o que no votaría</p>
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
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <flux:modal name="modal-vote" class="md:w-96" :dismissible="false">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Confirmar Votación</flux:heading>
                <flux:text class="mt-2">
                    @if ($vote_type === 'válido')
                        Estás seguro de votar por la opción: <br>
                        <span class="text-sm font-semibold">{{ $selectedCandidateName }}</span>
                    @else
                        Estás seguro de marcar por la opción: <br>
                        <span class="text-sm font-semibold">{{ Str::ucfirst($vote_type) }}</span>
                    @endif
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="danger">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button type="button" @click="submitVote()" variant="primary">Confirmar Votación</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

@push('scripts')
    <script>
        function voteSecurityHandler() {
            return {
                async init() {
                    const fingerprint = await this.generateFingerprint();
                    @this.set('clientFingerprint', fingerprint);
                },

                async generateFingerprint() {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    ctx.textBaseline = 'top';
                    ctx.font = '14px Arial';
                    ctx.fillText('vote-fingerprint', 2, 2);

                    const data = {
                        canvas: canvas.toDataURL(),
                        userAgent: navigator.userAgent,
                        language: navigator.language,
                        languages: navigator.languages?.join(',') || '',
                        platform: navigator.platform,
                        timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
                        screenResolution: `${screen.width}x${screen.height}x${screen.colorDepth}`,
                        availableScreenResolution: `${screen.availWidth}x${screen.availHeight}`,
                        hardwareConcurrency: navigator.hardwareConcurrency || 0,
                        deviceMemory: navigator.deviceMemory || 0,
                        maxTouchPoints: navigator.maxTouchPoints || 0,
                        plugins: Array.from(navigator.plugins || []).map(p => p.name).join(','),
                        webgl: this.getWebGLFingerprint()
                    };

                    const textData = JSON.stringify(data);
                    const encoder = new TextEncoder();
                    const dataBuffer = encoder.encode(textData);
                    const hashBuffer = await crypto.subtle.digest('SHA-256', dataBuffer);
                    const hashArray = Array.from(new Uint8Array(hashBuffer));
                    return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
                },

                getWebGLFingerprint() {
                    try {
                        const canvas = document.createElement('canvas');
                        const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
                        if (!gl) return 'no-webgl';

                        const debugInfo = gl.getExtension('WEBGL_debug_renderer_info');
                        if (debugInfo) {
                            return gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL);
                        }
                        return 'no-debug-info';
                    } catch (e) {
                        return 'error';
                    }
                },

                async submitVote() {
                    const fingerprint = await this.generateFingerprint();
                    @this.set('clientFingerprint', fingerprint);
                    await @this.vote();
                }
            }
        }
    </script>
@endpush
