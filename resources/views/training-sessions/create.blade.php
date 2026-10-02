<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-2xl px-4 sm:px-6">
            <a href="{{ route('workspaces.show', $workspace) }}"
                class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                ← Volver al workspace
            </a>

            <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <h1 class="text-2xl font-bold text-slate-900">Nueva sesión</h1>

                <form method="POST" action="{{ route('training-sessions.store', $workspace) }}" class="mt-6 space-y-5">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium text-slate-700">
                            Título
                        </label>
                        <input id="title" name="title" type="text" required value="{{ old('title') }}"
                            class="mt-2 block w-full rounded-xl border-slate-300">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium text-slate-700">
                            Fecha
                        </label>
                        <input id="date" name="date" type="date" required value="{{ old('date') }}"
                            class="mt-2 block w-full rounded-xl border-slate-300">
                        @error('date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="summary" class="block text-sm font-medium text-slate-700">
                            Resumen
                        </label>
                        <textarea id="summary" name="summary" rows="6" class="mt-2 block w-full rounded-xl border-slate-300">{{ old('summary') }}</textarea>
                        @error('summary')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-slate-700">
                            Categoría
                        </label>

                        <select id="category" name="category" class="mt-1 block w-full rounded-md border-slate-300">
                            <option value="">Sin categoría</option>

                            @foreach (\App\Enums\TrainingSessionCategory::cases() as $category)
                                <option value="{{ $category->value }}" @selected(old('category') === $category->value)>
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

                        <input type="url" id="resource_url" name="resource_url" value="{{ old('resource_url') }}"
                            maxlength="2048" placeholder="https://lichess.org/study/..."
                            class="mt-1 block w-full rounded-md border-slate-300">

                        @error('resource_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-700">
                        Guardar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
