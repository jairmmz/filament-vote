<section class="py-12 bg-muted/30">
    <div class="container-peru">
        <div class="text-center mb-8 animate-fade-in">
            <h2 class="text-2xl lg:text-3xl font-bold text-foreground mb-2">
                Explora por Categoría
            </h2>
            <p class="text-muted-foreground">
                Encuentra encuestas según tu interés
            </p>
        </div>

        <div class="relative">
            {{-- Gradient Fade Left --}}
            <div class="absolute left-0 top-0 bottom-0 w-8 bg-gradient-to-r from-muted/30 to-transparent z-10 pointer-events-none lg:hidden"></div>

            {{-- Gradient Fade Right --}}
            <div class="absolute right-0 top-0 bottom-0 w-8 bg-gradient-to-l from-muted/30 to-transparent z-10 pointer-events-none lg:hidden"></div>

            {{-- Categories Container --}}
            <div class="flex gap-3 overflow-x-auto pb-4 px-4 -mx-4 lg:mx-0 lg:px-0 lg:flex-wrap lg:justify-center">
                @php
                    $allCategories = collect([
                        (object)['id' => 0, 'name' => 'Todas', 'slug' => 'todos', 'active_polls_count' => $stats['total_polls']]
                    ])->concat($categories);
                @endphp

                @foreach($allCategories as $index => $category)
                    <flux:button wire:key="category-{{ $index }}"
                        href="{{ $category->id === 0 ? route('categories') : route('categories.show', $category->slug) }}" wire:navigate>
                        <span>{{ $category->name }}</span>
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold">
                            {{ $category->active_polls_count }}
                        </span>
                    </flux:button>
                @endforeach
            </div>
        </div>
    </div>
</section>
