<x-app-layout>
    <div class="py-8 max-w-3xl mx-auto px-4">
        <h1 class="text-2xl font-semibold">{{ $workspace->name }}</h1>

        <a href="{{ route('workspaces.index') }}">
            <p>Volver a mis workspaces</p>
        </a>

        <a href="{{ route('workspaces.edit', $workspace) }}">
            <p>Editar workspace</p>
        </a>

        <form action="{{ route('workspaces.destroy', $workspace) }}" method="POST"
            onsubmit="return confirm('¿Eliminar este workspace?')">
            @csrf
            @method('DELETE')

            <button type="submit">Eliminar workspace</button>
        </form>
    </div>
</x-app-layout>
