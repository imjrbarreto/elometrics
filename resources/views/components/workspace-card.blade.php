@props(['workspace'])

<a href="{{ route('workspaces.show', $workspace) }}"
    class="group block rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-indigo-300 hover:shadow-lg">
    <div class="flex items-start justify-between gap-4">
        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-xl text-indigo-600">
            ♟
        </div>

        <span class="text-xl text-slate-400 transition group-hover:text-indigo-600">
            ↗
        </span>
    </div>

    <h2 class="mt-6 text-lg font-semibold text-slate-900 group-hover:text-indigo-700">
        {{ $workspace->title }}
    </h2>

    <p class="mt-3 text-sm text-slate-500">
        Alumnos: <span class="font-semibold text-slate-800">{{ $workspace->students_count }}</span>
    </p>

    <p class="mt-2 text-sm text-slate-500">
        Creado el {{ $workspace->created_at->format('d/m/Y') }}
    </p>
</a>
