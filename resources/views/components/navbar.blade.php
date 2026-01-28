<div class="w-full">
    <flux:header container class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 flex items-center">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:brand href="{{ route('home') }}" logo="https://fluxui.dev/img/demo/logo.png" name="{{ config('app.name') }}" class="max-lg:hidden dark:hidden" wire:navigate />
        <flux:brand href="{{ route('home') }}" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="{{ config('app.name') }}" class="max-lg:hidden! hidden dark:flex" wire:navigate />

        <flux:spacer />

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item href="{{ route('categories') }}" wire:navigate>Categorías</flux:navbar.item>
            <flux:navbar.item href="{{ route('polls') }}" wire:navigate>Encuestas</flux:navbar.item>
            <flux:navbar.item href="{{ route('parties') }}" wire:navigate>Partidos</flux:navbar.item>
            <flux:navbar.item href="{{ route('candidates') }}" wire:navigate>Candidatos</flux:navbar.item>
            <flux:navbar.item href="{{ route('contact') }}" wire:navigate>Contacto</flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        {{-- Apariencia --}}
        <flux:navbar>
            <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" size="sm"  icon="moon" variant="subtle" aria-label="Toggle dark mode" />

            <flux:spacer />

            {{-- Profile Dropdown --}}
            @auth
                <flux:dropdown position="top" align="end">
                    <flux:profile
                        class="cursor-pointer"
                        :name="auth()->user()->name"
                        :initials="auth()->user()->initials()"
                    />

                    <flux:menu>
                        <flux:menu.radio.group>
                            <div class="p-0 text-sm font-normal">
                                <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                    <flux:avatar :src="auth()->user()->avatar" size="sm" class="shrink-0" />

                                    <div class="grid flex-1 text-left text-sm leading-tight">
                                        <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                        <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <flux:menu.radio.group>
                            <flux:menu.item href="/settings/profile" icon="cog">Perfil</flux:menu.item>
                        </flux:menu.radio.group>

                        <flux:menu.separator />

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" data-test="logout-button" class="w-full">
                                Cerrar Sesión
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            @else
                <flux:button size="sm" href="{{ route('login') }}" wire:navigate>Iniciar Sesión</flux:button>
            @endauth
        </flux:navbar>
    </flux:header>

    {{-- Mobile sidebar --}}
    <flux:sidebar collapsible="mobile" sticky class="lg:hidden border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.header>
            <flux:sidebar.brand href="#" name="Podium">
                <div class="flex aspect-square items-center justify-center rounded-md bg-accent text-accent-foreground p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mic-vocal">
                        <path d="m11 7.601-5.994 8.19a1 1 0 0 0 .1 1.298l.817.818a1 1 0 0 0 1.314.087L15.09 12"/>
                        <path d="M16.5 21.174C15.5 20.5 14.372 20 13 20c-2.058 0-3.928 2.356-6 2-2.072-.356-2.775-3.369-1.5-4.5"/>
                        <circle cx="16" cy="7" r="5"/>
                    </svg>
                </div>
            </flux:sidebar.brand>

            <flux:sidebar.collapse class="lg:hidden" />
        </flux:sidebar.header>

        <flux:sidebar.nav variant="outline">
            <flux:sidebar.group>
                <flux:sidebar.item href="{{ route('categories') }}" wire:navigate>
                    Categorías
                </flux:sidebar.item>

                <flux:sidebar.item href="{{ route('polls') }}" wire:navigate>
                    Encuestas
                </flux:sidebar.item>

                <flux:sidebar.item href="{{ route('parties') }}" wire:navigate>
                    Partidos
                </flux:sidebar.item>

                <flux:sidebar.item href="{{ route('candidates') }}" wire:navigate>
                    Candidatos
                </flux:sidebar.item>

                <flux:sidebar.item href="{{ route('contact') }}" wire:navigate>
                    Contacto
                </flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:sidebar.spacer />
    </flux:sidebar>
</div>
