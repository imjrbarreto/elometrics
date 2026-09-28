<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-2xl px-4 sm:px-6">
            <a href="{{ route('workspaces.show', $workspace) }}"
               class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                ← Volver al workspace
            </a>

            <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <h1 class="text-2xl font-bold text-slate-900">Añadir alumno</h1>

                <form method="POST"
                      action="{{ route('workspaces.students.store', $workspace) }}"
                      class="mt-6 space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700">
                            Nombre
                        </label>
                        <input id="name" name="name" type="text" required
                               value="{{ old('name') }}"
                               class="mt-2 block w-full rounded-xl border-slate-300">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-700">
                        Guardar alumno
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>