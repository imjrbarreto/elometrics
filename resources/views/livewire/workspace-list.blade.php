<div>
    <div class="mb-6 flex flex-wrap gap-2">
        @foreach ([
            'owned' => 'Mis workspaces',
            'shared' => 'Compartidos conmigo',
        ] as $value => $label)
            <button
                type="button"
                wire:click="selectTab('{{ $value }}')"
                aria-pressed="{{ $tab === $value ? 'true' : 'false' }}"
                @class([
                    'rounded-xl px-4 py-2 text-sm font-semibold transition',
                    'bg-indigo-600 text-white' => $tab === $value,
                    'bg-white text-slate-600 hover:bg-indigo-50' => $tab !== $value,
                ])
            >
                {{ $label }}
            </button>
        @endforeach
    </div>
    
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3"
         wire:loading.class="opacity-50">
        @forelse ($workspaces as $workspace)
            <div wire:key="workspace-{{ $workspace->id }}">
                <x-workspace-card :workspace="$workspace" />
            </div>
        @empty
            <p class="text-slate-600 sm:col-span-2 lg:col-span-3">
                @if ($tab === 'owned')
                    Todavía no tienes workspaces propios.
                @else
                    No tienes workspaces compartidos contigo.
                @endif
            </p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $workspaces->links() }}
    </div>
</div>