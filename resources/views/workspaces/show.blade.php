<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <a href="{{ route('workspaces.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                ← Volver a mis workspaces
            </a>

            <div class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-widest text-indigo-600">
                            Workspace
                        </p>
                        <h1 class="mt-2 text-3xl font-bold text-slate-900">
                            {{ __($workspace->title) }}
                        </h1>
                        <p class="mt-3 text-sm text-slate-500">
                            Creado el {{ __($workspace->created_at->format('d/m/Y')) }}
                        </p>
                    </div>

                    <a href="{{ route('workspaces.edit', $workspace) }}"
                        class="inline-flex justify-center rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white hover:bg-indigo-700">
                        Editar workspace
                    </a>
                </div>

                <div class="mt-10 border-t border-slate-100 pt-6 flex items-start justify-between">
                    <form action="{{ route('workspaces.destroy', $workspace) }}" method="POST"
                        onsubmit="return confirm('¿Eliminar este workspace?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="rounded-xl border border-red-200 px-4 py-2 font-semibold text-red-700 hover:bg-red-50">
                            Eliminar workspace
                        </button>
                    </form>
                    <p class="mt-3 text-sm text-slate-500">
                         Estado: <span class="{{ $workspace->status->labelColor() }}">{{ __($workspace->status->label()) }}</span>
                     </p>
                </div>
            </div>

            <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900">Alumnos</h2>

                @can('manageStudents', $workspace)
                <a href="{{ route('workspaces.students.create', $workspace) }}"
                    class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                    + Añadir alumno
                </a>
                @endcan

                <div class="mt-6 space-y-3">
                    @forelse ($students as $student)
                        <div class="flex items-center justify-between rounded-xl border border-slate-200 px-4 py-3">
                            <span class="text-slate-800">{{ __($student->name) }}</span>

                            @can('manageStudents', $workspace)
                            <form method="POST"
                                action="{{ route('workspaces.students.destroy', [$workspace, $student]) }}"
                                onsubmit="return confirm('¿Eliminar a este alumno?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-sm font-semibold text-red-700 hover:text-red-900">
                                    Eliminar
                                </button>
                            </form>
                            @endcan
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">
                            Este workspace todavía no tiene alumnos.
                        </p>
                    @endforelse
                </div>
            </section>

            <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold">Sesiones</h2>

                    @can('manageTrainingSessions', $workspace)
                        <a href="{{ route('training-sessions.create', $workspace) }}"
                            class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                            Nueva sesión
                        </a>
                    @endcan
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    @forelse ($trainingSessions as $trainingSession)
                        <a href="{{ route('training-sessions.show', [$workspace, $trainingSession]) }}"
                            class="block rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:border-indigo-300 hover:shadow-md">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-indigo-600">
                                        {{ __($trainingSession->date->format('d/m/Y')) }}
                                    </p>
        
                                    <h3 class="mt-2 text-lg font-semibold text-slate-900">
                                        {{ __($trainingSession->title) }}
                                    </h3>
        
                                    @if ($trainingSession->summary)
                                        <p class="mt-3 text-sm text-slate-600">
                                            {{ __($trainingSession->summary) }}
                                        </p>
                                    @endif
                                </div>
                                <div class="{{ $trainingSession->status->color() }} w-4 h-4 rounded-full inline-block"></div>
                            </div>
                        </a>
                        @empty
                            <p class="text-sm text-slate-500">
                                Todavía no hay sesiones en este workspace.
                            </p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
