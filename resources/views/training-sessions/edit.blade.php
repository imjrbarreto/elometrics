<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-2xl px-4 sm:px-6">
            <a href="{{ route('training-sessions.show', [$workspace, $trainingSession]) }}"
                class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                ← Volver a la sesion
            </a>

            <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <h1 class="text-2xl font-bold text-slate-900">
                    Editar Sesion
                </h1>
                <p class="mt-2 text-slate-600">
                    Cambia el título de tu sesion.
                </p>

                <form action="{{ route('training-sessions.update', [$workspace, $trainingSession]) }}" method="POST"
                    class="mt-8">
                    @csrf
                    @method('PATCH')

                    <label for="title" class="block text-sm font-semibold text-slate-700">Título</label>
                    <input id="title" name="title" type="text"
                        value="{{ old('title', $trainingSession->title) }}" required
                        class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    {{-- <label for="date" class="block text-sm font-medium text-slate-700">
                        Fecha
                    </label>
                    <input id="date" name="date" type="date" required value="{{ old('date') }}"
                        class="mt-2 block w-full rounded-xl border-slate-300">
                    @error('date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror --}}

                    <label for="summary" class="block text-sm font-semibold text-slate-700">Summary</label>
                    <input id="summary" name="summary" type="text"
                        value="{{ old('summary', $trainingSession->summary) }}"
                        class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('summary')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <label for="status" class="block text-sm font-semibold text-slate-700">Estado</label>
                    <select id="status" name="status">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}" @selected(old('status', $trainingSession->status?->value ?? $trainingSession->status) == $status->value)>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <p>{{ $message }}</p>
                    @enderror

                    <div>
                        <label for="category" class="block text-sm font-medium text-slate-700">
                            Categoría
                        </label>

                        <select id="category" name="category" class="mt-1 block w-full rounded-md border-slate-300">
                            <option value="">Sin categoría</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->value }}" @selected(old('category', $trainingSession->category?->value) === $category->value)>
                                    {{ $category->label() }}
                                </option>
                            @endforeach
                        </select>

                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="resource_url" class="block text-sm font-medium text-slate-700">
                            Enlace al material
                        </label>

                        <input type="url" id="resource_url" name="resource_url" value="{{ old('resource_url', $trainingSession->resource_url) }}"
                            maxlength="2048" placeholder="https://lichess.org/study/..."
                            class="mt-1 block w-full rounded-md border-slate-300">

                        @error('resource_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <button type="submit"
                            class="rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-700">
                            Guardar cambios
                        </button>

                        <a href="{{ route('training-sessions.show', [$workspace, $trainingSession]) }}"
                            class="font-medium text-slate-600 hover:text-slate-900">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
