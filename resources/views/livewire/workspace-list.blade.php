<div>
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($workspaces as $workspace)
            <div wire:key="workspace-{{ $workspace->id }}">
                <x-workspace-card :workspace="$workspace" />
            </div>
        @empty
            <p class="text-slate-600">
                No tienes workspaces para mostrar.
            </p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $workspaces->links() }}
    </div>
</div>