<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <a href="{{ route('workspaces.index') }}"
               class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                ← Volver a mis workspaces
            </a>

            <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-widest text-indigo-600">
                            Workspace
                        </p>
                        <h1 class="mt-2 text-3xl font-bold text-slate-900">
                            {{ $workspace->title }}
                        </h1>
                        <p class="mt-3 text-sm text-slate-500">
                            Creado el {{ $workspace->created_at->format('d/m/Y') }}
                        </p>
                    </div>

                    <a href="{{ route('workspaces.edit', $workspace) }}"
                       class="inline-flex justify-center rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-700">
                        Editar workspace
                    </a>
                </div>

                <div class="mt-10 border-t border-slate-100 pt-6">
                    <form action="{{ route('workspaces.destroy', $workspace) }}"
                          method="POST"
                          onsubmit="return confirm('¿Eliminar este workspace?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="rounded-xl border border-red-200 px-4 py-2 font-semibold text-red-700 hover:bg-red-50">
                            Eliminar workspace
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>