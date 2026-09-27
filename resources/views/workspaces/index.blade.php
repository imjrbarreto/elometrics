<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                        Mis workspaces
                    </h1>

                    <p class="mt-2 text-slate-600">
                        Organiza aquí el trabajo con tus alumnos.
                    </p>
                </div>

                <a
                    href="{{ route('workspaces.create') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-black shadow-sm transition hover:bg-indigo-700"
                >
                    + Nuevo workspace
                </a>
            </div>

            @if ($workspaces->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
                    <div class="text-4xl">♟</div>

                    <h2 class="mt-4 text-xl font-semibold text-slate-900">
                        Todavía no tienes workspaces
                    </h2>

                    <p class="mt-2 text-slate-600">
                        Crea el primero para empezar a organizar tu entrenamiento.
                    </p>
                </div>
            @else
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($workspaces as $workspace)
                        <x-workspace-card :workspace="$workspace" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
