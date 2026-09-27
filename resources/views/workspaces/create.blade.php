<x-app-layout>
    <div class="py-8 max-w-3xl mx-auto px-4">
        <h1 class="text-2xl font-semibold mb-6">Crear workspace</h1>

        <form action="{{ route('workspaces.store') }}" method="POST">
            @csrf

            <label for="title">Titulo</label>
            <input
                id="title"
                name="title"
                type="text"
                value="{{ old('title') }}"
                required
                class="block w-full border rounded mt-1 mb-2"
            >

            @error('title')
                <p class="text-red-600 mb-4">{{ $message }}</p>
            @enderror

            <button type="submit">Crear workspace</button>
        </form>
    </div>
</x-app-layout>