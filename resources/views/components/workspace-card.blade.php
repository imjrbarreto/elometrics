@props(['workspace'])

<a href="{{ route('workspaces.show', $workspace) }}"
    class="group block rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-gray-800 hover:shadow-lg">
    <div class="flex items-start justify-between gap-4">
        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-800 text-xl text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>

        </div>

        <span class="text-xl text-slate-400 transition group-hover:text-gray-800">
            ↗
        </span>
    </div>

    <h2 class="mt-6 text-lg font-semibold text-slate-900 group-hover:text-gray-800">
        {{ $workspace->title }}
    </h2>

    <p class="mt-3 text-sm text-slate-500">
        Alumnos: <span class="font-semibold text-slate-800">{{ $workspace->students_count }}</span>
    </p>

    <div class="flex items-start justify-between gap-4">
        <p class="mt-2 text-sm text-slate-500">
            Creado el {{ $workspace->created_at->format('d/m/Y') }}
        </p>

        {{-- <p class="{{ $workspace->status->color() }} mt-2 text-sm font-bold">
            {{ $workspace->status->label() }}
        </p> --}}
        <div class="{{ $workspace->status->color() }} w-4 h-4 rounded-full inline-block"></div>
    </div>
</a>
