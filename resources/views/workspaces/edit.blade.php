<x-app-layout>
    <div class="py-8 max-w-3xl mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-6">Editar workspace</h1>

        <form action="{{ route('workspaces.update', $workspace) }}" method="POST">
            @csrf
            @method('PATCH')

            <label for="title">Título</label>
            <input
                id="title"
                name="title"
                type="text"
                value="{{ old('title', $workspace->title) }}"
                required
                class="block w-full border rounded mt-1 mb-2"
            >

            @error('title')
                <p class="text-red-600 mb-4">{{ $message }}</p>
            @enderror

            <button type="submit">Guardar cambios</button>
        </form>

        <a href="{{ route('workspaces.show', $workspace) }}">
            Cancelar
        </a>
    </div>
</x-app-layout>